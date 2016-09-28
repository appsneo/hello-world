<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectUsers Controller
 *
 * @property \App\Model\Table\ProjectUsersTable $ProjectUsers
 */
class ProjectUsersController extends AppController
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
        $projectUsers = $this->paginate($this->ProjectUsers);

        $this->set(compact('projectUsers'));
        $this->set('_serialize', ['projectUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Project User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectUser = $this->ProjectUsers->get($id, [
            'contain' => ['Companies', 'Projects', 'Users']
        ]);

        $this->set('projectUser', $projectUser);
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectUser = $this->ProjectUsers->newEntity();
        if ($this->request->is('post')) {
            $projectUser = $this->ProjectUsers->patchEntity($projectUser, $this->request->data);
            if ($this->ProjectUsers->save($projectUser)) {
                $this->Flash->success(__('The project user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project user could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectUsers->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectUser', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectUser = $this->ProjectUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectUser = $this->ProjectUsers->patchEntity($projectUser, $this->request->data);
            if ($this->ProjectUsers->save($projectUser)) {
                $this->Flash->success(__('The project user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project user could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectUsers->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectUser', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectUser = $this->ProjectUsers->get($id);
        if ($this->ProjectUsers->delete($projectUser)) {
            $this->Flash->success(__('The project user has been deleted.'));
        } else {
            $this->Flash->error(__('The project user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
