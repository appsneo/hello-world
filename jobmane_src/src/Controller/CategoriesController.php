<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
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
    $categories = $this->Categories->find('all')->where(['company_id' => $company_id]);

    $this->set(compact('categories'));
    $this->set('_serialize', ['categories']);

    $this->paginate = [
      'contain' => ['Categories']
    ];
    $this->log('CategorieController index()', 'debug');

    $company = $this->Companies->get($company_id, [
      'contain' => []
    ]);

    $categories = $this->Categories->find('all')->where(['company_id' => $company_id]);

    $count = $categories->count();

    $this->set('back', $this->Session->read('Url.next'));
    $this->set(compact('count'));
    $this->set(compact('company'));
  }

  /**
   * View method
   *
   * @param string|null $id Category id.
   * @return \Cake\Network\Response|null
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $category = $this->Categories->get($id, [
      'contain' => ['Companies', 'Projects']
    ]);

    $this->set('category', $category);
    $this->set('_serialize', ['category']);
  }

  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function add($company_id = null)
  {
    if ($this->request->is('post')) {
      $categories = $this->Categories->newEntities($this->request->data('group-a'));
      foreach($categories as $category) {
        $exist = $this->Categories->exists([
          'id' => $category->repeat_id, 'name' => $category->name, 'color' => $category->color,
        ]);
        $this->log("id = " . $category->repeat_id . ",name = " . $category->name, 'debug');
        $this->log("exist = " . $exist, 'debug');
        $this->log("exist = " . $exist, 'debug');

        if(!$exist && $category->repeat_id != null) {
          // UPDATE
          $entity = $this->Categories->get($category->repeat_id);
          $entity->name = $category->name;
          $entity->color = $category->color;
          $result = $this->Categories->save($entity);
          if ($result) {
            $this->Flash->success(__('作業種別を更新しました'));
          } else {
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
          }
        }
        if(!$exist && $category->repeat_id == null) {
          // INSERT
          $category['company_id'] = $company_id;
          if($category->name != null && $category->name != "") {
            $result = $this->Categories->save($category);
            if ($result) {
              $this->Flash->success(__('作業種別を追加しました'));
            } else {
              $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
          }
        }
      }
      $this->log($categories, 'debug');
      $this->redirect($this->Session->read('Url.next'));
    }
    $this->set(compact('$categories'));
    $this->set('_serialize', ['$categories']);
  }

  /**
   * Edit method
   *
   * @param string|null $id Category id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $category = $this->Categories->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $category = $this->Categories->patchEntity($category, $this->request->data);
      if ($this->Categories->save($category)) {
        $this->Flash->success(__('作業種別を更新しました'));

        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The category could not be saved. Please, try again.'));
      }
    }
    $companies = $this->Categories->Companies->find('list', ['limit' => 200]);
    $this->set(compact('category', 'companies'));
    $this->set('_serialize', ['category']);
  }

  /**
   * Delete method
   *
   * @param string|null $id Category id.
   * @return \Cake\Network\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $category = $this->Categories->get($id);
    if ($this->Categories->delete($category)) {
      $this->Flash->success(__('The category has been deleted.'));
    } else {
      $this->Flash->error(__('The category could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }

}
