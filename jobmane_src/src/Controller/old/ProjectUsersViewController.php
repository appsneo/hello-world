<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectUsersView Controller
 *
 * @property \App\Model\Table\ProjectUsersViewTable $ProjectUsersView
 */
class ProjectUsersViewController extends AppController
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
        $projectUsersView = $this->paginate($this->ProjectUsersView);

        $this->set(compact('projectUsersView'));
        $this->set('_serialize', ['projectUsersView']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Users View id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectUsersView = $this->ProjectUsersView->get($id, [
            'contain' => ['Companies', 'Projects', 'Users']
        ]);

        $this->set('projectUsersView', $projectUsersView);
        $this->set('_serialize', ['projectUsersView']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectUsersView = $this->ProjectUsersView->newEntity();
        if ($this->request->is('post')) {
            $projectUsersView = $this->ProjectUsersView->patchEntity($projectUsersView, $this->request->data);
            if ($this->ProjectUsersView->save($projectUsersView)) {
                $this->Flash->success(__('The project users view has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project users view could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectUsersView->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsersView->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectUsersView->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectUsersView', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['projectUsersView']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Users View id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectUsersView = $this->ProjectUsersView->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectUsersView = $this->ProjectUsersView->patchEntity($projectUsersView, $this->request->data);
            if ($this->ProjectUsersView->save($projectUsersView)) {
                $this->Flash->success(__('The project users view has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project users view could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectUsersView->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsersView->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectUsersView->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectUsersView', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['projectUsersView']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Users View id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectUsersView = $this->ProjectUsersView->get($id);
        if ($this->ProjectUsersView->delete($projectUsersView)) {
            $this->Flash->success(__('The project users view has been deleted.'));
        } else {
            $this->Flash->error(__('The project users view could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
