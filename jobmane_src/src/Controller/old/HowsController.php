<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Hows Controller
 *
 * @property \App\Model\Table\HowsTable $Hows
 */
class HowsController extends AppController
{

    public $paginate = [
        'limit' => 3,
        'order' => [
            'id' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $hows = $this->paginate($this->Hows);

        $this->set(compact('hows'));
        $this->set('_serialize', ['hows']);
    }

    /**
     * View method
     *
     * @param string|null $id How id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $how = $this->Hows->get($id, [
            'contain' => []
        ]);

        $this->set('how', $how);
        $this->set('_serialize', ['how']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $how = $this->Hows->newEntity();
        if ($this->request->is('post')) {
            $how = $this->Hows->patchEntity($how, $this->request->data);
            if ($this->Hows->save($how)) {
                $this->Flash->success(__('The how has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The how could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('how'));
        $this->set('_serialize', ['how']);
    }

    /**
     * Edit method
     *
     * @param string|null $id How id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $how = $this->Hows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $how = $this->Hows->patchEntity($how, $this->request->data);
            if ($this->Hows->save($how)) {
                $this->Flash->success(__('The how has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The how could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('how'));
        $this->set('_serialize', ['how']);
    }

    /**
     * Delete method
     *
     * @param string|null $id How id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $how = $this->Hows->get($id);
        if ($this->Hows->delete($how)) {
            $this->Flash->success(__('The how has been deleted.'));
        } else {
            $this->Flash->error(__('The how could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
