<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectPeriods Controller
 *
 * @property \App\Model\Table\ProjectPeriodsTable $ProjectPeriods
 */
class ProjectPeriodsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Projects']
        ];
        $projectPeriods = $this->paginate($this->ProjectPeriods);

        $this->set(compact('projectPeriods'));
        $this->set('_serialize', ['projectPeriods']);
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
        $projectPeriod = $this->ProjectPeriods->get($id, [
            'contain' => ['Companies', 'Projects']
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
        $projectPeriod = $this->ProjectPeriods->newEntity();
        if ($this->request->is('post')) {
            $projectPeriod = $this->ProjectPeriods->patchEntity($projectPeriod, $this->request->data);
            if ($this->ProjectPeriods->save($projectPeriod)) {
                $this->Flash->success(__('The project period has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project period could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectPeriods->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectPeriods->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectPeriod', 'companies', 'projects'));
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
        $projectPeriod = $this->ProjectPeriods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectPeriod = $this->ProjectPeriods->patchEntity($projectPeriod, $this->request->data);
            if ($this->ProjectPeriods->save($projectPeriod)) {
                $this->Flash->success(__('The project period has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project period could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ProjectPeriods->Companies->find('list', ['limit' => 200]);
        $projects = $this->ProjectPeriods->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectPeriod', 'companies', 'projects'));
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
        $projectPeriod = $this->ProjectPeriods->get($id);
        if ($this->ProjectPeriods->delete($projectPeriod)) {
            $this->Flash->success(__('期間指定を削除しました'));
        } else {
            $this->Flash->error(__('期間指定の削除に失敗しました'));
        }
        // プロジェクト管理 明細画面に戻る
        $project_id = $this->Session->read('Project.id');
        return $this->redirect(['controller' => 'projects', 'action' => 'edit/' . $project_id]);
    }
}
