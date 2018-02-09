<?php
namespace App\Controller;

use App\Model\Common\MessageUtil;

/**
 * Elements Controller
 *
 * @property \App\Model\Table\ElementsTable $Elements
 *
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElementsController extends AppController
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
        $elements = $this->paginate($this->Elements);

        $this->set(compact('elements'));
    }

    /**
     * View method
     *
     * @param string|null $id Element id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $element = $this->Elements->get($id);

        $this->set('element', $element);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $element = $this->Elements->newEntity();
        if ($this->request->is('post')) {
            $element = $this->Elements->patchEntity($element, $this->request->getData());
            if ($this->Elements->save($element)) {
                $this->Flash->success(__('材料を追加しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }
        $cocktails = $this->Elements->Cocktails->find('list', ['limit' => 200]);
        $this->set(compact('element', 'cocktails'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Element id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $element = $this->Elements->get($id, [
            'contain' => ['Cocktails']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $element = $this->Elements->patchEntity($element, $this->request->getData());
            if ($this->Elements->save($element)) {
                $this->Flash->success(__('材料を編集しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(MessageUtil::getMsg(MessageUtil::SAVE_ERROR)));
        }
        $cocktails = $this->Elements->Cocktails->find('list', ['limit' => 200]);
        $this->set(compact('element', 'cocktails'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Element id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $element = $this->Elements->get($id);
        if ($this->Elements->delete($element)) {
            $this->Flash->success(__('材料を削除しました。'));
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
}
