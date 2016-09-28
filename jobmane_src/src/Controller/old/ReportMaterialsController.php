<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReportMaterials Controller
 *
 * @property \App\Model\Table\ReportMaterialsTable $ReportMaterials
 */
class ReportMaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Reports', 'Materials']
        ];
        $reportMaterials = $this->paginate($this->ReportMaterials);

        $this->set(compact('reportMaterials'));
        $this->set('_serialize', ['reportMaterials']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Material id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportMaterial = $this->ReportMaterials->get($id, [
            'contain' => ['Companies', 'Reports', 'Materials']
        ]);

        $this->set('reportMaterial', $reportMaterial);
        $this->set('_serialize', ['reportMaterial']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportMaterial = $this->ReportMaterials->newEntity();
        if ($this->request->is('post')) {
            $reportMaterial = $this->ReportMaterials->patchEntity($reportMaterial, $this->request->data);
            if ($this->ReportMaterials->save($reportMaterial)) {
                $this->Flash->success(__('The report material has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The report material could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ReportMaterials->Companies->find('list', ['limit' => 200]);
        $reports = $this->ReportMaterials->Reports->find('list', ['limit' => 200]);
        $materials = $this->ReportMaterials->Materials->find('list', ['limit' => 200]);
        $this->set(compact('reportMaterial', 'companies', 'reports', 'materials'));
        $this->set('_serialize', ['reportMaterial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Material id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportMaterial = $this->ReportMaterials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportMaterial = $this->ReportMaterials->patchEntity($reportMaterial, $this->request->data);
            if ($this->ReportMaterials->save($reportMaterial)) {
                $this->Flash->success(__('The report material has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The report material could not be saved. Please, try again.'));
            }
        }
        $companies = $this->ReportMaterials->Companies->find('list', ['limit' => 200]);
        $reports = $this->ReportMaterials->Reports->find('list', ['limit' => 200]);
        $materials = $this->ReportMaterials->Materials->find('list', ['limit' => 200]);
        $this->set(compact('reportMaterial', 'companies', 'reports', 'materials'));
        $this->set('_serialize', ['reportMaterial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Material id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportMaterial = $this->ReportMaterials->get($id);
        if ($this->ReportMaterials->delete($reportMaterial)) {
            $this->Flash->success(__('The report material has been deleted.'));
        } else {
            $this->Flash->error(__('The report material could not be deleted. Please, try again.'));
        }

        return $this->redirect('/reports/edit/' . $this->Session->read('Report.id'));
    }
}
