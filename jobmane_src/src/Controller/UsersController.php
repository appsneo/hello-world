<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use \Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
  public $paginate = [
    'fields' => ['id', 'name', 'username', 'password', 'bood_type', 'user_id'],
    'limit' => 5,
    'conditions' => ['role' => '2'],
    'order' => ['id' => 'desc']
  ];

  public $paginateProject = [
    'fields' => ['id', 'name', 'num'],
    'limit' => 5,
    'order' => ['id' => 'desc']
  ];

  public $paginateDummy = [
//    'fields' => ['id', 'name', 'num'],
    'limit' => 5,
//    'order' => ['id' => 'desc']
  ];

  /**
   * Initialize method
   */
  public function initialize()
  {
    parent::initialize();

      $this->Companies  = TableRegistry::get('Companies');
      $this->Projects  = TableRegistry::get('Projects');
      $this->Materials  = TableRegistry::get('Materials');
      $this->Clients  = TableRegistry::get('Clients');
      $this->Categories  = TableRegistry::get('Categories');
      $this->Randoms  = TableRegistry::get('Randoms');
      $this->Confirmed  = TableRegistry::get('Confirmed');
      $this->Reports  = TableRegistry::get('Reports');
      $this->ProjectUsers  = TableRegistry::get('ProjectUsers');

      $this->Session = $this->request->session();
    }

    /**
     * BeforeFilter method
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }

  /**
   * Login method
   *
   * @return \Cake\Network\Response|null
   */
  public function login()
  {
    $user = $this->Users->newEntity();
//    $confirmed_id = 'abc';

    if ($this->request->is(['get'])) {

        // 端末認証
        // 乱数の検索（認証対象なのかのチェック用）
//        $confirm = $this->Confirmed->find('all')
//          ->contain([])
//          ->where([
//            'user_id' => $random->user_id,
//          ])
//          ->order(['created' => 'desc'])
//          ->first();

//        if($confirm) {
//            $confirmed_id = $confirm->confirmed_id;
//        } else {
////            $this->set('confirmed_id', '0');
    //      $this->errror("ユーザー登録で端末認証してください");
//        }
    }


    if ($this->request->is(['patch', 'post', 'put'])) {
      $entity = $this->Users->newEntity($this->request->data, [
        'validate' => 'login'
      ]);
      if($entity->errors ()) {
        $this->set("errors", $entity->errors ());
        $this->set(compact('user'));
        return;
      }


      $user = $this->Auth->identify();
      if ($user) {
      //  $this->log('login: ok identified !!', 'debug');

        $this->Auth->setUser($user);
        //$this->log('login users.role:' . $this->Auth->user('role'), 'debug');

//        if($this->Auth->user('role') == "operator") {

  //      $confirmed = $this->Confirmed->find('all')
    //      ->contain([])
      //    ->where([
        //      'user_id' => $user['id'],
//        //      'company_id' => $user['company_id'],
            //  'confirmed_id' => $this->request->data('confirmed_id'),
      //    ])
        //  ->order(['created' => 'desc'])
          //->first();
        //  $this->log($this->request->data('confirmed_id'),'debug');
          //$this->log('▲','debug');


        //  if($confirmed && $confirmed->checked == true) {
              // OK
              if($user['role'] == "president" || $user['role'] =="supervisor") {
                return $this->redirect("/Menu/index");
              } else {
                return $this->redirect("/users/confirm/" . $user['id']);
              }
        //  }else {
          //  $this->Flash->error("端末認証に失敗しました");
        //  }
      //} else {

        //  // OK
          //return $this->redirect("/Menu/index");
//      }


     } else {

//        $errors = [
  //        'password' => [
    //        '_empty' => 'ID または パスワード が間違っています'
      //    ]
        //];
//        $this->set(compact('errors'));
        $this->Flash->error("ID または パスワード が違います\n あるいは\n アクティブで無いユーザーです");
        //$user = $entity;
      //t\}
    }
}
    $status= ['url' => [
        'from' => 'login'
      ]
    ];
    // 端末承認結果
  //  $this->set('confirmed_id');
  //  $this->set('confirmed_result', '0');
    $this->set('status', $status);
    $this->set(compact('user'));
  }

  /**
   * Confirm method
   *
   * @return \Cake\Network\Response|null
   */
  public function confirm($id = null)
  {
    $user_id = $id;

//    $user = $this->Users->get($id);

    if ($this->request->is(['get'])) {

  //    $confirmed = $this->Confirmed->find('all')
    //    ->contain([])
      //  ->where([
        //    'user_id' => $id,
//              'company_id' => $user['company_id'],
          //  'confirmed_id' => $this->request->data('confirmed_id'),
  //      ])
    //    ->order(['created' => 'desc'])
      //  ->first();
        //$this->log($this->request->data('confirmed_id'),'debug');
      //  $this->log('▲','debug');


        // 端末認証
        // 乱数の検索（認証対象なのかのチェック用）
//        $confirm = $this->Confirmed->find('all')
//          ->contain([])
//          ->where([
//            'user_id' => $random->user_id,
//          ])
//          ->order(['created' => 'desc'])
//          ->first();

//        if($confirm) {
//            $confirmed_id = $confirm->confirmed_id;
//        } else {
////            $this->set('confirmed_id', '0');
    //      $this->errror("ユーザー登録で端末認証してください");
//        }
    }


    if ($this->request->is(['patch', 'post', 'put'])) {

      $confirmed_id = $this->request->data('confirmed_id');
      $this->log('★', 'debug');
      $this->log($confirmed_id, 'debug');
//      $entity = $this->Users->newEntity($this->request->data, [
  //      'validate' => false
    //  ]);
//      if($entity->errors ()) {
  //      $this->set("errors", $entity->errors ());
    //    $this->set(compact('user'));
      //  return;
    //  }


      //$user = $this->Auth->identify();
      //if ($user) {
        //$this->log('login: ok identified !!', 'debug');

      //  $this->Auth->setUser($user);
        //$this->log('login users.role:' . $this->Auth->user('role'), 'debug');

      //  if($this->Auth->user('role') == "operator") {

        $confirmed = $this->Confirmed->find('all')
          ->contain([])
          ->where([
              'user_id' =>  $this->request->data('user_id'),
              'confirmed_id' => $this->request->data('confirmed_id'),
          ])
          ->order(['created' => 'desc'])
          ->first();
          $this->log($this->request->data('confirmed_id'),'debug');
          $this->log('▲','debug');
          $this->log('■','debug');
          $this->log($this->request->data('user_id'),'debug');
          $this->log($confirmed_id,'debug');
          $this->log($confirmed,'debug');

        if($confirmed == null || $confirmed_id == '' || $confirmed_id == 'null') {
          $this->Flash->error("端末認証に失敗しました");
          return $this->redirect("/users/login");
        } elseif($confirmed) {

          //$confirm->company_id = $user_up->company_id;
          $confirmed->checked = 1;
          $result = $this->Confirmed->save($confirmed);
          if(!$result) {
              throw new Exception("承認ID の登録に失敗しました");
          }
          // OK
          return $this->redirect("/menu/index");
        }else {
          $this->Flash->error("端末認証に失敗しました");
          return $this->redirect("/users/login");
        }
    }

    $this->set(compact('user_id'));
  }

    /**
     * Logout method
     *
     * @return \Cake\Network\Response|null
     */
    public function logout()
    {
        $this->log('logout', 'debug');

        $this->request->session()->destroy();

        return $this->redirect($this->Auth->logout());
    }

  /**
   * Password method
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function password($id = null)
  {
    if($id == null) {
      $user_id = $this->Session->read('Url.user_id');
    } else {
      $user_id = $id;
    }

    if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['company_id'])) {
//      $validator = new Validator();
//      $err = $validator->errors($this->request->data);

      $entity = $this->Users->newEntity($this->request->data, [
        'validate' => 'password'
      ]);

      if($entity->errors ()) {
        $this->set("errors", $entity->errors ());
//        $this->Flash->error(__('パスワードの更新に失敗しました'));
        //return;
      } else {
        // 既存のパスワードと比較する
        $user = $this->Users->get($user_id);

        $result = password_verify($entity->password01, $user->password);
        $this->log('▼', 'debug');
        $this->log($result, 'debug');

//        if($entity==null || password_hash($entity->password01, PASSWORD_BCRYPT) != $user->password) {
       if($result == false) {
          $this->Flash->error(__('既存のパスワードと異なります'));
        } else {

          // 保存する
          $update = $this->Users->query()->update();
          $update->set(['password' => password_hash($entity->password02,PASSWORD_DEFAULT)]);
          $update->where(['id' => $user_id]);
          $rtn = $update->execute();

          if ($rtn) {
            $this->Flash->success(__('パスワードを更新しました'));
          } else {
            $this->Flash->error(__('パスワードの更新に失敗しました'));
          }

          if($this->Session->read('Url.from') == "edit") {
            return $this->redirect(['action' => 'edit/' . $user_id]);
          } else {
            return $this->redirect(['action' => 'edit-president/' . $user_id]);
          }
        }
      }
    }

    $this->set(compact('user_id'));
    $this->set('_serialize', ['user_id']);
  }


    public function contents($id = null)
    {
//          $this->log('■■ contents:'. $id, 'debug');
//              $buf = file_get_contents("/work/imgs/default_avatar.png");

    //    $buf = "dummy";
      //  if($id == null) {
      try{
            $user = $this->Users->get($id);
            if($user->image == null) {
              $buf = file_get_contents("/work/imgs/default_avatar.png");
            } else {
                $buf = stream_get_contents($user->image);
            }
        //}
      } catch(Exception $e) {
            $buf = file_get_contents("/work/imgs/default_avatar.png");
            $this->Flash->error($id . ' : ' . $e->getMessage());
      //      $this->log('exception:' . $e->getMessage(), 'debug');
          //$connection->rollback();
      }

        //      if($buf === false) {
          //$this->log($buf, 'debug');
//      }

      $this->autoRender = false;
      $this->response->type('image/jpeg');
      $this->response->body($buf);
//      $this->response->body(stream_get_contents($user->image));
//          $this->log('contents:'. $id . " end.", 'debug');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      $this->log('index()', 'debug');
      $this->Session->write('Url.next', '/users/index');

      if ($this->Auth->user()) {
        $company_id = $this->Auth->user('company_id');
        $this->set(compact('company_id'));
      }
      $users = $this->Users->find('all')
        ->contain([])
        ->where([
          'company_id' => $this->Auth->user('company_id'),
          'role' => 'operator',
        ])
        ->order(['id' => 'desc']);


//      $this->paginate = array('conditions' => ['role' => 'operator', 'company_id' => $company_id], 'order' => ['id' => 'desc']);
//      $users = $this->paginate($this->Users);

        $this->set('from', 'index');

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function indexPresident()
  {
    $this->log('index()', 'debug');
    // Url遷移情報
    $this->Session->write('Url.next', '/users/index-president');
//    $this->Session->write('Url.from', 'index-president');
    $this->set('from', 'index-president');

    $this->paginate = array('conditions' => ['role' => 'president'], 'order' => ['id' => 'desc']);
    $users = $this->paginate($this->Users);


    $this->set(compact('users'));
    $this->set('_serialize', ['users']);

    $this->render('index');
  }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexProject($id = null)
    {
      $this->paginate = [
          'fields' => ['id', 'project_name', 'num'],
          'limit' => 10,
          'order' => ['id' => 'desc']
      ];
      $user = $this->Users->get($id);

      $projects = $this->paginate($this->Projects->find('all')
//        ->contain(['ProjectUsers'])
        ->where([
          'Projects.company_id' => $this->Auth->user('company_id'),
  //        'Projects.project_users.user_id' => $id,
//          'ProjectUsers.user_id' => $id,
        ])
        ->order(['Projects.id' => 'desc'])
      );


      $this->paginate = [
        'fields' => ['Projects.id', 'Users.name'],
          'limit' => 10,
      ];

      $projectUsers = $this->paginate($this->ProjectUsers->find('all')
        ->contain(['Projects','Users'])
        ->select([
        'Projects.project_name',
        'Projects.num',
        'Users.name',

        ])
        ->where([
          'ProjectUsers.company_id' => $this->Auth->user('company_id'),
          'ProjectUsers.user_id' => $id,
          'Projects.completion_check' => false,
        ])
    //    ->order(['id' => 'desc'])
      );

      $this->Session->write('Url.from', 'index-project');
      $this->set('from', 'index-project');

//      $this->paginate($this->Users);
//
$this->set(compact('projectUsers'));
$this->set(compact('user'));
      $this->set(compact('projects'));
      $this->set('_serialize', ['projects']);
    }


        /**
         * Index method
         *
         * @return \Cake\Network\Response|null
         */
        public function indexProjectFinished($id = null)
        {
          $this->paginate = [
              'fields' => ['id', 'project_name', 'num'],
              'limit' => 10,
              'order' => ['id' => 'desc']
          ];
          $user = $this->Users->get($id);

          $projects = $this->paginate($this->Projects);



                $this->paginate = [
                  'fields' => ['Projects.id', 'Users.name'],
                    'limit' => 10,
                ];

                $projectUsers = $this->paginate($this->ProjectUsers->find('all')
                  ->contain(['Projects','Users'])
                  ->select([
                  'Projects.project_name',
                  'Projects.num',
                  'Users.name',

                  ])
                  ->where([
                    'ProjectUsers.company_id' => $this->Auth->user('company_id'),
                    'ProjectUsers.user_id' => $id,
                    'Projects.completion_check' => true,
                  ])
              //    ->order(['id' => 'desc'])
                );
          $this->Session->write('Url.from', 'index-project');
          $this->set('from', 'index-project');

    //      $this->paginate($this->Users);
    //
    $this->set(compact('projectUsers'));
          $this->set(compact('user'));
          $this->set(compact('projects'));
          $this->set('_serialize', ['projects']);
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
        $user = null;
        if ($id != null) {
      //      return;
        //}

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
      }

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }




    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Session->write('Url.from', 'add');
        $this->set('from', 'add');

        $this->edit("add");
    }


  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function addPresident()
  {
    $this->Session->write('Url.next', 'add-president');
    $this->Session->write('Url.from', 'add-president');
    $this->set('from', 'add-president');

    $this->editPresident("add");

  }

  /**
   * Edit method
   *
   * Add() 処理と共通使用
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    if($id === "add") {
      $mode = "add";
      $next = "/users/add";
    } else {
      $mode = "edit";
      $next = "/users/edit/" . $id;
      $this->set('next', $this->Session->read('Url.next'));
      $this->Session->write('Url.from',"edit");
   }
    $this->set(compact('mode'));
    $this->set(compact('next'));

    // 管理者のメールアドレス取得用
    $president = $this->Auth->user;

//    if ($id==="add" && $this->request->is(['get'])) {
    if($id === 'add' && null != $this->request->data('urlfrom')) {

      $this->Session->write('next', '/users/add/');
      // Add の初回時
      $user = $this->Users->newEntity([
        'contain' => []
      ]);
      // アクティブ　初期値 = true
      $user->status = true;


    } elseif (($id!=="add" && $this->request->is(['get'])) ||
      ($id!=="add" &&  isset($this->request->data['urlfrom']))) {

//    } elseif ($id!=="add" && $this->request->is(['post']) &&
//        isset($this->request->data['urlfrom'])) {

      $this->Session->write('next', '/users/edit/' . $id);
      // Edit の初回時
      if($id != null) {
        // DB から read.
        $user = $this->Users->get($id, [
          'contain' => []
        ]);
      }

    } elseif ($this->request->is(['patch', 'post', 'put']) &&
              !isset($this->request->data['urlfrom'])) {
                  // Post 時： Add と Edit で共通
      if( $id === "add") {
        $user = $this->Users->newEntity([
          'contain' => []
        ]);
        $this->Session->write('Url.user_id', $id);
  //      $user->action = "add";
      } else {
        $user = $this->Users->get($id, [
          'contain' => []
        ]);
      //  $user->action = "edit";
      }

      $data = $this->Users->patchEntity($user, $this->request['data'], [
        'validate' => 'update'
      ]);

      // アカウント状態
      if($user['account_status'] == "account_on") {
        $user['status'] = true;
      } else {
        $user['status'] = false;
      }

      if($data->errors ()) {
        // Validation-Error
        $this->set("errors", $data->errors ());
        // invalid な項目値を再設定する
        $data = $this->Users->patchEntity($user, $this->request['data'], [
          'validate' => false
        ]);

      } else {
        if($data) {
          // Request --> DB 形式に変換
          $user = AppUtility::convertDate($data, $data);
          $user['company_id'] = $this->Auth->user('company_id');
          $user->role = "operator";

          try{
            // トランザクション
            $connection = ConnectionManager::get('default');
            $connection->begin();

            //  保存する
            $this->log('■ user save', 'debug');
//            $user->image=null;
            $user_up = $this->Users->save($user);
            if ($user_up) {
              $this->Flash->success(__('ユーザー情報を登録しました'));

              // 最初の作業員登録時に
              if( $id==="add") {
                //$user = $this->Users->get($id);
                // 乱数の発生
                $rnd = md5($user_up->id . date("Ymd His"));

                $random = $this->Randoms->newEntity();
                $random->user_id = $user_up->id;
                //$random->company_id = $user_up->company_id;
                $random->random = $rnd;
                $random->expiring_date = date('Y-m-d G:i:s');
                $result = $this->Randoms->save($random);
                if(!$result) {
                    throw new Exception("ＵＲＬランダム数値の保存に失敗しました");
                }
                //$user = $this->Users->get($id);
                // 認証番号の発生
                $rnd2 = md5($user_up->id . date("Y/m/d H:i:s"));

                $confirm = $this->Confirmed->newEntity();
                $confirm->user_id = $user_up->id;
                //$confirm->company_id = $user_up->company_id;
                $confirm->confirmed_id = $rnd2;
                $confirm->checked = 0;
                $confirm->expired_date = date('Y-m-d G:i:s');
                $result = $this->Confirmed->save($confirm);
                if(!$result) {
                    throw new Exception("承認ID の登録に失敗しました");
                }

                //                  "  http://jobmane.japanwest.cloudapp.azure.com:8000/regist/authentication/" .

                $company = $this->Companies->get($user['company_id']);
                $body = "" . $company->name . "\n" . $user->name .
                  " 様\n\n" .
                  "【業務管理システム　デバイス認証のお願い】\n" .
                  " 下記ＵＲＬにアクセスし、デバイス認証を行ってください。\n\n" .
                   "  http://www.jobmane.info/regist/authentication/" .
                  $rnd . "\n\n".
                  "ログイン用の情報は、別途お渡しいたします。\n\n" .
                  "よろしくお願いいたします。";

                // 端末承認の為のメールを作業員に送付する
                $e_mail = new Email('default');

                $e_mail->to([$user->email => $user->name])
                  ->from([$this->Auth->user('email') => $this->Auth->user('name')])
                  ->subject('業務管理システム【デバイス認証のお願い】')
                  ->send( $body );
                $this->log('Email:' , 'debug');

                //  メールタイトル：
                //業務管理システム【デバイス認証のお願い】
                //
                //メール本文：
                //会社名
                //○○ 様
                //
                //【業務管理システム　デバイス認証のお願い】
                //下記ＵＲＬにアクセスし、デバイス認証を行ってください。
                //http://xxx.xx.xx
                //
                //ログイン用の情報は、別途お渡しいたします。
                //
                //よろしくお願いいたします。
              }
              // 正常時
              $connection->commit();
              return $this->redirect(['action' => 'index']);
            } else {
              // save() に失敗
              $this->set("errors", $user->errors ());
              throw new Exception("ユーザー情報の保存に失敗しました");
            }

          } catch(Exception $e) {
            $this->Flash->error($e->getMessage());
            $connection->rollback();
          }

        } else {
          // validate error 時
          $this->set("errors", $data->errors ());
        }
      }
    }

//    $this->log($user, 'debug');
    $this->set(compact('user'));
    $company = $this->Companies->newEntity();
    $this->set(compact('company'));
    $this->set(compact('email'));

    $this->render('edit');
  }

  /**
   * editPresident method
   *
   * 会社情報と管理者情報を表示・保存する
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function editPresident($id = null)
  {
//    $this->Session->write('Url.next', '/users/add');
    if($id === 'add'):
      $mode = "add-president";
      $next = "/users/add-president";

      $this->set('Url', [
        'controller' => 'users',
        'action' => 'add-president',
        'next', '/users/add-president/'
      ]);
    else:
      $mode = "edit-president";
      $next = "/users/edit-president/" . $id;
      $this->Session->write('Url.next', $next);
      $this->Session->write('Url.from',"edit-president");


      if($this->request->is(['get'])) {
//        $this->Session->write('Url.next', '/users/edit-president/' . $id);
  //      $this->set('Url', [
    //      'controller' => 'users',
      //    'action' => 'edit-president',
        //  'next', '/users/edit-president/' . $id,
      //  ]);
      } else {
        //$id->Session->read('Url.next');
    //    $this->set('Url', [
      //    'controller' => 'users',
        //  'action' => 'edit-president',
          //'next' => $id->Session->read('Url.next'),
      //  ]);
      }
    endif;

    $this->set(compact('mode'));
    $this->set(compact('next'));
    $this->set(compact('Url'));


    if($id === 'add' && null != $this->request->data('urlfrom')) {  //} && $this->request->is(['get'])) {
      // ADD 初回
      $user = $this->Users->newEntity();
      // アクティブ　初期値 = true
      $user->status = true;
//      $user->action = "add";
  //    $user->next = "add";
      $company = $this->Companies->newEntity();
//      $this->Session->write('Url.from', 'add');
    }
    elseif(($id !== 'add' && $this->request->is(['get'])) ||
           ($id !== 'add' && $this->request->is(['post'])) && null != $this->request->data('urlfrom'))
    {
      // EDIT 初回
      $user = $this->Users->get($id, [
        'contain' => []
      ]);

      $this->Session->write('Url.user_id', $id);
    //  $user->action = "edit";
      //$user->next = "edit";
      $company = $this->Companies->get($user->company_id, [
        'contain' => []
      ]);
    }
    elseif ($this->request->is(['patch', 'post', 'put']))
    {
      $from = $this->Session->read('Url.from');
//      $next = $this->request->data['next'];

      if($from=="add-president") {
        // add ２回目以降
        $user = $this->Users->newEntity();
        $company = $this->Companies->newEntity();
    //    $user->action = "add";
      //  $user->next = "add";
        $this->Session->write('Url.from', 'add');
      } else {
        // edit ２回目以降
        $user = $this->Users->get($id);
        $company = $this->Companies->get($user->company_id);
        $this->Session->write('Url.user_id', $id);
//        $user->action = "edit";
  //      $user->next = "edit";
        $this->Session->write('Url.from', 'edit');
      }
      // 管理者情報と会社情報の両方をValidate check.
      $user = $this->Users->patchEntity($user, $this->request->data, [
        'validate' => 'President'
      ]);
      if($user->errors ()) {
        // Validate Error 時
        $this->set("errors", $user->errors ());
        // invalid な項目値を再設定する
        if($id == "add") {
          $data = $this->Users->patchEntity($user, $this->request['data'], [
            'validate' => false
          ]);
        } else {
          $data = $user;
        }
        // 「requestデータ」 を 「DBデータ」 に変換する
        // 年月日の変換用メソッド：最新健康診断年月日、入所年月日、退社年月日、生年月日、血液型
        $user = AppUtility::convertDate($user, $data);
        $user->role = "president";
        $company = AppUtility::convertCompanyData($company, $data);

      } else {
        // Validate 成功時
        // 「requestデータ」 を 「DBデータ」 に変換する
        $data = $this->request->data;
//      $this->log('▲', 'debug');
  //    $this->log($data, 'debug');
    //  $this->log('▼', 'debug');
  //    $this->log($user, 'debug');
      // 年月日の変換用メソッド：最新健康診断年月日、入所年月日、退社年月日、生年月日、血液型
        $user = AppUtility::convertDate($user, $data);
//      $user['email'] = $data['email'];
        $user->role = "president";
//      $user->email = $this->request->data['email'];
      // アカウント状態
  //    if($user['account_status'] == "account_on") {
    //    $user['status'] = true;
      //} else {
        //$user['status'] = false;
//      }
        $company = AppUtility::convertCompanyData($company, $data);

/*
      // 会社名
      $company['name'] = $data['company_name'];
      // 早出手当金額
      $company['shift_pay'] = str_replace("," , "", $data['hourly_pay']);

      // 残業手当金額　
      $company['overtime_pay'] = str_replace("," , "", $data['hourly_pay2']);
      // 早出手当の有無
      if( $data['early_shift_allowance'] == "有") {
        $company['shift_exist'] = true;
      }
      if( $data['early_shift_allowance'] == "無") {
        $company['shift_exist'] = false;
      }
      // 残業手当の有無
      $this->log($data['early_shift_allowance'], "debug");
      if( $data['early_shift_allowance2'] == "有") {
        $company['overtime_exist'] = true;
      }
      if( $data['early_shift_allowance2'] == "無") {
        $company['overtime_exist'] = false;
      }
      // 始業時間
      $hour = $data['time1'];
      $min = $data['minute1'];
      $tm = $hour. ":" . $min . ':00' ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $tm = new \DateTime($tm);
        $company['start_time'] = $tm;
      } else {
        $company['start_time'] = null;
      }
      // 終業時間
      $hour = $data['time2'];
      $min = $data['minute2'];
      $tm = $hour. ":" . $min . ':00'  ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $tm = new \DateTime($tm);
        $company['end_time'] = $tm;
      } else {
        $company['end_time'] = null;
      }
      // 休憩時間
      $company['rest_minutes'] = $data['rest_minutes'];
      // 早出手当の支払時刻
      $hour = $data['time3'];
      $min = $data['minute4'];
      $tm = $hour. ":" . $min . ':00'  ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $tm = new \DateTime($tm);
        $company['shift_time'] = $tm;
      } else {
        $company['shift_time'] = null;
      }
      // 残業手当の開始時刻
      $hour = $data['time4'];
      $min = $data['minute5'];
      $tm = $hour. ":" . $min . ':00'  ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $tm = new \DateTime($tm);
        $company['overtime_time'] = $tm;
      } else {
        $company['overtime_time'] = null;
      }
*/
//      $this->log($user, 'debug');
  //    if($user->errors ()) {
