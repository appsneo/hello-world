<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\MaterialsTable $Materials
 */
class MaterialsController extends AppController
{
  public function initialize()
  {
    parent::initialize();

    $this->Companies  = TableRegistry::get('Companies');
    $this->Session = $this->request->session();
  }

  /**
   * Index method
   *
   * @param string|null $id Company_id.
   * @return \Cake\Network\Response|null
   */
  public function index($id = null)
  {
    $company_id = $id;
    $this->paginate = [
      'contain' => ['Companies']
    ];
    $this->log('MaterialsController index()', 'debug');

    $company = $this->Companies->get($company_id, [
                'contain' => []
    ]);

    $materials = $this->Materials->find('all')->where(['company_id' => $company_id]);

    $this->set('back', $this->Session->read('Url.next'));
    $this->set(compact('materials'));
    $this->set('_serialize', ['materials']);
    $this->set(compact('company'));
    }

    /**
     * View method
     *
     * @param string|null $id Material id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('material', $material);
        $this->set('_serialize', ['material']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($company_id = null)
    {
        if ($this->request->is('post')) {
            $materials = $this->Materials->newEntities($this->request->data('group-a'));
            foreach($materials as $material) {
                $exist = $this->Materials->exists([
                          'id' => $material->repeat_id, 'name' => $material->name
                ]);
                $this->log($exist, 'debug');

                if(!$exist && $material->repeat_id != null) {
                    // UPDATE
                    $entity = $this->Materials->get($material->repeat_id);
                    $entity->name = $material->name;
                    $result = $this->Materials->save($entity);
                    if ($result) {
                        $this->Flash->success(__('使用部材を更新しました'));
                    } else {
                        $this->Flash->error(__('The material could not be saved. Please, try again.'));
                    }
                }
                if(!$exist && $material->repeat_id == null) {
                    // INSERT
                    $material['company_id'] = $company_id;
                    if($material->name != null && $material->name != "") {
                      $result = $this->Materials->save($material);
                      if ($result) {
                        $this->Flash->success(__('使用部材を追加しました'));
                      } else {
                        $this->Flash->error(__('The material could not be saved. Please, try again.'));
                      }
                    }
                }

                //$material['company_id'] = $company_id;
            }

            $this->log($materials, 'debug');

            $this->redirect($this->Session->read('Url.next'));
        }

        $this->set(compact('materials'));
        $this->set('_serialize', ['materials']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Materials->patchEntity($material, $this->request->data);
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('使用部材を登録しました'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
        }
    //    $users = $this->Materials->Users->find('list', ['limit' => 200]);
    //    $this->set(compact('material', 'users'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Materials->get($id);
        if ($this->Materials->delete($material)) {
            $this->Flash->success(__('The material has been deleted.'));
        } else {
            $this->Flash->error(__('The material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
