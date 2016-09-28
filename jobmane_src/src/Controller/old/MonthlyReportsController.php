<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MonthlyReports Controller
 *
 * @property \App\Model\Table\MonthlyReportsTable $MonthlyReports
 */
class MonthlyReportsController extends AppController
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
        $monthlyReports = $this->paginate($this->MonthlyReports);

        $this->set(compact('monthlyReports'));
        $this->set('_serialize', ['monthlyReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Monthly Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $monthlyReport = $this->MonthlyReports->get($id, [
            'contain' => ['Companies', 'Projects', 'Users']
        ]);

        $this->set('monthlyReport', $monthlyReport);
        $this->set('_serialize', ['monthlyReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $monthlyReport = $this->MonthlyReports->newEntity();
        if ($this->request->is('post')) {
            $monthlyReport = $this->MonthlyReports->patchEntity($monthlyReport, $this->request->data);
            if ($this->MonthlyReports->save($monthlyReport)) {
                $this->Flash->success(__('The monthly report has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The monthly report could not be saved. Please, try again.'));
            }
        }
        $companies = $this->MonthlyReports->Companies->find('list', ['limit' => 200]);
        $projects = $this->MonthlyReports->Projects->find('list', ['limit' => 200]);
        $users = $this->MonthlyReports->Users->find('list', ['limit' => 200]);
        $this->set(compact('monthlyReport', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['monthlyReport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Monthly Report id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $monthlyReport = $this->MonthlyReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $monthlyReport = $this->MonthlyReports->patchEntity($monthlyReport, $this->request->data);
            if ($this->MonthlyReports->save($monthlyReport)) {
                $this->Flash->success(__('The monthly report has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The monthly report could not be saved. Please, try again.'));
            }
        }
        $companies = $this->MonthlyReports->Companies->find('list', ['limit' => 200]);
        $projects = $this->MonthlyReports->Projects->find('list', ['limit' => 200]);
        $users = $this->MonthlyReports->Users->find('list', ['limit' => 200]);
        $this->set(compact('monthlyReport', 'companies', 'projects', 'users'));
        $this->set('_serialize', ['monthlyReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Monthly Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $monthlyReport = $this->MonthlyReports->get($id);
        if ($this->MonthlyReports->delete($monthlyReport)) {
            $this->Flash->success(__('The monthly report has been deleted.'));
        } else {
            $this->Flash->error(__('The monthly report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
