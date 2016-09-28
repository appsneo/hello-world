<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Randoms Controller
 *
 * @property \App\Model\Table\RandomsTable $Randoms
 */
class RandomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $randoms = $this->paginate($this->Randoms);

        $this->set(compact('randoms'));
        $this->set('_serialize', ['randoms']);
    }

    /**
     * View method
     *
     * @param string|null $id Random id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $random = $this->Randoms->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('random', $random);
        $this->set('_serialize', ['random']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $random = $this->Randoms->newEntity();
        if ($this->request->is('post')) {
            $random = $this->Randoms->patchEntity($random, $this->request->data);
            if ($this->Randoms->save($random)) {
                $this->Flash->success(__('The random has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The random could not be saved. Please, try again.'));
            }
        }
        $users = $this->Randoms->Users->find('list', ['limit' => 200]);
        $this->set(compact('random', 'users'));
        $this->set('_serialize', ['random']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Random id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $random = $this->Randoms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $random = $this->Randoms->patchEntity($random, $this->request->data);
            if ($this->Randoms->save($random)) {
                $this->Flash->success(__('The random has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The random could not be saved. Please, try again.'));
            }
        }
        $users = $this->Randoms->Users->find('list', ['limit' => 200]);
        $this->set(compact('random', 'users'));
        $this->set('_serialize', ['random']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Random id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $random = $this->Randoms->get($id);
        if ($this->Randoms->delete($random)) {
            $this->Flash->success(__('The random has been deleted.'));
        } else {
            $this->Flash->error(__('The random could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
