<?php
namespace App\Controller;

/**
 * エレメントコントローラ
 * /elements
 * @author hatamasa
 */
class ElementsController extends AppController
{

    /**
     * 初期表示
     * GET /
     */
    public function index()
    {
        $results = $this->Elements->find('all', [
            'order' => ['Elements.category_kbn' => 'ASC', 'Elements.name' => 'ASC']
        ])->toArray();

        $this->set(compact("results"));
    }

    /**
     * カテゴリから材料を検索する
     * GET /search
     * @param $category
     */
    public function search()
    {
        $params = $this->request->getQueryParams();
        $results = $this->Elements->findByCategoryKbn($params['category_kbn'])->toArray();

        $this->set(compact("results"));
        $this->render('index');
    }

    /**
     * 材料詳細表示
     * GET /:id
     * @param $id
     */
    public function show($id)
    {
        $results = $this->Elements->findById($id)->first();

        $this->set(compact("results"));
    }

    /**
     * 材料編集画面表示
     * GET /:id/edit
     * @param $id
     */
    public function edit($id)
    {
        $results = $this->Elements->findById($id)->first();

        $this->set(compact("results"));
    }

    /**
     * 材料作成画面表示
     * GET /add
     */
    public function add()
    {
    }

    /**
     * 材料登録/更新
     * POST /save
     */
    public function save()
    {

    }
}