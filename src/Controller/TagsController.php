<?php
namespace App\Controller;

use Cake\Cache\Cache;
use App\Model\Common\MessageUtil;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // 全てにログインを必要とする
        $this->Auth->deny();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id);

        $this->set('tag', $tag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->reloadCache();
                $this->Flash->success(__('タグを追加しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }
        $this->set(compact('tag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->reloadCache();
                $this->Flash->success(__('タグを編集しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }
        $this->set(compact('tag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->reloadCache();
            $this->Flash->success(__('タグを削除しました。'));
        } else {
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * {@inheritDoc}
     * @see \App\Controller\AppController::isAuthorized()
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログイン時に許可するアクション
        if (in_array($action, ['index', 'view', 'edit', 'add', 'delete'])) {
            return true;
        }
        return false;
    }

    /**
     * タグマスタのキャッシュリロード
     */
    private function reloadCache()
    {
        $tags_master = $this->Tags->find('all', [
            'order' => ['Tags.id' => 'ASC']
        ])->toArray();
        Cache::write('tags_master', $tags_master);
    }

}
