<?php
namespace App\Controller;

use App\Model\Common\MessageUtil;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;

/**
 * キャッシュコントローラ
 * @author hatamasa
 */
class CachesController extends AppController
{
    /**
     * マスタキャッシュをリロードする
     */
    public function reloadMaster()
    {
        // タグマスタリロード
        $tagsRepository = TableRegistry::get('Tags');
        $tags_master = $tagsRepository->find('all', [
            'order' => ['Tags.id' => 'ASC']
        ])->toArray();
        // エレメントマスタリロード
        $elementsRepository = TableRegistry::get('Elements');
        $elements_master = $elementsRepository->find('all', [
            'all' => ['Elements.id' => 'ASC', 'Elements.name' => 'ASC']
        ])->toArray();

        if(Cache::write('tags_master', $tags_master) && Cache::write('elements_master', $elements_master)){
            $this->Flash->success('リロードしました。');
        }else {
            $this->Flash->error(MessageUtil::getMsg(MessageUtil::SAVE_ERROR));
        }
        $this->redirect($this->referer());
    }

    /**
     * {@inheritDoc}
     * @see \App\Controller\AppController::isAuthorized()
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログイン時に許可するアクション
        if (in_array($action, ['reloadMaster'])) {
            return true;
        }
        return false;
    }

}