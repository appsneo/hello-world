<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectPeriod Controller
 *
 * @property \App\Model\Table\ProjectPeriodTable $ProjectPeriod
 */
class ProjectPeriodController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects']
        ];
        $projectPeriod = $this->paginate($this->ProjectPeriod);

        $this->set(compact('projectPeriod'));
        $this->set('_serialize', ['projectPeriod']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Period id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectPeriod = $this->ProjectPeriod->get($id, [
            'contain' => ['Projects']
        ]);

        $this->set('projectPeriod', $projectPeriod);
        $this->set('_serialize', ['projectPeriod']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectPeriod = $this->ProjectPeriod->newEntity();
        if ($this->request->is('post')) {
            $projectPeriod = $this->ProjectPeriod->patchEntity($projectPeriod, $this->request->data);
            if ($this->ProjectPeriod->save($projectPeriod)) {
                $this->Flash->success(__('The project period has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project period could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectPeriod->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectPeriod', 'projects'));
        $this->set('_serialize', ['projectPeriod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Period id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectPeriod = $this->ProjectPeriod->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectPeriod = $this->ProjectPeriod->patchEntity($projectPeriod, $this->request->data);
            if ($this->ProjectPeriod->save($projectPeriod)) {
                $this->Flash->success(__('The project period has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project period could not be saved. Please, try again.'));
            }
        }
        $projects = $this->ProjectPeriod->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectPeriod', 'projects'));
        $this->set('_serialize', ['projectPeriod']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Period id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectPeriod = $this->ProjectPeriod->get($id);
        if ($this->ProjectPeriod->delete($projectPeriod)) {
            $this->Flash->success(__('The project period has been deleted.'));
        } else {
            $this->Flash->error(__('The project period could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
