<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CocktailsElements Controller
 *
 * @property \App\Model\Table\CocktailsElementsTable $CocktailsElements
 *
 * @method \App\Model\Entity\CocktailsElement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CocktailsElementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cocktails', 'Elements']
        ];
        $cocktailsElements = $this->paginate($this->CocktailsElements);

        $this->set(compact('cocktailsElements'));
    }

    /**
     * View method
     *
     * @param string|null $id Cocktails Element id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cocktailsElement = $this->CocktailsElements->get($id, [
            'contain' => ['Cocktails', 'Elements']
        ]);

        $this->set('cocktailsElement', $cocktailsElement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cocktailsElement = $this->CocktailsElements->newEntity();
        if ($this->request->is('post')) {
            $cocktailsElement = $this->CocktailsElements->patchEntity($cocktailsElement, $this->request->getData());
            if ($this->CocktailsElements->save($cocktailsElement)) {
                $this->Flash->success(__('The cocktails element has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cocktails element could not be saved. Please, try again.'));
        }
        $cocktails = $this->CocktailsElements->Cocktails->find('list', ['limit' => 200]);
        $elements = $this->CocktailsElements->Elements->find('list', ['limit' => 200]);
        $this->set(compact('cocktailsElement', 'cocktails', 'elements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cocktails Element id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cocktailsElement = $this->CocktailsElements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cocktailsElement = $this->CocktailsElements->patchEntity($cocktailsElement, $this->request->getData());
            if ($this->CocktailsElements->save($cocktailsElement)) {
                $this->Flash->success(__('The cocktails element has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cocktails element could not be saved. Please, try again.'));
        }
        $cocktails = $this->CocktailsElements->Cocktails->find('list', ['limit' => 200]);
        $elements = $this->CocktailsElements->Elements->find('list', ['limit' => 200]);
        $this->set(compact('cocktailsElement', 'cocktails', 'elements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cocktails Element id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cocktailsElement = $this->CocktailsElements->get($id);
        if ($this->CocktailsElements->delete($cocktailsElement)) {
            $this->Flash->success(__('The cocktails element has been deleted.'));
        } else {
            $this->Flash->error(__('The cocktails element could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