//        // Validate Error 時
  //      $this->set("errors", $user->errors ());
    //    // invalid な項目値を再設定する
      //  $data = $this->Users->patchEntity($user, $this->request['data'], [
  //        'validate' => false
    //    ]);
    //  }
      //else
    //  {
        // トランザクション
        $connection = ConnectionManager::get('default');
        $connection->begin();
        try{
          $this->log($company, 'debug');
          // ■ 会社情報の保存
          $company_up = $this->Companies->save($company);
          if (!$company_up) {
            // save() に失敗
            $this->set("errors", $company->errors ());
            throw new Exception("会社情報の保存に失敗しました");
          } else {
            // 会社情報保存の成功時
            // 会社ID
            $user['company_id'] = $company_up->id;
            // role
            $user['role'] = 'president';
            // ■ 管理者情報の保存
            $user_up = $this->Users->save($user);
//          }
            if(!$user_up) {
              // 会社情報保存の失敗時
              // Flash error
              // save() に失敗
              $this->set("errors", $user->errors ());
//              $this->Flash->error('会社情報の保存に失敗しました');
              throw new Exception("会社情報の保存に失敗しました");
            } else {
              // 保存成功時
              $connection->commit();
            //  $this->Flash->success(__('管理者情報を更新しました'));
              // 保存成功時
          //    if($user_up) {
              // 管理者情報保存の成功時
              $this->log('管理者情報保存の成功 !!', 'debug');
//              if($id == "add"):
  //              $this->Flash->success(__('管理者情報を登録しました'));
    //          else:
      //          $this->Flash->success(__('管理者情報を更新しました'));
        //      endif;
              $next = $this->request->data['next'];
              if($next == "materials") {
                $this->Session->write('Url.next', '/users/edit-president/' . $user_up->id);
                return $this->redirect("/materials/index/" . $company_up->id);
              } elseif($next == "clients") {
                $this->Session->write('Url.next', '/users/edit-president/' . $user_up->id);
                return $this->redirect("/clients/index/" . $company_up->id);
              } elseif($next == "categories") {
                $this->Session->write('Url.next', '/users/edit-president/' . $user_up->id);
                return $this->redirect("/categories/index/" . $company_up->id);
              } else {

              if($id == "add"):
                $this->Flash->success(__('管理者情報を登録しました'));
              else:
                $this->Flash->success(__('管理者情報を更新しました'));
              endif;

                if($this->Session->read('Url.next') == '/menu') {
                  return $this->redirect('/menu');
                } else if($this->Auth->user('role') == 'supervisor'){
                  return $this->redirect(['action' => 'index-president']);
                } else {
                  return $this->redirect('/menu');
                }
              }
            //} else {
  //          }

    //        } else {
            }
          }
        } catch(Exception $e) {
          $this->Flash->error($e);
          $connection->rollback();
          //return $this->redirect(['action' => 'index-president']);
        }
      }
    }

    if($company == null) {
      $company_id = 0;
      $materials = $this->Materials->newEntity();
      $clients = $this->Clients->newEntity();
      $categories = $this->Categories->newEntity();
    } else {
      $company_id = $company->id;
      // 使用部材の一覧取得
      $materials = $this->Materials->find('all')
        ->contain([])
        ->where([
          'company_id' => $company_id,
        ])
        ->order(['id' => 'asc']);

      // 取引先の一覧取得
      $clients = $this->Clients->find('all')
        ->contain([])
        ->where([
          'company_id' => $company_id,
        ])
        ->order(['id' => 'asc']);

      // 作業区分の一覧取得
      $categories = $this->Categories->find('all')
        ->contain([])
        ->where([
          'company_id' => $company_id
        ])
        ->order(['id' => 'asc']);
    }

    $this->set(compact('materials'));
    $this->set(compact('clients'));
    $this->set(compact('categories'));

    // 管理者情報
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
    // 会社情報
    $this->set(compact('company'));
    $this->set('_serialize', ['company']);

    $this->render('edit');
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
    $this->log('delete(' . $id . ')', 'debug');
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    $role = $user->role;
    $company_id = $user->company_id;
    $this->log('★', 'debug');
    $this->log($role, 'debug');

    try{
      // トランザクション
      $connection = ConnectionManager::get('default');
      $connection->begin();

      if($role == 'operator'):
        // ProjectUsers に含まれていると削除できない
        // Reports を提出していると削除できない
        $projectUsers = $this->ProjectUsers->find('all')
          ->contain([])
          ->where([
            'company_id' => $company_id,
            'user_id' => $user->id,
          ])
          ->first();

        if($projectUsers) {
          $this->log('in project', 'debug');
          throw new Exception("プロジェクトに参加している作業員は削除できません");
//        $this->Flash->error('プロジェクトに組み込まれている作業員は削除できません');
        } else {
          $this->log('no project', 'debug');
////            $this->set('confirmed_id', '0');
  //      $this->errror("ユーザー登録で端末認証してください");
        }

        // Reports を提出していると削除できない
        $reports = $this->Reports->find('all')
          ->contain([])
          ->where([
            'company_id' => $company_id,
            'user_id' => $user->id,
          ])
          ->first();

        if($reports) {
          $this->log('in report', 'debug');
          throw new Exception("日報を提出している作業員は削除できません");
//        $this->Flash->error('プロジェクトに組み込まれている作業員は削除できません');
        } else {
          $this->log('no report', 'debug');
////            $this->set('confirmed_id', '0');
  //      $this->errror("ユーザー登録で端末認証してください");
        }
      endif;


      if ($this->Users->delete($user)) {
        $this->Flash->success(__($user->name . ' さんの情報を削除しました'));
      } else {
        throw new Exception(__($user->name . ' さんの情報を削除できません'));
      }
      if($role == 'president'):
        // Companies 削除
        // Materials 削除
        // Clients 削除
        // Categories 削除
        // Projects 削除
        // ProjectUsers 削除
        // Reports 削除
        // ReportMaterials 削除
        // MonthlyReports 削除
      endif;
//    $puser = $this->ProjectUsers->query()->delete();
//    $puser->where(['user_id' => $di ]);
//    if ($puse->exedute()) {
//      $this->Flash->success(__($user->name . ' さんの情報を削除しました'));
//    } else {
//      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
//    }
    // 管理者一覧の取得と設定
//    $users = $this->Users->find('all')
//      ->contain([])
//      ->where([
//        'company_id' => $this->Auth->user('company_id'),
//        'role' => 'operator',
//        'completion_check' => 0,
//      ])
//      ->order(['id' => 'asc']);

//        $this->Flash->success(__($user->name . ' さんの情報を削除しました'));
        $connection->commit();

      } catch(Exception $e) {
        $this->Flash->error($e->getMessage());
        $connection->rollback();
      }

      if($role == 'operator') {
        return $this->redirect(['action' => 'index']);
      } else {
        return $this->redirect(['action' => 'index-president']);
      }

  }


  /**
   * DeletePresident method
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function deletePresident($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $errors = [
        'deleted' => [
        '_empty' => $user->name . ' さんの情報を削除しました'
        ]
      ];
      $this->set(compact('errors'));
        $this->Flash->success(__($user->name . ' さんの情報を削除しました'));
      } else {
        $this->Flash->error(__($user->name . ' さんの情報削除に失敗しました'));
      }
      // 管理者一覧の取得と設定
      $users = $this->Users->find('all')
        ->contain([])
        ->where([
          'company_id' => $this->Auth->user('company_id'),
          'role' => 'president',
          'completion_check' => 0,
        ])
        ->order(['id' => 'asc']);

      $this->set(compact('users'));
      $this->set('_serialize', ['users']);

      return $this->redirect(['action' => 'index-president']);
//      $this->render('index_president');
  }
}
