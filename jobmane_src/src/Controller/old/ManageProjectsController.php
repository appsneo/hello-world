<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ManageProjectsController extends AppController
{

  public function initialize()
  {
    parent::initialize();

//      $this->Users  = TableRegistry('Users');
$this->Users  = TableRegistry::get('Users');
$this->ProjectsUsers  = TableRegistry::get('ProjectsUsers');
$this->Projects = TableRegistry::get('Projects');

//      $this->loadComponent('auth', [
//      'authenticate' => [
  //      'Form' => [
    //      'finder' => 'auth'
      //  ]
    //  ]
//      ]);
  }
  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function index()
  {
      $projects = $this->paginate($this->Projects);
//
      $this->set(compact('projects'));
      $this->set('_serialize', ['projects']);
  }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexWorker()
    {
      $projects = $this->paginate($this->Projects);

      foreach ($projects as $project):
        if($project->start == null) {
          $project->period = "";
        } else {
          $dt = new \DateTime($project->start);
          $project->period = $dt->format('Y/m/d') . '(' . AppUtility::weekjp($dt->format('w')) . ')';
        }
        $project->period .= '〜';
        if($project->end == null) {
          $project->period .= "";
        } else {
          $dt = new \DateTime($project->end);
          $project->period .= $dt->format('Y/m/d') . '(' . AppUtility::weekjp($dt->format('w')) . ')';
        }
      endforeach;

      $this->set(compact('projects'));
      $this->set('_serialize', ['projects']);
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
      $this->log("Projects->CalendarWorker()", 'debug');

        $projects = $this->Projects->find('all');

        $events = array();

        foreach($projects as $project):
          $dt = new \DateTime($project->start);
          $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
          $dt = new \DateTime($project->end);
          $dt_end = $dt->format('Y-m-d') . 'T23:59:00';

          $events[] = array(
            'id' => $project->id,
            'title' => $project->num,
            'className' => "class-a",
            'url' => "project_detail.html",
            'start' => $dt_start,
            'end' => $dt_end
          );
        endforeach;

        $events[] =  array(
          "id"=> "event_a-00",
          "title"=> "Aアパート",
          "className"=> "class-a",
          "url"=> "project_detail.html",
          "start"=> "2016-07-01T00:00:00",
          "end"=> "2016-07-04T23:59:59"
        );
        $events[] =    array(
          "id"=> "event_a-00",
          "title"=> "Aアパート",
          "className"=> "class-a",
          "url"=> "project_detail.html",
          "start"=> "2016-07-06T00:00:00",
          "end"=> "2016-07-12T23:59:59"
        );


        $events[] =  array(
          "id"=> "event_a-00x",
          "title"=> "Xアパート",
          "className"=> "class-a",
          "url"=> "project_detail.html",
          "start"=> "2016-08-08T00:00:00",
          "end"=> "2016-08-14T23:59:59"
        );
        $events[] =  array(
          "id"=> "event_a-00x",
          "title"=> "Xアパート",
          "className"=> "class-a",
          "url"=> "project_detail.html",
          "start"=> "2016-08-19T00:00:00",
          "end"=> "2016-08-30T23:59:59"
        );

        $events[] =  array(
          "id"=> "event_a-00Y",
          "title"=> "Yアパート",
          "className"=> "class-a",
          "url"=> "project_detail.html",
          "start"=> "2016-08-19T00:00:00",
          "end"=> "2016-08-30T23:59:59"
        );

        $events[] =  array(
          "id"=> "event_a-01",
          "title"=> "Cアパート",
          "className"=> "class-c",
          "url"=> "project_detail.html",
          "start"=> "2016-07-09T08:00:00",
          "end"=> "2016-07-25T13:59:59"
        );

    //    $jsonEvents = json_encode($events);
        $this->set(compact('events'));
        $this->set('_serialize', ['events']);

        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }


   /**
    * Index method
    *
    * @return \Cake\Network\Response|null
    */
    public function calendarWorkerEvents()
    {
      $this->log("Projects->CalendarWorkerEvents()", 'debug');
      $events =  array();

      $events[] =  array(
        "id"=> "event_a-00",
        "title"=> "Aアパート",
        "className"=> "class-a",
        "url"=> "project_detail.html",
        "start"=> "2016-07-01T00:00:00",
        "end"=> "2016-07-04T23:59:59"
      );
      $events[] =    array(
        "id"=> "event_a-00",
        "title"=> "Aアパート",
        "className"=> "class-a",
        "url"=> "project_detail.html",
        "start"=> "2016-07-06T00:00:00",
        "end"=> "2016-07-12T23:59:59"
      );
      $events[] =  array(
        "id"=> "event_a-01",
        "title"=> "Cアパート",
        "className"=> "class-c",
        "url"=> "project_detail.html",
        "start"=> "2016-07-06T00:00:00",
        "end"=> "2016-07-12T23:59:59"
      );

      $this->set(compact('events'));
      $this->set('_serialize', ['events']);
//      echo json_encode($events);
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
        $project = $this->Projects->newEntity();
        $this->log("ProjectsController add()", 'debug');

        $users = $this->paginate($this->Users);
//



        if ($this->request->is('post')) {
            $this->log("ProjectsController add() post:", 'debug');
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $project['company_id'] = $this->Auth->user('company_id');
            $this->log($project, 'debug');
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->log("ProjectsController add() GET", 'debug');
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);

        $this->set('mode', 'add');
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
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        $projectsUsers = $this->ProjectsUsers->find('all')
            ->where(['project_id' => $id]);
//        $key = $this->Auth->user('company_id');
////              $this->ProjectsUsers->company_id = 4;
//        $this->ProjectsUsers->deleteAll(['company_id' => $key]);

//        $this->paginate = array('conditions' => ['role' => 'president'], 'order' => ['id' => 'desc']);
//        $users = $this->paginate($this->Users);

        $this->paginate = array('conditions' => ['company_id' => $this->Auth->user('company_id')], 'order' => ['id' => 'desc']);
        $users = $this->paginate($this->Users);


        $this->log('ProjectsController edit()', 'debug');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            var_dump($project);
            $checkboxs = $this->request->data['workers'];
            foreach($checkboxs as $check):
              $this->log($check, 'debug');
            endforeach;
            $this->log('ProjectsController edit() : post', 'debug');
          //  $this->log($result, 'debug');

            if ($this->Projects->save($project)) {
              // delete from projects\users where company_id = $this->Auth->user('company_id') and id in (xx, yy, xx);
              // insert into projects_users values (worker = xx);
              // insert into projects_users values (worker = yy);
              // insert into projects_users values (worker = zz);
              $key = $this->Auth->user('company_id');
//              $this->ProjectsUsers->company_id = 4;
              $this->ProjectsUsers->deleteAll(['company_id' => $key]);
//              [
  //                ['ProjectsUsers.company_id' => $key]
    //          ]);
              foreach($checkboxs as $check):
//                $work = $this->ProjectsUsers->get($check);
  //              if( $work ) {
    //              if ($this->ProjectsUsers->delete($work)) {
      //              $this->Flash->success(__('The user has been deleted.'));
        //          } else {
          //          $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            //      }
              //  }
                $work = $this->ProjectsUsers->newEntity();
                $work['user_id'] = $check;
                $work['company_id'] = $key;
                $work['project_id'] = $project['id'];
                $this->ProjectsUsers->save($work);
                $this->log($work . "  saved.", 'debug');
              endforeach;

              $this->Flash->success(__('The user has been saved.'));
              return $this->redirect(['action' => 'index']);
            } else {
              $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);

        $this->set(compact('projectsUsers'));
        $this->set('_serialize', ['projectsUsers']);

        $this->set('mode', 'edit');
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
