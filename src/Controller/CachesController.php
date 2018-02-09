<?php
namespace App\Controller;

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
        $tagsTable = TableRegistry::get('Tags');
        $tags_master = $tagsTable->find('all', [
            'order' => ['Tags.id' => 'ASC']
        ])->toArray();

        if(Cache::write('tags_master', $tags_master)){
            $this->Flash->success('リロードしました。');
        }else {
            $this->Flash->error('リロードに失敗しました。');
        }
        $this->render($this->referer());
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