<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users001 Controller
 *
 * @property \App\Model\Table\Users001Table $Users001
 */
class Users001Controller extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users001 = $this->paginate($this->Users001);

        $this->set(compact('users001'));
        $this->set('_serialize', ['users001']);
    }

    /**
     * View method
     *
     * @param string|null $id Users001 id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $users001 = $this->Users001->get($id, [
            'contain' => []
        ]);

        $this->set('users001', $users001);
        $this->set('_serialize', ['users001']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $users001 = $this->Users001->newEntity();
        if ($this->request->is('post')) {
            $users001 = $this->Users001->patchEntity($users001, $this->request->data);
            if ($this->Users001->save($users001)) {
                $this->Flash->success(__('The users001 has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users001 could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('users001'));
        $this->set('_serialize', ['users001']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users001 id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $users001 = $this->Users001->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users001 = $this->Users001->patchEntity($users001, $this->request->data);
            if ($this->Users001->save($users001)) {
                $this->Flash->success(__('The users001 has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users001 could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('users001'));
        $this->set('_serialize', ['users001']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users001 id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $users001 = $this->Users001->get($id);
        if ($this->Users001->delete($users001)) {
            $this->Flash->success(__('The users001 has been deleted.'));
        } else {
            $this->Flash->error(__('The users001 could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
