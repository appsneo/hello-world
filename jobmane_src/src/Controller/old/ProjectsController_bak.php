<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectsController extends AppController
{

    public function initialize()
    {
      parent::initialize();

//      $this->Users  = TableRegistry('Users');
//      $this->Companies  = TableRegistry::get('Companies');
//      $this->Projects  = TableRegistry::get('Projects');
//      $this->loadComponent('auth', [

      $this->Session = $this->request->session();

  //      'authenticate' => [
    //      'Form' => [
      //      'finder' => 'auth'
        //  ]
      //  ]
//      ]);
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
//        $this->Auth->allow(['logout']);

        $this->log('ProjectController beforeFilter()', 'debug');
    }

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function index()
  {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
  }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexWorker()
    {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
    }


      /**
       * Index method
       *
       * @return \Cake\Network\Response|null
       */
      public function indexWorkers()
      {
  //        $users = $this->paginate($this->Users);

  //        $this->set(compact('users'));
  //        $this->set('_serialize', ['users']);
      }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexWorkerFinished()
    {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexProjects()
    {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
    //    $user = $this->Users->get($id, [
    //        'contain' => []
    //    ]);

      //  $this->set('user', $user);
        //$this->set('_serialize', ['user']);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewProject($id = null)
    {
    //    $user = $this->Users->get($id, [
    //        'contain' => []
    //    ]);

      //  $this->set('user', $user);
        //$this->set('_serialize', ['user']);
    }


        /**
         * Index method
         *
         * @return \Cake\Network\Response|null
         */
        public function calendar()
        {
    //        $users = $this->paginate($this->Users);

    //        $this->set(compact('users'));
    //        $this->set('_serialize', ['users']);
        }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function calendarWorker()
    {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function calendarProjects()
    {
//        $users = $this->paginate($this->Users);

//        $this->set(compact('users'));
//        $this->set('_serialize', ['users']);
    }


        /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $user = $this->Users->newEntity();
  //      if ($this->request->is('post')) {
    //        $user = $this->Users->patchEntity($user, $this->request->data);
      //      if ($this->Users->save($user)) {
        //        $this->Flash->success(__('The user has been saved.'));

  //              return $this->redirect(['action' => 'index']);
    //        } else {
      //          $this->Flash->error(__('The user could not be saved. Please, try again.'));
        //    }
  //      }
    //    $this->set(compact('user'));
      //  $this->set('_serialize', ['user']);
    }


            /**
         * Add method
         *
         * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
         */
        public function addSingle()
        {
    //        $user = $this->Users->newEntity();
      //      if ($this->request->is('post')) {
        //        $user = $this->Users->patchEntity($user, $this->request->data);
          //      if ($this->Users->save($user)) {
            //        $this->Flash->success(__('The user has been saved.'));

      //              return $this->redirect(['action' => 'index']);
        //        } else {
          //          $this->Flash->error(__('The user could not be saved. Please, try again.'));
            //    }
      //      }
        //    $this->set(compact('user'));
          //  $this->set('_serialize', ['user']);
        }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        $user = $this->Users->get($id, [
  //          'contain' => []
    //    ]);
      //  if ($this->request->is(['patch', 'post', 'put'])) {
        //    $user = $this->Users->patchEntity($user, $this->request->data);
          //  if ($this->Users->save($user)) {
            //    $this->Flash->success(__('The user has been saved.'));

              //  return $this->redirect(['action' => 'index']);
//            } else {
  //              $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //        }
      //  }
        //$this->set(compact('user'));
//        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
