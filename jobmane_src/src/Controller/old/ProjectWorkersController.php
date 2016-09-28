<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectWorkers Controller
 *
 * @property \App\Model\Table\ProjectWorkersTable $ProjectWorkers
 */
class ProjectWorkersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects', 'Users']
        ];
        $projectWorkers = $this->paginate($this->ProjectWorkers);

        $this->set(compact('projectWorkers'));
        $this->set('_serialize', ['projectWorkers']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Worker id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectWorker = $this->ProjectWorkers->get($id, [
            'contain' => ['Projects', 'Users']
        ]);

        $this->set('projectWorker', $projectWorker);
        $this->set('_serialize', ['projectWorker']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectWorker = $this->ProjectWorkers->newEntity();
        if ($this->request->is('post')) {
            $projectWorker = $this->ProjectWorkers->patchEntity($projectWorker, $this->request->data);
            if ($this->ProjectWorkers->save($projectWorker)) {
                $this->Flash->success(__('The project worker has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project worker could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectWorkers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectWorkers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectWorker', 'projects', 'users'));
        $this->set('_serialize', ['projectWorker']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Worker id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectWorker = $this->ProjectWorkers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectWorker = $this->ProjectWorkers->patchEntity($projectWorker, $this->request->data);
            if ($this->ProjectWorkers->save($projectWorker)) {
                $this->Flash->success(__('The project worker has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project worker could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectWorkers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectWorkers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectWorker', 'projects', 'users'));
        $this->set('_serialize', ['projectWorker']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Worker id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectWorker = $this->ProjectWorkers->get($id);
        if ($this->ProjectWorkers->delete($projectWorker)) {
            $this->Flash->success(__('The project worker has been deleted.'));
        } else {
            $this->Flash->error(__('The project worker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
