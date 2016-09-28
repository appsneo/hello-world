<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VProjectUsers Controller
 *
 * @property \App\Model\Table\VProjectUsersTable $VProjectUsers
 */
class VProjectUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Projects', 'Users']
        ];
        $vProjectUsers = $this->paginate($this->VProjectUsers);

        $this->set(compact('vProjectUsers'));
        $this->set('_serialize', ['vProjectUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id V Project User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vProjectUser = $this->VProjectUsers->get($id, [
            'contain' => ['Companies', 'Projects', 'Users']
        ]);

        $this->set('vProjectUser', $vProjectUser);
        $this->set('_serialize', ['vProjectUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vProjectUser = $this->VProjectUsers->newEntity();
        if ($this->request->is('post')) {
            $vProjectUser = $this->VProjectUsers->patchEntity($vProjectUser, $this->request->data);
            if ($this->VProjectUsers->save($vProjectUser)) {
                $this->Flash->success(__('The v project user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The v project user could not be saved. Please, try again.'));
            }
        }
        $companies = $this->VProjectUsers->Companies->find('list', ['limit' => 200]);
        $projects = $this->VProjectUsers->Projects->find('list', ['limit' => 200]);
        $users = $this->VProjectUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('vProjectUser', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['vProjectUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id V Project User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vProjectUser = $this->VProjectUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vProjectUser = $this->VProjectUsers->patchEntity($vProjectUser, $this->request->data);
            if ($this->VProjectUsers->save($vProjectUser)) {
                $this->Flash->success(__('The v project user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The v project user could not be saved. Please, try again.'));
            }
        }
        $companies = $this->VProjectUsers->Companies->find('list', ['limit' => 200]);
        $projects = $this->VProjectUsers->Projects->find('list', ['limit' => 200]);
        $users = $this->VProjectUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('vProjectUser', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['vProjectUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id V Project User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vProjectUser = $this->VProjectUsers->get($id);
        if ($this->VProjectUsers->delete($vProjectUser)) {
            $this->Flash->success(__('The v project user has been deleted.'));
        } else {
            $this->Flash->error(__('The v project user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
