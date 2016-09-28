<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
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
    $this->log('ClientsController index()', 'debug');

    $company = $this->Companies->get($company_id, [
      'contain' => []
    ]);

    $clients = $this->Clients->find('all')->where(['company_id' => $company_id]);
    $this->set(compact('clients'));
    $this->set('_serialize', ['clients']);

    $this->set(compact('company'));
    $this->set('back', $this->Session->read("Url.next"));
  }

  /**
   * View method
   *
   * @param string|null $id Client id.
   * @return \Cake\Network\Response|null
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $client = $this->Clients->get($id, [
      'contain' => ['Users']
    ]);

    $this->set('client', $client);
    $this->set('_serialize', ['client']);
  }

  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function add($company_id = null)
  {
    if ($this->request->is('post')) {
      $clients = $this->Clients->newEntities($this->request->data('group-a'));
      foreach($clients as $client) {
        $exist = $this->Clients->exists([
          'id' => $client->repeat_id, 'name' => $client->name
        ]);
        $this->log($exist, 'debug');

        if(!$exist && $client->repeat_id != null) {
          // UPDATE
          $entity = $this->Clients->get($client->repeat_id);
          $entity->name = $client->name;
          $result = $this->Clients->save($entity);
          if ($result) {
            $this->Flash->success(__('取引先情報を更新しました'));
          } else {
            $this->Flash->error(__('取引先情報の更新に失敗しました'));
          }
        }
        if(!$exist && $client->repeat_id == null) {
          // INSERT
          $client['company_id'] = $company_id;
          if($client->name != null && $client->name != "") {
            $result = $this->Clients->save($client);
            if ($result) {
              $this->Flash->success(__('取引先情報を追加しました'));
            } else {
              $this->Flash->error(__('取引先情報を追加に失敗しました'));
            }
          }
        }
      }

      $this->log($clients, 'debug');
      $this->redirect($this->Session->read('Url.next'));
    //  $this->requestAction($this->Session->read('Url.next'));
    //  $urlnext = $this->Session->read('Url.next');


    }
    //$this->set(compact('urlnext'));
    $this->set(compact('$clients'));
    $this->set('_serialize', ['$clients']);
  }

  /**
   * Edit method
   *
   * @param string|null $id Client id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $client = $this->Clients->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $client = $this->Clients->patchEntity($client, $this->request->data);
      if ($this->Clients->save($client)) {
        $this->Flash->success(__('取引先情報を更新しました'));

        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The client could not be saved. Please, try again.'));
      }
    }
    $users = $this->Clients->Users->find('list', ['limit' => 200]);
    $this->set(compact('client', 'users'));
    $this->set('_serialize', ['client']);
  }

  /**
   * Delete method
   *
   * @param string|null $id Client id.
   * @return \Cake\Network\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $client = $this->Clients->get($id);
    if ($this->Clients->delete($client)) {
      $this->Flash->success(__('The client has been deleted.'));
    } else {
      $this->Flash->error(__('The client could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }

}
