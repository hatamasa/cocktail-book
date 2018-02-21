<?php
namespace App\Controller;

use App\Model\Cocktails\Cocktails;
use App\Model\Common\FileUploadException;
use App\Model\Common\MessageUtil;

/**
 * カクテルコントローラ
 * @author hatamasa
 */
class CocktailsController extends AppController
{

    /**
     * 初期表示
     * GET /|/cocktails
     */
    public function index()
    {
    }

    /**
     * カクテル検索
     * GET /cocktails/search
     * @param　$param
     */
    public function search()
    {
        $results = [];
        $params = $this->request->getQueryParams();

        $cocktails = new Cocktails($params);
        $errors = $cocktails->validateForSearch();
        // エラー場合はflashをセットして元の画面へ
        if ($errors) {
            foreach ($errors as $error){
                $this->Flash->error($error);
            }
            $this->set(compact('params'));
            return $this->render('index');
        }

        $results = $this->Cocktails->fetchAllCocktails($params);
        $this->set(compact('results', 'params'));
        // 結果0件は元の画面へ
        if (count($results) == 0) {
            $this->Flash->error("検索結果はありません");
            return $this->render('index');
        }

        $this->Flash->set(count($results) . "件ヒットしました");
        // TODO ローカルストレージに検索条件をjsonで保存する
    }

    /**
     * カクテル詳細表示
     * GET /cocktails/:id
     * @param  $id
     */
    public function view($id)
    {
        $cocktails = new Cocktails();
        $results = $cocktails->fetchCocktailDetail($id);

        $this->set('cocktail', $results['cocktail']);
        $this->set('cocktails_tags', $results['cocktail']['tags']??[] );
        $this->set('cocktails_elements', $results['cocktails_elements']);
    }

    /**
     * カクテル作成
     *  GET|POST /cocktails/add
     */
    public function add()
    {
        $params = [];
        $errors = [];

        if($this->request->is('POST')){

            $params = $this->request->getData();
            // 登録時処理
            $cocktails = new Cocktails($params);
            $errors = $cocktails->valudateForCreate();
            // バリデエラーがない場合、登録を行う
            if (! $errors) {
                try {
                    $results = $cocktails->saveCocktail();
                    $this->Flash->success(MessageUtil::getMsg(MessageUtil::SAVE_SUCCESS));
                    // 登録完了した場合、詳細画面を表示する
                    return $this->redirect('cocktails/view/' . $results['id']);

                } catch (FileUploadException $e){
                    $this->logger->log($e->getMessage(), LOG_ERR);
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                } catch (\Exception $e) {
                    $this->logger->log($e->getMessage(), LOG_ERR);
                    $this->Flash->error(MessageUtil::getMsg(MessageUtil::SAVE_ERROR));
                }
            } else {
                $this->Flash->error(MessageUtil::getMsg(MessageUtil::VALIDATE_ERROR));
            }
            // バリデエラー、登録エラーがある場合、かつ材料リストがある場合、入力保持のため材料テーブルを作成する
            if (isset($params['element_id_selected'])) {
                $params['cocktails_elements'] = $cocktails->makeElementsTableList();
            }
        }
        // バリデエラー、Exception、画面表示からの遷移の場合は登録画面を表示する
        $this->set(compact('params', 'errors'));
    }

    /**
     * カクテル編集
     * GET|PUT /cocktails/:id/edit
     * @param  $id
     */
    public function edit($id)
    {
        $params = [];
        $errors = [];

        if($this->request->is('GET')){
            // 画面表示。idから検索して登録画面を表示する
            $cocktails = new Cocktails();
            $results = $cocktails->fetchCocktailDetail($id);

            $params = $results['cocktail'];
            $params['cocktails_elements'] = $results['cocktails_elements'];
            // 付いているタグIDは配列にして返却
            $params['tag_id'] = [];
            foreach ($results['cocktail']['cocktails_tags'] as $cocktails_tag){
                $params['tag_id'][] = $cocktails_tag['tag_id'];
            }

        } else if ($this->request->is('POST')){

            $params = $this->request->getData();
            // 登録時処理
            $cocktails = new Cocktails($params);
            $errors = $cocktails->valudateForCreate();
            // バリデエラーがない場合、登録を行う
            if (! $errors) {
                try {
                    $cocktails->saveCocktail();
                    $this->Flash->success(MessageUtil::getMsg(MessageUtil::SAVE_SUCCESS));
                    // 登録完了した場合、詳細画面を表示する
                    return $this->redirect('cocktails/view/' . $id);

                } catch (FileUploadException $e){
                    $this->logger->log($e->getMessage(), LOG_ERR);
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                } catch (\Exception $e) {
                    $this->logger->log($e->getMessage(), LOG_ERR);
                    $this->Flash->error(MessageUtil::getMsg(MessageUtil::SAVE_ERROR));
                }
            } else {
                $this->Flash->error(MessageUtil::getMsg(MessageUtil::VALIDATE_ERROR));
            }
            // バリデエラー、登録エラーがある場合、かつ材料リストがある場合、入力保持のため材料テーブルを作成する
            if(isset($params['element_id_selected'])){
                $params['cocktails_elements'] = $cocktails->makeElementsTableList();
            }
        }
        // バリデエラー、Exception、画面表示の場合は再表示する
        $this->set(compact('params', 'errors'));
    }

    /**
     * カクテル削除
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cocktails = $this->Cocktails->get($id);
        if ($this->Cocktails->delete($cocktails)) {
            $this->Flash->success(__('カクテルを削除しました。'));
        } else {
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * (Ajax用)エレメントのプルダウン制御用
     * GET /cocktails/getElementsOptions/:id
     */
    public function getElementsOptions($category_kbn)
    {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/');
        }

        $cocktails = new Cocktails();
        $elements_list = $cocktails->getElementsList($category_kbn);

        $this->set(compact('elements_list'));
        $this->render('/Element/Cocktails/ajax_elements_options','');
    }

    /**
     * (Ajax用)材料追加用
     * POST /cocktails/mergeElementsTable
     */
    public function mergeElementsTable()
    {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/');
        }
        $params = $this->request->getData();
        // 材料リストに、追加される材料を追加
        $params['element_id_selected'][] = $params['element_id'];
        $params['amount_selected'][] = $params['amount'];

        $cocktails = new Cocktails($params);
        $params['cocktails_elements'] = $cocktails->makeElementsTableList();

        $this->set(compact('params'));
        $this->render('/Element/Cocktails/ajax_elements_table','');
    }

    /**
     * (Ajax用)材料削除用
     * POST /cocktails/deleteElementsTable
     */
    public function deleteElementsTable(){

        if (!$this->request->is('ajax')) {
            return $this->redirect('/');
        }
        $params = $this->request->getData();
        // 材料リストから、削除される材料を削除
        array_splice($params['saved_id'], $params['del_index'], 1);
        array_splice($params['element_id_selected'], $params['del_index'], 1);
        array_splice($params['amount_selected'], $params['del_index'], 1);

        $cocktails = new Cocktails($params);
        $params['cocktails_elements'] = $cocktails->makeElementsTableList();

        $this->set(compact('params'));
        $this->render('/Element/Cocktails/ajax_elements_table','');
    }

    /**
     * {@inheritDoc}
     * @see \App\Controller\AppController::isAuthorized()
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログイン時に許可するアクション
        if (in_array($action, ['edit', 'add', 'delete', 'getElementsOptions', 'mergeElementsTable', 'deleteElementsTable'])) {
            return true;
        }
        return false;
    }

}