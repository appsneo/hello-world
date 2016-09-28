<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use App\Utils\MailProject;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use \Exception;

use Cake\Mailer\Email;

//use Cake\Mailer\Email;
/**
 * Projects Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ProjectsController extends AppController
{

    public $paginate = [
      'limit' => 10,
  //    'contain' => ['ProjectPeriods'],
  //    'order' => ['id' => 'desc']
    ];
    public $paginateReport = [
      'limit' => 5,
  //    'contain' => ['ProjectPeriods'],
  //    'order' => ['id' => 'desc']
    ];

  public function initialize()
  {
    parent::initialize();

    $this->Users  = TableRegistry::get('Users');
    $this->ProjectUsers  = TableRegistry::get('ProjectUsers');
    $this->Projects = TableRegistry::get('Projects');
    $this->ProjectPeriods = TableRegistry::get('ProjectPeriods');
    $this->ProjectUsers = TableRegistry::get('ProjectUsers');
    $this->Companies = TableRegistry::get('Companies');
    $this->Categories = TableRegistry::get('Categories');
    $this->Clients = TableRegistry::get('Clients');
    $this->Reports = TableRegistry::get('Reports');

    $this->loadComponent('RequestHandler');
  }

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function index()
  {
    // 作業員は担当している現在進行中のプロジェクトのみ参照できる
    if($this->Auth->user('role') == "operator"):
      // 社長でログインした場合は社内全体のプロジェクトを参照する
      $projects = $this->Projects->find('all')
        ->contain(['ProjectPeriods'])
        ->where(function ($exp, $q) {
          return $exp->in('id',
            $this->ProjectUsers->find('all')
              ->select(['project_id'])
              ->where([
                'company_id' => $this->Auth->user('company_id'),
              ])
          );
        });
//        ->where([
//          'completion_check' => 0,
//        ])
   //     ->order([
    //        'id' => 'desc'
    //    ])


    // 社長は全プロジェクトを参照できる
    elseif($this->Auth->user('role') == "president"):
      // 作業員でログインした場合には、作業員のプロジェクトのみを参照する
      $projects = $this->Projects->find('all')
        ->contain(['ProjectPeriods', 'ProjectUsers'])
        ->where([
          'company_id' => $this->Auth->user('company_id'),
        ]);
    //    ->order([
      //      'id' => 'desc'
        //])
     // );
    endif;

    if(null == $this->request->query('sort')) {
        $projects = $projects
            ->order([
               'id' => 'desc'
          ]);
    }

    $projects = $this->paginate($projects);



    // 作業区分の色を設定しておく
    foreach ($projects as $project):
      if($project->category_id) {
        // プロジェクトの業務種別カラーの取得
        $category = $this->Categories->get($project->category_id);
        $project->category_color = $category->color;
      } else {
        $project->category_color = "666666";
      }

//      if(!$project->single):
        // 通常のプロジェクトの場合
      // プロジェクトの複数期間からのプロジェクト全体での開始日と終了日の取得
      $count = 0;
      // 期間は存在するハズですが、念の為 ダミー期間を設定
      $project->start = new Time('3000-12-31');
      $project->end = new Time('1000-1-1');
      $this->log($project, 'debug');
      foreach ($project->project_periods as $period):
        if($period->start < $project->start):
          $project->start = $period->start;
        endif;
        if($period->end > $project->end):
          $project->end = $period->end;
        endif;
          $count++;
      endforeach;
      // 日本語の曜日に変換
      $w = AppUtility::weekjp($project->start->format('w'));
      $project->start = $project->start->format('Y/m/d(' . $w . ')');
      $w = AppUtility::weekjp($project->end->format('w'));
      $project->end = $project->end->format('Y/m/d(' . $w . ')');
      // 期間設定が2以上の場合に "*" を付加
      if($count > 1):
        $project->end .= " *";
      elseif($count == 0):
        $project->end .= " ?";
      endif;
    endforeach;

    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
    $this->set(compact('categories'));
    $this->set('_serialize', ['categories']);
  }

  /**
   * IndexProject method
   *
   * 社内のプロジェクト一覧を表示する
   * あるいは
   * 作業員の担当しているプロジェクト一覧
   *
   * @return \Cake\Network\Response|null
   */
  public function indexReport($sel = null)
  {
    $this->paginate = [
     'limit' => 10,
    ];

    if ($this->request->is(['get']) ||
      ($this->request->is(['post']) && null != $this->request->data('urlfrom'))) {
      $tanan = "all";
      $clsel = "all";
      $search = "";
      date_default_timezone_set('Asia/Seoul');
        $dt = date('Y-m-d');
//          $dt = date('2016-9-3');
        $this->Session->write('Url.year', date('Y'));
        $this->Session->write('Url.month', date('m'));
        $this->Session->write('Url.day', date('d'));
    } else {
      $tanan = $this->request->data['mode'];
      $clsel = $this->request->data['select_client'];
      $search = $this->request->data['search'];
    }

    $this->log('▼', 'debug');
    $this->log($clsel, 'debug');

      $mode = 'all';
      if($sel == "select") {
        $tanan = 'tanan';
        $mode = "report";
      } else {
        $tanan = 'all';
        $mode = "project";
      }



//    $reports = $this->paginate($this->Reports);

/*
if($this->Auth->user('role') == "president") {
  $reports = $this->paginate($this->Reports->find('all')
    ->select(['Reports.id','Users.id','Users.name'])
    ->contain(['Users'])
    ->where([
      'Reports.company_id' => $company_id,
      'Reports.project_id' => $project_id,
//          'Users.role' => 'operator',
      'Reports.single' => 0,
    ]));

//__type' => '"project"',

*/
if($mode == "project") {
    $projects = $this->Projects->find('all')
      ->contain(['ProjectUsers', 'ProjectPeriods'])
      ->select([
        'Projects.company_id',
        'Projects.id',
        'Projects.num',
        'Projects.project_name',
        'Projects.single',
      ])
      ->where(['company_id' => $this->Auth->user('company_id')])
      ->order(['id' => 'desc']);


//      $reports = $this->paginate($this->Reports->find('all')
//        ->select(['Reports.id','Users.id','Users.name'])
//        ->contain(['Users'])
//        ->where([
//          'Reports.company_id' => $company_id,
//          'Reports.project_id' => $project_id,
//          'Reports.single' => 1
//        ]));

    if($search != ""){
      $projects = $projects
        ->where([
          'OR' => [
          ['num LIKE' => '%' . $search . '%'],
          ['project_name LIKE' => '%' . $search . '%']],
        ]);
    }


    // 作業員でログインの場合は自分の分だけ検索
    if($this->Auth->user('role') == "operator") {

      $projects = $projects
        ->where(function ($exp, $q) {
          return $exp->in('Projects.id',
            $this->ProjectUsers->find('all')
              ->select(['project_id'])
              ->where([
                'company_id' => $this->Auth->user('company_id'),
                'user_id' => $this->Auth->user('id'),
              ])
            );
        });
    }
    if( $clsel == "etc"){
        $projects = $projects
          ->where(['Projects.single' => true]);
        $mode_next = 'tanken';
    } elseif ($clsel == "all") {

    } elseif ($clsel != "") {
        $projects = $projects
          ->where(['client_id' => $clsel]);
    }

    $projects = $this->paginate($projects);

} else {

    $reports = $this->Reports->find('all')
      ->contain(['Projects', 'Users'])
      ->select([
        'Reports.num',
        'Reports.id',
        'Users.name',
        'Reports.project_name',
        'Reports.single',
//          'Reports__type' => '"report"',
  //        'Reports.id',
    //      'Users.name',
      //    'Reports.project_name',
        //  'Reports__dummy' => '"dummy"',
      ])
      ->where([
          'Reports.company_id' => $this->Auth->user('company_id'),
          'Reports.single' => true,
      ])
      ->order(['Reports.id' => 'desc']);

     // 作業員でログインの場合は自分の分だけ検索
     if($this->Auth->user('role') == "operator") {
         $reports = $reports
            ->where([
                'Reports.user_id' => $this->Auth->user('id'),
            ]);
      }
      if($search != ""){
        $reports = $reports
          ->where([
            'OR' => [
              ['Reports.num LIKE' => '%' . $search . '%'],
              ['Reports.project_name LIKE' => '%' . $search . '%'],
            ]
          ]);
        }

       $reports = $this->paginate($reports);

  }


//      if( $mode_next == "tanken"){
//          $projects = $this->Projects->find('all')
//            ->contain(['ProjectUsers', 'ProjectPeriods'])
//            ->select([
//              'Projects__type' => '"project"',
//              'Projects.id',
//              'Projects.num',
//              'Projects.project_name',
//              'Projects.single',
//            ])
//            ->where(['company_id' => 0])
//            ->order(['id' => 'desc']);
//
////            $projects->union($reports);
    //        $all = $projects;
//      }


//      $projects = $this->paginate($projects->union($reports));


//            if( $clsel == "etc"){
//                $projects = $projects
//                  ->where(['Projects.single' => true]);
//                $mode_next = 'tanken';
//            }
//            if( $mode_next == "normal"){
//                $projects = $projects;
//            }
//            if( $mode_next == "all"){
//              $projects->union($reports);
    //          $projects->union($reports);
//            }
//            if( $clsel != "all"){
//                $mode_next = 'normal';
//            }



//      $reports = $this->Reports->find('all')
//        ->contain(['Users'])
//        ->select([
//          'Reports.id',
//          'Reports.num',
//          'Reports.project_name',
//          'Users.name',
//          'Project__single' => 'true',
  //          'Reports__type' => '"report"',
    //        'Reports.id',
      //      'Users.name',
        //    'Reports.project_name',
          //  'Reports__dummy' => '"dummy"',
//        ])
//        ->where([
//            'Reports.company_id' => $this->Auth->user('company_id'),
//            'Reports.single' => true,
//        ])
//        ->order(['Reports.id' => 'desc']);

//       // 作業員でログインの場合は自分の分だけ検索
//       if($this->Auth->user('role') == "operator") {
//           $reports = $reports
//              ->where([
//                  'Reports.user_id' => $this->Auth->user('id'),
//              ]);
//        }





    //  $projects = $projects
      //  ->where([
        //  'ProjectUsers->user_id' => $this->Auth->user('id')
      //  ]);

//      $projectUser = $this->ProjectUsers->find('all')
//    ->select([
  //    'Projects.id', 'Projects.num',
    //  'Projects.project_name', 'ProjectUsers.user_id'])
//      ->contain(['ProjectUsers'])
  //    ->where([
    //    'company_id' => $this->Auth->user('company_id'),
      //  'user_id' => $this->Auth->user('id'),
//      ]);
  //    $projectUsers = $this->paginate($projectUser);

  //  }


  ///    $projects = $projects
    //    ->contain([
      //      'ProjectUsers' => function ($q) {
        //        return $q
          //          ->select(['user_id'])
        //            ->where([
          //              'ProjectUsers.user_id' => $this->Auth->user('id')
            //        ]);
    //        }
      //  ]);
//    }



//    $projects = $this->Projects->find('all')
  //    ->select([
    //    'Projects.id', 'Projects.num',
      //  'Projects.project_name', 'ProjectUsers.user_id'])
  //    ->contain(['ProjectUsers'])
    //  ->where([
      //  'Projects.company_id' => $this->Auth->user('company_id'),
        //'Project.project_users.user_id' => $this->Auth->user('id'),
    //  ]);

//    $projects = $this->paginate($projects);

/*
    if( $mode_next == "tanken"):
      if( $clsel == "all"):
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'company_id' => $this->Auth->user('company_id'),
            'single' => true
          ]
        ));
      else:
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'company_id' => $this->Auth->user('company_id'),
            'client_id' => $clsel,
            'single' => true
          ]
        ));
      endif;
    elseif( $mode_next == "normal"):
      if( $clsel == "all"):
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'company_id' => $this->Auth->user('company_id'),
            'single' => false
          ]
        ));
      else:
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'company_id' => $this->Auth->user('company_id'),
            'client_id' => $clsel,
            'single' => false
          ]
        ));
      endif;
    else:
      if( $clsel == "all"):
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'company_id' => $this->Auth->user('company_id')
          ]
        ));
      else:
        $projects = $this->paginate($this->Projects->find('all')
          ->where([
            'client_id' => $clsel,
            'company_id' => $this->Auth->user('company_id')
          ]
        ));
      endif;
    endif;
*/
//    if($search != ""):
  //    $projects = $this->Projects->find('all')
    //    ->where([
      //    'client_id' => $clsel,
        //  'company_id' => $this->Auth->user('company_id')
  //      ]);
    //  $projects = $projects
      //  ->where([
        //  'company_id' => $this->Auth->user('company_id')
//        ]);


//$projects);
    //endif;
//    $projects = $projects
  //    ->limit(['10 OFFSET 0']9;

    $this->set('mode', $mode);
    $this->set('clsel', $clsel);
    $this->set(compact('search'));


    $clients = $this->Clients->find('all')
      ->where([
        'company_id' => $this->Auth->user('company_id')
      ]);

    if($sel == 'select') {
      $mode = "report";
    }
    $this->set(compact('mode'));


    $this->set(compact('clients'));
    $this->set('_serialize', ['clients']);
    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
    //$this->set(compact('projectUsers'));
    //$this->set('_serialize', ['projectUsers']);

    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);


  }

  /**
   * IndexSingle method
   * 単発案件一覧
   * @return \Cake\Network\Response|null
   */
  public function indexSingle()
  {
    $this->paginate = [
      'fields' => ['id','company_id','project_id','user_id','work_date',
                   'start_time','end_time','salaried','holiday_work','allowance','note','remaining'],
      'limit' => 3,
      'order' => ['id' => 'asc']
    ];

    $project_id = $this->Session->read('Projct.id');
    $company_id = $this->Auth->user('company_id');

    if( $project_id == NULL ) {
      $project_id = $this->Session->read('Project.id');
    }
    if($this->Auth->user('role') == "president") {
      $reports = $this->paginate($this->Reports->find('all')
        ->select(['Reports.id','Users.id','Users.name'])
        ->contain(['Users'])
        ->where([
          'Reports.company_id' => $company_id,
          'Reports.project_id' => $project_id,
          'Reports.single' => 1
        ]));
    } elseif($this->Auth->user('role') == "operator") {
      $reports = $this->paginate($this->Reports->find('all')
        ->select(['Reports.id','Users.id','Users.name'])
        ->contain(['Users'])
        ->where([
          'Reports.company_id' => $company_id,
          'Reports.project_id' => $project_id,
          'Reports.user_id' => $this->Auth->user('id'),
          'Reports.single' => 1
        ]));
    }
    $project = $this->Projects->get($project_id);

    $this->Session->write('Project.id', $project_id);

    $this->Session->write('Url.from', 'indexSingle');

    $this->set('role',$this->Auth->user('role'));
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);

    $this->render('index');

/*
    $this->paginate = [
      'fields' => ['id','company_id','project_id','user_id','work_date',
                   'start_time','end_time','salaried','holiday_work','allowance','note','remaining'],
      'limit' => 3,
      'order' => ['id' => 'asc']
    ];

    $reports = $this->paginate($this->Reports->find('all')
      ->select(['Reports.id','Users.id','Users.name'])
      ->contain(['Users'])
      ->where([
        'Reports.single' => 1
      ])
    );

    $this->Session->write('Url.from', 'indexSingle');
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
//    $this->render('index');
    $this->index('indexSingle');
*/
  }

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function indexWorker()
  {
    if( $this->Auth->user('role') == "operator" ):
      // 作業員は担当の実施中プロジェクトのみを参照できる
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods', 'ProjectUsers'])
        ->order([
          'id' => 'desc'
        ])
        ->where(function ($exp, $q) {
          return $exp->in('id',
            $this->ProjectUsers->find('all')
              ->select(['project_id'])
              ->where([
                'company_id' => $this->Auth->user('company_id'),
                'user_id' => $this->Auth->user('id'),
              ])
          );
        })
        ->where([
          'completion_check' => 0,
        ])
      );

    elseif($this->Auth->user('role') == "president"):
      // 社長は自社の作業中プロジェクトを参照できる
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods'])
        ->order([
          'id' => 'desc'
        ])
        ->where([
          'company_id' => $this->Auth->user('company_id'),
          'completion_check' => 0,
        ])
      );

    endif;


    // 作業区分の色を設定しておく
    foreach ($projects as $project):
      if($project->category_id) {
        // プロジェクトの業務種別カラーの取得
        $category = $this->Categories->get($project->category_id);
        $project->category_color = $category->color;
      } else {
        $project->category_color = "000000";
      }

//      if(!$project->single):
        // 通常のプロジェクトの場合
      // プロジェクトの複数期間からのプロジェクト全体での開始日と終了日の取得
      $count = 0;
      // 期間は存在するハズですが、念の為 ダミー期間を設定
      $project->start = new Time('3000-12-31');
      $project->end = new Time('1000-1-1');
      $this->log($project, 'debug');
      foreach ($project->project_periods as $period):
        if($period->start < $project->start):
          $project->start = $period->start;
        endif;
        if($period->end > $project->end):
          $project->end = $period->end;
        endif;
          $count++;
      endforeach;
      // 日本語の曜日に変換
      $w = AppUtility::weekjp($project->start->format('w'));
      $project->start_str = $project->start->format('Y/m/d(' . $w . ')');
      $w = AppUtility::weekjp($project->end->format('w'));
      $project->end_str = $project->end->format('Y/m/d(' . $w . ')');
      // 期間設定が2以上の場合に "*" を付加
      if($count > 1):
        $project->end_str .= " *";
      elseif($count == 0):
        $project->end_str .= " ?";
      endif;
    endforeach;



    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
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
    if( $this->Auth->user('role') == "operator" ):
      // 作業員は担当の実施中プロジェクトのみを参照できる
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods', 'ProjectUsers'])
        ->order([
          'id' => 'desc'
        ])
        ->where(function ($exp, $q) {
          return $exp->in('id',
            $this->ProjectUsers->find('all')
              ->select(['project_id'])
              ->where([
                'company_id' => $this->Auth->user('company_id'),
                'user_id' => $this->Auth->user('id'),
              ])
          );
        })
        ->where([
          'completion_check' => 1,
        ])
      );

    elseif($this->Auth->user('role') == "president"):
      // 社長は自社の作業中プロジェクトを参照できる
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods'])
        ->order([
          'id' => 'desc'
        ])
        ->where([
          'company_id' => $this->Auth->user('company_id'),
          'completion_check' => 1,
        ])
      );

    endif;


    // 作業区分の色を設定しておく
    foreach ($projects as $project):
      if($project->category_id) {
        // プロジェクトの業務種別カラーの取得
        $category = $this->Categories->get($project->category_id);
        $project->category_color = $category->color;
      } else {
        $project->category_color = "000000";
      }

//      if(!$project->single):
        // 通常のプロジェクトの場合
      // プロジェクトの複数期間からのプロジェクト全体での開始日と終了日の取得
      $count = 0;
      // 期間は存在するハズですが、念の為 ダミー期間を設定
      $project->start = new Time('3000-12-31');
      $project->end = new Time('1000-1-1');
      $this->log($project, 'debug');
      foreach ($project->project_periods as $period):
        if($period->start < $project->start):
          $project->start = $period->start;
        endif;
        if($period->end > $project->end):
          $project->end = $period->end;
        endif;
          $count++;
      endforeach;
      // 日本語の曜日に変換
      $w = AppUtility::weekjp($project->start->format('w'));
      $project->start_str = $project->start->format('Y/m/d(' . $w . ')');
      $w = AppUtility::weekjp($project->end->format('w'));
      $project->end_str = $project->end->format('Y/m/d(' . $w . ')');
      // 期間設定が2以上の場合に "*" を付加
      if($count > 1):
        $project->end_str .= " *";
      elseif($count == 0):
        $project->end_str .= " ?";
      endif;
    endforeach;

    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
  }

  /**
   * IndexProjects method
   *
   * 社内のプロジェクト一覧を表示する
   *
   * @return \Cake\Network\Response|null
   */
  public function indexProjects()
  {
    $this->paginate = [
      'limit' => 10,
    ];

    //    $projects = $this->Projects->find('all');
    $order_col = "Projects.id";
    $order = "desc";
    $where_col = "Projects.id";
    $where = "desc";
    $today = new \DateTime('Now');
    $status = $this->request->query('status');
    $way = $this->request->query('order');

    if($way == "sasc"):
      $order_col = 'Projects.start';
      $order = 'asc';
    endif;
    if($way == "sdesc"):
      $order_col = 'Projects.start';
      $order = 'desc';
    endif;
    if($way == "easc"):
      $order_col = 'Projects.end';
      $order = 'asc';
    endif;
    if($way == "edesc"):
      $order_col = 'Projects.end';
      $order = 'desc';
    endif;

//$reports = $this->Reports->find('all')
  //        ->select(['project_id'])
    //      ->group(['project_id']) ;

      //    $projects = $this->Projects->find('all')
        //    ->In($reports);



/*
    $projects = $this->paginate($this->Projects->find('all')
          ->where(function ($exp, $q) {
            return $exp->in('id',
              $this->Reports->find('all')
                ->select(['project_id'])
                ->where([
                  'company_id' => $this->Auth->user('company_id'),
                ])
            );
          })
          ->where([
            'company_id' => $this->Auth->user('company_id')]),
         ->order([ '$project_id' => 'desc' ]));
      );
*/

//$report = $this->Reports->find('all')
//  ->where([
//    'project_id' => $project->id,
//  ])
//  ->first();
//
//  if($report == null) {
//      $project->status = 'not_started';
//  }

// 終了 : completion_check = ON
if($status == "end"):   // 終了
  $projects = $this->paginate($this->Projects->find('all')
    ->contain(['ProjectPeriods'])
    ->where([
      'company_id' => $this->Auth->user('company_id'),
      'completion_check' => true,
    ])
    ->order([ $order_col => $order ]));

// 未着手 : 日報が登録されていない場合
elseif($status == "not_started"): // 未着手
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods', 'Reports'])
        ->where([
          'Projects.company_id' => $this->Auth->user('company_id'),
          'Reports.id IS ' => NULL,
          'Projects.completion_check' => false,
        ])
        ->order([ $order_col => $order ])
    );

elseif($status == "all" || $status == null):  // すべて
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods'])
        ->where([
          'company_id' => $this->Auth->user('company_id')])
        ->order([ $order_col => $order ])
      );

elseif($status == "progress"):  // 進行中
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods', 'Reports'])
        ->select([
          'Projects.id', 'Projects.company_id', 'Projects.project_name',
        ])
        ->where([
          'Projects.company_id' => $this->Auth->user('company_id'),
          'Reports.id IS NOT' => NULL,
          'Reports.single' => false,
          'Projects.completion_check' => false,
        ])
        ->group(['Projects.id, Projects.company_id'])
        ->order([ $order_col => $order ])
    );
endif;

/*
        $projects = $this->paginate($this->Projects->find('all')
            ->contain(['ProjectPeriods'])
            ->where(function ($exp, $q) {
                return $exp->in('id',
                            $this->ProjectUsers->find('all')
                            ->select(['project_id'])
                            ->where([
                                'company_id' => $this->Auth->user('company_id'),
                                'user_id' => $this->Auth->user('id'),
                            ])
                            );
            }
            ->where([
              'company_id' => $this->Auth->user('company_id'),
              'start > ' => $today])
            ->order([ $order_col => $order ]));

          );
*/



    //    ->where(function ($exp, $q) {
      //      return $exp->in('id',
        //                $this->ProjectUsers->find('all')
          //              ->select(['project_id'])
            //            ->where([
              //              'company_id' => $this->Auth->user('company_id'),
                //            'user_id' => $this->Auth->user('id'),
                  //      ])
                    //    );
      //  });



//    $start = new \DateTime('3000-01-01');
  //  $end = new \DateTime('1000-01-01');
    //$today = new \DateTime('Now');

    // 開始日と終了日を求める
    foreach ($projects as $project):
//      if(!$project->single):
        // 通常のプロジェクトの場合
      // プロジェクトの複数期間からのプロジェクト全体での開始日と終了日の取得
      $count = 0;
      // 期間は存在するハズですが、念の為 ダミー期間を設定
      $project->start = new Time('3000-12-31');
      $project->end = new Time('1000-1-1');
      $this->log($project, 'debug');
      foreach ($project->project_periods as $period):
        if($period->start < $project->start):
          $project->start = $period->start;
        endif;
        if($period->end > $project->end):
          $project->end = $period->end;
        endif;
          $count++;
      endforeach;
      // 日本語の曜日に変換
      $project->start_str = $project->start->format('Y/m/d');
      $project->end_str = $project->end->format('Y/m/d');
      // 期間設定が2以上の場合に "*" を付加
      if($count > 1):
        $project->end_str .= " *";
      elseif($count == 0):
        $project->end_str .= " ?";
      else:
        $project->end_str .= "  ";
      endif;

      // 未着手
      // 終了
      if($project->completion_check == true):
        $project->status = 'end';
      endif;

      $report = $this->Reports->find('all')
        ->where([
          'project_id' => $project->id,
          'single' => false,
        ])
        ->first();

      // 未着手
      if($report == null && $project->completion_check == false) {
        $project->status = 'not_started';
      }
      // 進行中
      elseif($report != null &&  $project->completion_check == false && $project->start <= $today && $project->end >=  $today){
        $project->status = 'progress';
      }


//    }
/*
//            if($report == null) {
//                $project->status = 'not_started';
//            } else {


      $project->status = 'not_started';
      // 終了
      if($project->completion_check = true){
          $project->status = 'end';
      }
      // 未着手
      elseif($report == null) {
          $project->status = 'not_started';
      }
      else
      {
        // 進行中
        if($project->start <= $today && $project->end >=  $today){
            $project->status = 'progress';
        }
        // 未着手
        elseif($project->start > $today){
            $project->status = "not_started";
        }
      }
*/
    endforeach;

    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
  }


  /**
   * reports
   *
   * @return \Cake\Network\Response|null
   */
   public function reports($id = null)
   {
        $project_id = $id;

        $project = $this->Projects->get($project_id, [
            'contain' => ['ProjectPeriods', 'ProjectUsers']
        ]);


      // プロジェクトの日報一覧取得
      $reports = $this->Reports->find('all')
        ->contain([
            'Users'
        ])
        ->where([
            'Reports.project_id' => $project_id
        ]);


      //      if(!$project->single):
          // 通常のプロジェクトの場合
        // プロジェクトの複数期間からのプロジェクト全体での開始日と終了日の取得
        $count = 0;
        $today = new \DateTime('Now');
        // 期間は存在するハズですが、念の為 ダミー期間を設定
        $project->start = new Time('3000-12-31');
        $project->end = new Time('1000-1-1');
        $this->log($project, 'debug');
        foreach ($project->project_periods as $period):
          if($period->start < $project->start):
            $project->start = $period->start;
          endif;
          if($period->end > $project->end):
            $project->end = $period->end;
          endif;
            $count++;
        endforeach;
        // 日本語の曜日に変換
        $project->start_str = $project->start->format('Y/m/d');
        $project->end_str = $project->end->format('Y/m/d');
        // 期間設定が2以上の場合に "*" を付加
        if($count > 1):
          $project->end_str .= " *";
        elseif($count == 0):
          $project->end_str .= " ?";
        else:
          $project->end_str .= "  ";
        endif;

        // 日誌がまだ登録されていない
        $report = $this->Reports->find('all')
          ->where([
            'project_id' => $project_id,
          ])
          ->first();

          // default
          $project->status = 'not_started';
          // 終了
          if($project->completion_check == true){
              $project->status = 'end';
          }
          // 未着手
          elseif($report == null) {
              $project->status = 'not_started';
          }
          else
          {
            // 進行中
            if($report != null && $project->completion_check == false){
                $project->status = 'progress';
            }
            // 未着手
            elseif($project->start > $today){
                $project->status = "not_started";
            }
          }


        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
        $this->set(compact('reports'));
        $this->set('_serialize', ['reports']);
    }


        /**
         * calender-doc method
         *
         * @return \Cake\Network\Response|null
         */
        public function document($id = null)
        {
            $pid = $this->Session->read('Project.id');
            $project = $this->Projects->get($pid);

            // 図面移動先のディレクトリ
            $dir = new Folder();
            if($dir->create('/work/papers/' . $project->id)) {
//                if($dir->create(WWW_ROOT.'docs/' . $project->id)) {

//                }
            }


            if($dir->create('/work/papers/' . $project->id)) {
//                if($dir->create(WWW_ROOT.'docs/' . $project->id)) {

//                }
            }
//            $file = new File('/work/documents/' . $project->id . "/" . $doc);
        //    $file->copy('/work/jobmane/webroots/documents/' . $project->id, true);
        //    $file = new Folder("/work/");
//            $this->log($folder->path, 'debug');
//            $folder->cd('pdfs');
//            $file = new File('/work/pdfs/請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf', true, 0644);
//            $file->copy('/work/jobmane/webroot/請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf', true);

//            $project->drawing = $doc;
//$doc = $project->document;
$doc = urlencode($project->document);

            // 図面移動元のディレクトリからコピーする
            $path = '/work/papers/' . $project->id . '/' . $doc;

            $this->log($path, 'debug');
            $file = New File($path);

            // 図面ファイルが存在しない場合は Flash エラー
            if(!$file->exists()) {
              $this->Flash->error(__('図名書類：' . $project->document . ' が見つかりません'));

              $this->log('★図面なし', 'debug');
//              $errors = new array();
//              $errors = [
//                  'paper' => [
//                      '_empty' => 'message:aaaaa'
//                  ]
//              ];
//              $this->set(compact('errors'));
              return $this->redirect('/projects/view/' . $project->id);
            }
//            debug($file->info());
//            $file->copy('/documents/' . $project->id' . $project->drawing);

//            $this->redirect('/documents/' . $project->drawing);
            //        $users = $this->paginate($this->Users);

//            $this->Html->link('Pdf', WWW_ROOT . 'docs/' . $project->drawing);



//            $this->autoRender = false;
            $this->response->type('pdf');
            $this->response->charset('UTF-8');
            $this->response->file($path, ['name' => $project->document]);
            return $this->response;
        }


  /**
   * View method
   *
   * プロジェクトの詳細を表示する
   * @param string|null $id User id.     * @return \Cake\Network\Response|null
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $project_id = $id;

    $project = $this->Projects->get($project_id, [
      'contain' => ['ProjectPeriods', 'ProjectUsers', 'Clients']
    ]);

    $this->Session->write('Project.id', $project_id);

    // 作業員の氏名を取得しておく
//    foreach($project->project_users as $worker):
//      $user = $this->Users->get($worker->user_id);
//      $worker['user_name'] = $user->name;
//    endforeach;

    // 期間日付を先に和暦表示にしておく
    foreach($project->project_periods as $period):
      $w =$period->start->format('w');
      $w = AppUtility::weekjp($w);
      $period->startjp =$period->start->format('Y/m/d'). "(" . $w . ")";
      $w =$period->end->format('w');
      $w = AppUtility::weekjp($w);
      $period->endjp =$period->end->format('Y/m/d'). "(" . $w . ")";
    endforeach;

    $projectUsers = $this->ProjectUsers->find('all', [
        'contain' => ['Users']
      ])
      ->where(['project_id' => $id]);

    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('projectUsers'));
    $this->set('_serialize', ['projectUsers']);
  }


        /**
         * View method
         *
         * @param string|null $id User id.
         * @return \Cake\Network\Response|null
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function documentxxx($id = null)
        {
            $folder = new Folder("/work/");
            $this->log($folder->path, 'debug');
            $folder->cd('pdfs');
            $file = new File('/work/pdfs/請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf', true, 0644);
            $file->copy('/work/jobmane/webroot/請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf', true);

//            copy( [
//                'to' => '/work/jobmane/webroot/',
//                'from' => '/work/pdfs',
//                'mode' => '0644',
//                'skip' => '',
//                'scheme' => '',
//            ])
//            $this->log($folder->path, 'debug');
//            $path = Folder::addPathElement('/tmp/', 'takao');
//            $project = $this->Projects->get($id, [
//                'contain' => ['ProjectUsers']
//            ]);

//$this->response->type('pdf');
//$this->response->charset('UTF-8');
//$this->response->download('請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf');
//$this->layout = false;


//            $this->response->file('/請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf');
//            $this->response->header("Content-Type:applicatin/pdf");
//            $this->response->header("Content-Disosition: inline; filename='請求書_AppsNeo_20130530_ステータス管理台帳改訂.pdf'");
//            return $this->respose;
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
            $projects = $this->paginate($this->Projects);

            $this->set(compact('projects'));
            $this->set('_serialize', ['projects']);
        }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function calendarWorker()
    {
        $this->log("ProjectsController->calendarWorker()", 'debug');
        // 作業員のプロジェクト表示
        $company_id = $this->Auth->user('company_id');
        $user_id = $this->Auth->user('id');

        // 会社情報
        $company = $this->Companies->get($company_id);
//        $project = $this->Projects->get($user_id, [
//            'contain' => ['ProjectPeriods', 'ProjectUsers']
//        ]);


        $projectUsers = $this->ProjectUsers->find('all')
                    ->select(['id'])
                    ->where([
                        'company_id' => $this->Auth->user('company_id'),
                        'user_id' => $this->Auth->user('id'),
                    ]);
//                    ->contain([
//                        'ProjectPeriods',
//                        'ProjectUsers' => function($q) {
//                            return $q
//                                ->select(['',''])
//                                ->where(['user_id' => $this->Auth->user('id')]);
//                        },
//                    ]);
        $projects = $this->Projects->find('all')
            ->contain(['ProjectPeriods'])
            ->where(function ($exp, $q) {
                return $exp->in('id',
                            $this->ProjectUsers->find('all')
                            ->select(['project_id'])
                            ->where([
                                'company_id' => $this->Auth->user('company_id'),
                                'user_id' => $this->Auth->user('id'),
                            ])
                            );
            });

        // EVENT
        $events = array();

        foreach($projects as $project):
          if($project->single):
            // 単独プロジェクトの場合
            // 文字色の 黒 or 白 を自動計算する
            // 単独の場合は色固定
            $bcolor = "666666";
            // 文字色の 黒 or 白 を自動計算する
            $textColor = "#FFFFFF";
            $iro =  299 * hexdec(substr($bcolor, 0, 2)) +
                    587 * hexdec(substr($bcolor, 2, 2)) +
                    114 * hexdec(substr($bcolor, 4, 2));
            $iro = $iro / 1000;
            if($iro > 128) {
              $textColor = "#000000";
            }
            $dt= new \DateTime($project->start);
            $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
            $dt= new \DateTime($project->end);
            $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
            $events[] = array(
              'id' => "'" . $project->id . "'",
              'title' => $project->project_name,
              'url' => "/projects/view/" . $project->id,
              'color' => '#' . $bcolor,
              'textColor' => $textColor,
              'borderColor' => $textColor,
              'start' => $dt_start,
              'end' => $dt_end
            );

          else:

            // 通常プロジェクトの場合
            // 文字色の 黒 or 白 を自動計算する
            $textColor = "#FFFFFF";
            $iro =  299 * hexdec(substr($project->color, 0, 2)) +
                    587 * hexdec(substr($project->color, 2, 2)) +
                    114 * hexdec(substr($project->color, 4, 2));
            $iro = $iro / 1000;
            $this->log($iro . ' : ' . $project->color);
            if($iro > 128) {
              $textColor = "#000000";
            }
            $pos = 0;
            $max = count($project->project_periods);
            foreach($project->project_periods as $period):
              // 日付の時刻を再設定
              $dt = new \DateTime($period->start);
              $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
              $dt = new \DateTime($period->end);
              $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
              // 複数作業期間の場合に連番「 (2/3) 等」を追記する
              if($max >= 2) {
                $num = ' (' . ($pos+1) . '/' . $max . ')';
              } else {
                $num = '';
              }
              $events[] = array(
                'id' => "'" . $project->id . "'",
                'title' => $project->project_name . $num,
                'url' => "/projects/view/" . $project->id,
                'color' => '#' . $project->color,
                'textColor' => $textColor,
                'borderColor' => $textColor,
                'start' => $dt_start,
                'end' => $dt_end
              );
              $pos++;
            endforeach;
          endif;
        endforeach;

        // 最初に表示する年月
        // Dummy 開始日
        $dt_first = new \DateTime('Now');
        $company->first_date = $dt_first->format('Y-m-d');


/*
        foreach($projects as $project):
            $pos = 0;
            $max = count($project->project_periods);
            foreach($project->project_periods as $period):
                // 文字色の 黒 or 白 を自動計算する
                $textColor = "#FFFFFF";
                $num =  299 * hexdec(substr($project->color, 0, 2)) +
                        587 * hexdec(substr($project->color, 2, 2)) +
                        114 * hexdec(substr($project->color, 4, 2));
                $num = $num / 1000;
                $this->log($num . ' : ' . $project->color);
                if($num > 128) {
                    $textColor = "#000000";
                }
                // 日付の時刻を再設定
                $dt = new \DateTime($period->start);
                $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
                $dt = new \DateTime($period->end);
                $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
                // 複数日付の場合に連番「 (2/3) 等」を追記する
                if($max >= 2) {
                    $num = ' (' . ($pos+1) . '/' . $max . ')';
                } else {
                    $num = '';
                }
                $events[] = array(
                    'id' => $project->id,
                    'title' => $project->project_name . $num,
                    'className' => "class-a",
                    'url' => "/projects/view/" . $project->id,
                    'color' => '#' . $project->color,
                    'textColor' => $textColor,
                    'borderColorxxx' => $textColor,
                    'start' => $dt_start,
                    'end' => $dt_end
                );
                $pos++;
            endforeach;
        endforeach;
*/

    //    $jsonEvents = json_encode($events);

//        $user = $this->Auth->user();
//        $this->set(compact('user'));

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);

        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }



  /**
   * CalendarOne method
   * 一つのプロジェクトのカレンダー表示
   *
   * @return \Cake\Network\Response|null
   */
  public function calendarOne($id = null)
  {
    $project = $this->Projects->get($id, [
      'contain' => ['ProjectPeriods', 'ProjectUsers']
    ]);

    // Dummy 開始日
    $dt_first = new \DateTime('2050-01-01');

    // events
    $events = array();
    $pos = 0;
    if($project->single):
      // 単独プロジェクトの場合
      // 文字色の 黒 or 白 を自動計算する
      // 単独の場合は色固定
      $bcolor = "666666";
      // 文字色の 黒 or 白 を自動計算する
      $textColor = "#FFFFFF";
      $iro =  299 * hexdec(substr($bcolor, 0, 2)) +
              587 * hexdec(substr($bcolor, 2, 2)) +
              114 * hexdec(substr($bcolor, 4, 2));
      $iro = $iro / 1000;
      if($iro > 128) {
        $textColor = "#000000";
      }
      $pos = 0;
      $max = count($project->project_periods);
      foreach($project->project_periods as $period):
        // 日付の時刻を再設定
        $dt = new \DateTime($period->start);
        if($dt_first > $dt) {
          $dt_first = $dt;
        }
        $dt = new \DateTime($period->start);
        $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
        $dt = new \DateTime($period->end);
        $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
        // 複数作業期間の場合に連番「 (2/3) 等」を追記する
        if($max >= 2) {
          $num = ' (' . ($pos+1) . '/' . $max . ')';
        } else {
          $num = '';
        }
        $num = '';
        $events[] = array(
          'id' => $project->id,
          'title' => $project->project_name . $num,
          'className' => "class-a",
          'url' => "/projects/view/" . $project->id,
          'color' => '#' . $bcolor,
          'textColor' => $textColor,
          'borderColor' => $textColor,
          'start' => $dt_start,
          'end' => $dt_end
        );
        $pos++;
      endforeach;
//      $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
  //    $dt_first = $dt;
    //  $dt= new \DateTime($project->end);
      //$dt_end = $dt->format('Y-m-d') . 'T23:59:00';
    //  $events[] = array(
      //  'id' => $project->id,
        //'title' => $project->project_name,
//        'className' => "class-a",
  //      'url' => "/projects/view/" . $project->id,
    //    'color' => '#' . $project->color,
      //  'textColor' => $textColor,
  //      'borderColorxxx' => $textColor,
    //    'start' => $dt_start,
      //  'end' => $dt_end
      //);

    else:

      // 通常プロジェクトの場合
      // 文字色の 黒 or 白 を自動計算する
      $textColor = "#FFFFFF";
      $iro =  299 * hexdec(substr($project->color, 0, 2)) +
              587 * hexdec(substr($project->color, 2, 2)) +
              114 * hexdec(substr($project->color, 4, 2));
      $iro = $iro / 1000;
      $this->log($iro . ' : ' . $project->color);
      if($iro > 128) {
        $textColor = "#000000";
      }
      $pos = 0;
      $max = count($project->project_periods);
      foreach($project->project_periods as $period):
        // 日付の時刻を再設定
        $dt = new \DateTime($period->start);
        if($dt_first > $dt) {
          $dt_first = $dt;
        }
        $dt = new \DateTime($period->start);
        $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
        $dt = new \DateTime($period->end);
        $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
//        $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
//        $dt = new \DateTime($period->end);
  //      if($dt_first > $dt) {
    //      $dt_first = $dt;
      //  }
        //$dt_end = $dt->format('Y-m-d') . 'T23:59:00';
        // 複数作業期間の場合に連番「 (2/3) 等」を追記する
        if($max >= 2) {
          $num = ' (' . ($pos+1) . '/' . $max . ')';
        } else {
          $num = '';
        }
        $events[] = array(
          'id' => $project->id,
          'title' => $project->project_name . $num,
          'className' => "class-a",
          'url' => "/projects/view/" . $project->id,
          'color' => '#' . $project->color,
          'textColor' => $textColor,
          'borderColor' => $textColor,
          'start' => $dt_start,
          'end' => $dt_end
        );
        $pos++;
      endforeach;
    endif;

/*
    $max = count($project->project_periods);
    foreach($project->project_periods as $period):
      $dt = new \DateTime($period->start);
      // 最初に表示する年月を求める
      if($dt_first > $dt) {
        $dt_first = $dt;
      }
      // 文字色の 黒 or 白 を自動計算する
      if($project->category_id) {
        $category = $this->Categories->get($project->category_id);
      } else {
        $category = $this->Categories->newEntity();
        $category->color ="666666";
      }
      // 文字色の 黒 or 白 を自動計算する
      $textColor = "#FFFFFF";
      $iro =  299 * hexdec(substr($category->color, 0, 2)) +
              587 * hexdec(substr($category->color, 2, 2)) +
              114 * hexdec(substr($category->color, 4, 2));
      $iro = $iro / 1000;
      $this->log($iro . ' : ' . $category->color);
      if($iro > 128) {
        $textColor = "#000000";
      }
      $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
      $dt = new \DateTime($period->end);
      $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
      if($max >= 2) {
        $num = ' (' . ($pos+1) . '/' . $max . ')';
      } else {
        $num = '';
      }
      $events[] = array(
        'id' => $project->id,
        'title' => $project->project_name . $num,
        'className' => "class-a",
        'url' => "project_detail.html",
        'color' => '#' . $project->color,
        'textColor' => $textColor,
        'start' => $dt_start,
        'end' => $dt_end
      );
      $pos++;
    endforeach;
*/

//    foreach($project->project_users as $worker):
  //    $worker['user_name'] = $this->Users->get($worker->user_id, [
    //    'contain' => []
      //]);
    ///endforeach;

    // 最初に表示する年月
    $project->first_date = $dt_first->format('Y-m-d');

    $this->set(compact('events'));
    $this->set('_serialize', ['events']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
  }

  /**
   * calendarCompany method
   *
   * 会社全体のプロジェクトをカレンダーに表示させる
   *
   * @return \Cake\Network\Response|null
   */
  public function calendarCompany()
  {
    // 会社情報
    $company_id = $this->Auth->user('company_id');
    $company = $this->Companies->get($company_id);
    // 会社全体のプロジェクト表示
    $projects = $this->Projects->find('all')
      ->contain([
        'ProjectPeriods', 'ProjectUsers'
      ])
      ->where([
          'Projects.company_id' => $company_id,
          'Projects.completion_check' => false,
      ]);

    // Dummy 開始日
    $dt_first = new \DateTime('Now');

    // EVENT
    $events = array();

    foreach($projects as $project):
      if($project->single):
        // 単独プロジェクトの場合
        // 文字色の 黒 or 白 を自動計算する
        // 単独の場合は色固定
        $bcolor = "666666";
        // 文字色の 黒 or 白 を自動計算する
        $textColor = "#FFFFFF";
        $iro =  299 * hexdec(substr($bcolor, 0, 2)) +
                587 * hexdec(substr($bcolor, 2, 2)) +
                114 * hexdec(substr($bcolor, 4, 2));
        $iro = $iro / 1000;
        if($iro > 128) {
          $textColor = "#000000";
        }
        $dt= new \DateTime($project->start);
        $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
        $dt= new \DateTime($project->end);
        $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
        $events[] = array(
          'id' => "'" . $project->id . "'",
          'title' => $project->project_name,
          'url' => "/projects/view/" . $project->id,
          'color' => '#' . $bcolor,
          'textColor' => $textColor,
          'borderColor' => $textColor,
          'start' => $dt_start,
          'end' => $dt_end
        );

      else:

        // 通常プロジェクトの場合
        // 文字色の 黒 or 白 を自動計算する
        $textColor = "#FFFFFF";
        $iro =  299 * hexdec(substr($project->color, 0, 2)) +
                587 * hexdec(substr($project->color, 2, 2)) +
                114 * hexdec(substr($project->color, 4, 2));
        $iro = $iro / 1000;
        $this->log($iro . ' : ' . $project->color);
        if($iro > 128) {
          $textColor = "#000000";
        }
        $pos = 0;
        $max = count($project->project_periods);
        foreach($project->project_periods as $period):
          // 日付の時刻を再設定
          $dt = new \DateTime($period->start);
          $dt_start = $dt->format('Y-m-d') . 'T00:00:00';
          $dt = new \DateTime($period->end);
          $dt_end = $dt->format('Y-m-d') . 'T23:59:00';
          // 複数作業期間の場合に連番「 (2/3) 等」を追記する
          if($max >= 2) {
            $num = ' (' . ($pos+1) . '/' . $max . ')';
          } else {
            $num = '';
          }
          $events[] = array(
            'id' => "'" . $project->id . "'",
            'title' => $project->project_name . $num,
            'url' => "/projects/view/" . $project->id,
            'color' => '#' . $project->color,
            'textColor' => $textColor,
            'borderColor' => $textColor,
            'start' => $dt_start,
            'end' => $dt_end
          );
          $pos++;
        endforeach;
      endif;
    endforeach;

    // 最初に表示する年月
    $company->first_date = $dt_first->format('Y-m-d');

    $this->set(compact('events'));
    $this->set('_serialize', ['events']);
    $this->set(compact('company'));
    $this->set('_serialize', ['company']);
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
    $this->edit("add");
    $this->render('edit');
  }


  /**
   * AddSingle method
   *
   * 単発案件プロジェクト追加
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function addSingle()
  {
    $this->editSingle("add");
    $this->render('editSingle');
//    $this->editSingle('addSingle');
  }

  /**
   * Edit method
   *
   * @param string|null $id Project id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    if($id === "add") {
      $mode = "add";
      $next = "/projects/add";
    } else {
      $mode = "edit";
      $next = "/projects/edit/" . $id;
      $this->Session->write('Project.id', $id);
    }
    $this->set(compact('mode'));
    $this->set(compact('next'));

    $this->Session->write('Url.from.controller', 'projects');
    if($id === 'add'):
      $this->Session->write('Url.from.action', 'add');
      $this->set('url', [
        'controller' => 'projects',
        'action' => 'add',
        'next', '/projects/add'
      ]);
    else:
      $this->Session->write('Url.from.action', 'edit');
      $this->set('url', [
        'controller' => 'users',
        'action' => 'edit-president',
        'next', '/projects/edit/' . $id
      ]);
    endif;


//    if( $id === "add" ) {
  //    $this->set('from', 'add');
    //} else {
      //$this->set('from', 'edit');
///    }
    // 会社ID
    $company_id = $this->Auth->user('company_id');
    // プロジェクトID
    $project_id = $id;
    // 作業員
    $users = $this->Users->find('all')
      ->where([
        'company_id' => $company_id,
        'role' => 'operator',
      ]);
    // 部材
    $categories = $this->Categories->find('all')
      ->where(['company_id' => $company_id]);
    // 得意先
    $clients = $this->Clients->find('all')
      ->where(['company_id' => $company_id]);

        // **************************************************************//
        //  ADD : first
        // **************************************************************//
        if ($id === "add" && $this->request->is(['post']) && null != $this->request->data('urlfrom') &&
            null == $this->request->data('company_id')):

          $this->log("Projects->edit(POST) :" . $id, 'debug');
            $project = $this->Projects->newEntity([
                'contain' => ['ProjectPeriods', 'ProjectUsers', 'Clients']
            ]);
            // プロジェクト色
            $project->color = "AB2567";
            // 担当する作業員
            $projectPeriod = $this->ProjectPeriods->newEntity();
            $project->project_periods = [$projectPeriod];
            $projectUser = $this->ProjectUsers->newEntity();
            $project->project_users = [$projectUser];
            // 作業期間を１つ作成 ： Default値
            // Projects.start と Projects.end を使用
            date_default_timezone_set('Asia/Seoul');
            $project->start = date('Y/m/d');
            $project->end = date('Y/m/d');

        // **************************************************************//
        //  EDT : first
        // **************************************************************//
        elseif (($id != "add" && $id != null && $this->request->is(['get'])) ||
                ($id != "add" && $id != null && $this->request->is(['post']) &&
                 null != $this->request->data('urlfrom') &&
                 null == $this->request->data('company_id'))):

//       elseif ($id != "add" && $id != null && $this->request->is(['post']) &&
//                null != $this->request->data('urlfrom') &&
//                null == $this->request->data('company_id')):

            //  edit : first
            $this->log("Projects->edit(GET) :" . $id, 'debug');
            $project = $this->Projects->get($id, [
        'contain' => ['ProjectPeriods', 'ProjectUsers', 'Clients']
      ]);
      // 日付Format
      foreach ($project->project_periods as $period) {
        $period->start = $period->start->format('Y/m/d');
        $period->end = $period->end->format('Y/m/d');
      }
      // 作業期間情報がもしもなかったら
      if(count($project->project_periods) == 0):
        // 作業期間を１つ作成 ： Default値
        date_default_timezone_set('Asia/Seoul');
        $projectPeriod = $this->ProjectPeriods->newEntity();
        date_default_timezone_set('Asia/Seoul');
        $projectPeriod['start'] = date('Y/m/d');
        $projectPeriod['end'] = date('Y/m/d');
        $project->project_periods = [$projectPeriod];
      endif;

        // **************************************************************//
        //  POST 時
        // **************************************************************//
        elseif($this->request->is(['post'])):

      // POST時
      if ($id === "add") {
        // ADD 時
        $this->log("Projects->add(POST) : 2", 'debug');
        // 'add': next
        //$users = $this->paginate($this->Users);
        $project = $this->Projects->newEntity();
      }
      if ($id != "add") {
        // EDIT 時
        $this->log("Projects->edit(POST) : 2", 'debug');
        $project = $this->Projects->get($id, [
          'contain' => ['ProjectPeriods', 'ProjectUsers']
        ]);
      }
      // ADD と POST で共通の保存処理
      $project = $this->Projects->patchEntity($project, $this->request->data, [
        'validate' => 'default'
      ]);
      if($project->errors ()) {
        // Validation Error時
        $this->set("errors", $project->errors ());

        // 設定した値を再表示するために vallidate => false で再取得
        $project = $this->Projects->patchEntity($project, $this->request->data, [
          'validate' => false
        ]);

//        // プロジェクト完了チェック
  //      if($project->completion_check) {
    //      $project->completion_check = true;
      //  } else {
        //  $project->completion_check = false;
        //}
        // 作業期間の配列取得
        $starts = $this->request->data['start'];
        $ends = $this->request->data['end'];

        $projectUsers = $this->ProjectUsers->newEntity();
        // 担当する作業員の配列取得
        if(isset($this->request->data['operators'])) {
          $operators = $this->request->data['operators'];
          // プロジェクトの担当者一覧をいったん全削除して
          $pos = 0;
          foreach($operators as $operator):
            $work[$pos] = $this->ProjectUsers->newEntity();
            $work[$pos]->user_id = $operator;
    //                    $work['company_id'] = $company_id;
    //                    $work['project_id'] = $project_id;
                        // 該当者を改めて追加する
        //                $this->ProjectUsers = $work;
            $this->log($work , 'debug');
            $pos = $pos + 1;
          endforeach;
          $project->project_users = $work;
        }

//        // プロジェクトの保存できたら、
////        $checkboxs = $this->request->data['operators'];
//        $pos = 0;
//        // 作業期間の配列作成
//        foreach($starts as $start):
//          $periods[$pos] = $this->ProjectPeriods->newEntity();
//          $periods[$pos]->company_id = $start;
//          $periods[$pos]->start = $start;
//          $periods[$pos]->end = $ends[$pos];
//      //          $projectPeriods = $period;
//          $pos = $pos + 1;
//        endforeach;
//        $project->project_periods = $periods;


        // プロジェクトの作業期間を再設定する
//        $starts = $this->request->data['start'];
//        $ends = $this->request->data['end'];
        $projectPeriods_id = $this->request->data['projectPeriods_id'];
        $pos = 0;
        $work = [];
        foreach($starts as $start):
          $work[$pos] = $this->ProjectPeriods->newEntity();
          $work[$pos]->company_id = $this->Auth->user('company_id');
          $work[$pos]->id = $projectPeriods_id[$pos];
          $work[$pos]->start = $start;
          $work[$pos]->end = $ends[$pos];
          $pos = $pos + 1;
        endforeach;
        $project->project_periods = $work;


      }
      else
      {
        // **************************************************************//
        // Validation 正常時
        // **************************************************************//

        $this->log("Projects->add() : 4", 'debug');

        // 設定した値を再表示するために vallidate => false で再取得
        $project = $this->Projects->patchEntity($project, $this->request->data, [
          'validate' => false
        ]);
if(isset($this->request->data['completion_check'])) {
    $project->completion_check = true;
} else {
  $project->completion_check = false;
}
        // 金額のカンマ削除
        $project->money = str_replace(",","",$project->money);
        // 期間指定の配列取得
        $starts = $this->request->data['start'];
        $ends = $this->request->data['end'];

        $this->log("Projects->add() : 6", 'debug');

        // プロジェクトの開始日取得
        $pos = 0;
        date_default_timezone_set('Asia/Seoul');
        $project->start = date('Y/m/d');
        foreach($starts as $start):
          if($pos==0){
            $project->start = $start;
          } else {
            if($project->start > $start) {
              $project->start = $start;
            }
          }
          $pos = $pos + 1;
        endforeach;
        // プロジェクトの終了日取得
        $pos = 0;
        $project->end = date('Y/m/d');
        foreach($ends as $end):
          if($pos==0){
            $project->end = $end;
          } else {
            if($project->end < $end) {
              $project->end = $end;
            }
          }
          $pos = $pos + 1;
        endforeach;


        // トランザクション
        $connection = ConnectionManager::get('default');
        $connection->begin();

        // プロジェクト完了チェック
        if($project->completion_check) {
          $project->completion_check = true;
        } else {
          $project->completion_check = false;
        }

        // プロジェクトの作業期間を再設定する
        $starts = $this->request->data['start'];
        $ends = $this->request->data['end'];
        $projectPeriods_id = $this->request->data['projectPeriods_id'];
        $pos = 0;
        $work = [];
        foreach($starts as $start):
          $work[$pos] = $this->ProjectPeriods->newEntity();
          $work[$pos]->company_id = $this->Auth->user('company_id');
        //  $work[$pos]->project_id = $project_up->id;
          $work[$pos]->id = $projectPeriods_id[$pos];
          $work[$pos]->start = $start;
          $work[$pos]->end = $ends[$pos];
          $pos = $pos + 1;
        endforeach;
        $project->project_periods = $work;

        $work = [];
        // プロジェクトの保存できたら、
        $checkboxs = $this->request->data['operators'];
        $pos = 0;
        foreach($checkboxs as $check):
          $work[$pos] = $this->ProjectUsers->newEntity();
          $work[$pos]['user_id'] = $check;
          $work[$pos]['company_id'] = $this->Auth->user('company_id');
  //        $work[$pos]['project_id'] = $project_up->id;
          // 該当者を改めて追加する
//            $this->ProjectUsers->save($work[$pos]);
//          $this->log($work . "  saved.", 'debug');
          $pos++;
        endforeach;
            $project->project_users = $work;

        try{
          $pos = 0;
          foreach ($starts as $start) {
            if($ends[$pos] < $start) {
              // save() に失敗
              throw new Exception('工事着手日と工事完了日に矛盾があります');
            }
            $pos++;
          }




          // ■プロジェクトを保存する
          $project->project_users = null;
          $project->project_periods = null;

          // 完了チェックであれば図面情報を保存しないようにする
//          if($project->completion_check) {
//              $project->document = '';
//              unset($project->drawing);
//          }
          $project_up = $this->Projects->save($project);
          if ($project_up) {
            // プロジェクトが保存できたので、図面を保存する
            $key = $this->Auth->user('company_id');

            if (isset($project_up->drawing['error']) && $project_up->drawing['error'] === UPLOAD_ERR_OK) {
            //    debug($photo);
                $dir_to = "/work/papers";
                $file_to = "";

                $folder = new Folder($dir_to, true, 0755);
                $folder->create($dir_to . '/' . $project_up->id);
                $fname = urlencode($project_up->drawing['name']);

                $doc = file_get_contents($project_up->drawing['tmp_name']);

                if($doc === false) {
                  throw new RuntimeException('図面情報の保存に失敗しました');
                } else {

                    $file_to = $dir_to . '/' . $project_up->id . "/" . $fname;
                    file_put_contents($file_to, $doc);
                }
              }

            // 完了チェック時には図面書類を削除する
            if($project_up->completion_check) {
                $dir_wk = "/work/papers";
                $dir_delete = $dir_wk . '/' . $project_up->id;
                $dir = new Folder($dir_delete);
                $files = $dir->find();
                foreach ($files as $fname) {
                    $this->log('■', 'debug');
                    $this->log($fname, 'debug');
                    $path = $dir_delete . "/" . $fname;
                    $f = new File($path);
                    $f->delete();
                }
            }


            // プロジェクトの保存できたら、
            // プロジェクトの担当者の変更を確認する
            $checkboxs = $this->request->data['operators'];
//          $this->ProjectUsers->deleteAll(['project_id' => $project_up->id]);

            $users_all = $this->Users->find('all')
              ->where([
                'company_id' => $company_id,
              ]);

            $projectUsers_old = $this->ProjectUsers->find('all')
              ->where([
                'company_id' => $company_id,
                'project_id' => $project_id,
              ]);

            $pos = 0;
            $users_up = [];
            foreach($users_all as $usr):
              $users_up[$pos] = $this->Users->newEntity();
              $users_up[$pos]->id = $usr->id;
              $users_up[$pos]->name = $usr->name;
              $users_up[$pos]->email = $usr->email;
              $users_up[$pos]->op = "none";
              foreach($checkboxs as $new):
                if($new == $usr->id):
                  $users_up[$pos]->op = "add";
                endif;
              endforeach;
              foreach($projectUsers_old as $now):
                if($now->user_id == $usr->id):
                  if($users_up[$pos]->op == "add"):
                    $users_up[$pos]->op = "none";
                  elseif($users_up[$pos]->op == "none"):
                    $users_up[$pos]->op = "delete";
                  endif;
                endif;
              endforeach;
              $pos++;
            endforeach;

            $this->log($users_up, 'debug');

            foreach($users_up as $usr):
              $puser = $this->ProjectUsers->newEntity();
              $puser->user_id = $usr->id;
              $puser->company_id = $this->Auth->user('company_id');
              $puser->project_id = $project_up->id;
              $this->log('■', 'debug');
              $this->log($puser, 'debug');
              // 該当者を改めて追加する
              if($usr->op == "add"):
                $result = $this->ProjectUsers->save($puser);
                if ($result) {
          //        $this->Flash->success(__('プロジェクト参加ユーザーを更新しました'));
                } else {
                  // save() に失敗
                  throw new Exception('プロジェクト参加ユーザーの保存に失敗しました');
                }
//                if($id == "add" ||  $id = "addSingle") {
                  // 作業開始予定のメール送付
  //                MailProject::mailProject($this->Auth->user, $user);


    //            }
              endif;
              if($usr->op == "delete"):
                $delete = $this->ProjectUsers->query()->delete();
                $delete->where([
                  'company_id' => $this->Auth->user('company_id'),
                  'project_id' => $project_up->id,
                  'user_id' => $usr->id,
                ]);
//                $delete->execute();
//                $result = $this->ProjectUsers->delete($puser);
                if ($delete->execute()) {
        //          $this->Flash->success(__('プロジェクトの参加ユーザーから削除しました'));
                } else {
                  // save() に失敗
                  throw new Exception('プロジェクトの参加ユーザーからの削除に失敗しました');
                }
              endif;

              $this->log($users_all . "  saved.", 'debug');
            endforeach;

            $work = [];
            $pos = 0;
            foreach($checkboxs as $check):
              $work[$pos] = $this->ProjectUsers->newEntity();
              $work[$pos]['user_id'] = $check;
              $work[$pos]['company_id'] = $this->Auth->user('company_id');
              $work[$pos]['project_id'] = $project_up->id;
              // 該当者を改めて追加する
//            $this->ProjectUsers->save($work[$pos]);
  //          $this->log($work . "  saved.", 'debug');
              $pos++;
            endforeach;

//            $projectUsers = $work;
            $project->project_users = $work;

            // プロジェクトの作業期間を再設定する
            $starts = $this->request->data['start'];
            $ends = $this->request->data['end'];
            $projectPeriods_id = $this->request->data['projectPeriods_id'];
            // なお、作業期間の削除は個別に実施済
            $pos = 0;
            foreach($projectPeriods_id as $pid) {
              $exist = $this->ProjectPeriods->exists([
                'id' => $pid, 'start' => $starts[$pos], 'end' => $ends[$pos]
              ]);

              if(!$exist && $pid > 0) {
                // UPDATE : 作業期間が更新されていた場合
                $entity = $this->ProjectPeriods->get($pid);
                $entity->start = $starts[$pos];
                $entity->end = $ends[$pos];
                $result = $this->ProjectPeriods->save($entity);
                if ($result) {
      //            $this->Flash->success(__('作業期間情報を更新しました'));
                } else {
                  // save() に失敗
                  throw new Exception('作業期間情報の更新に失敗しました');
                }
                $this->log($entity, 'debug');
              }
              if(!$exist && $pid == 0) {
                // INSERT : 作業期間が追加されていた場合
                $entity = $this->ProjectPeriods->newEntity();
                $entity['company_id'] = $company_id;
                $entity['project_id'] = $project_up->id;
                $entity['start'] = $starts[$pos];
                $entity['end'] = $ends[$pos];
                $result = $this->ProjectPeriods->save($entity);
                if ($result) {
        //          $this->Flash->success(__('作業期間情報を追加しました'));
                } else {
                  // save() に失敗
                  throw new Exception('作業期間情報の保存に失敗しました');
                }
              }
              $pos++;
            }

            $pos = 0;
            // 作業期間の配列作成
            foreach($starts as $start):
              $periods[$pos] = $this->ProjectPeriods->newEntity();
              $periods[$pos]->id = $projectPeriods_id[$pos];
              $periods[$pos]->start = $start;
              $periods[$pos]->end = $ends[$pos];
//          $projectPeriods = $period;
              $pos = $pos + 1;
            endforeach;
            $project->project_periods = $periods;

            $pos = 0;
            $work = [];
            foreach($starts as $start):
              $work[$pos] = $this->ProjectPeriods->newEntity();
              $work[$pos]->company_id = $key;
              $work[$pos]->project_id = $project_up->id;
              $work[$pos]->id = $projectPeriods_id[$pos];
              $work[$pos]->start = $start;
              $work[$pos]->end = $ends[$pos];
//            $this->ProjectPeriods->save($work);
  //          $this->log($work . "  saved.", 'debug');
              $pos = $pos + 1;
    //                        if($start_first == null || $start_first > $start) {
      //                        $start_first = $start;
        //                    }
          //                  if($end_last == null || $end_last < $start) {
            //                  $end_last = $start;
              //              }
            endforeach;

                //        $project->start = $start_first;
                  //      $project->end = $end_last;

            $project->project_periods = $work;

            $projectPeriods = $work;

            // すべての処理が正常終了したので
            // 作業開始予定のメール送付
          //  $users_mail = [];
//            $pos = 0;
            $user_emails = $this->Users->newEntity();
    //        $user_emails = [];
            $pos = 0;
            $emails = [];
            foreach($users_up as $usr):
              if($usr->op == "add"):
//                $user_emails[$pos] = $this->Users->newEntity();
                if($pos = 0) {
                $emails = array($usr->email => $usr->name);
              } else {
                $emails = $emails + array($usr->email => $usr->name);
              }
//                if($to_emails != "") {
  //                  $to_emails .= ';';
    //            }
      //          $to_emails .= $usr->name . '<' . $usr->email . '>';
                $pos++;
              endif;
            endforeach;
            $this->log($user_emails, 'debug');

            $company = $this->Companies->get($company_id);
//              ->select(['name']);
//            foreach($users_up as $usr):
  //            // 該当者を改めて追加する
    //          if($usr->op == "add"):

            // 初回登録時のみメール送付する
            if($id == "add" ||  $id == "addSingle") {

                $subject = $project->project_name . '(' . $project->num . ')の作業が予定されました。';
                $body = MailProject::mailProject($company->name, $project_up->num, $project_up->project_name );
              // 端末承認の為のメールを作業員に送付する
              $e_mail = new Email('default');
//              $e_mail = new Email();
//              $e_mail->transport('default');

              $e_mail->to($emails)
              ->from([$this->Auth->user('email') => $this->Auth->user('name')])
//->sender(['ishida.takao@aaa.com' => $this->Auth->user('name')])
//->from(['ishida.takao@aaa.com' => $this->Auth->user('name')])
                ->subject($subject)
                ->send( $body );
                $this->log('■Email■:' , 'debug');
                $this->log($this->Auth->user('email') , 'debug');
                $this->log($this->Auth->user() , 'debug');
            }



// 図面用のディレクトリを作成しておく
// 図面移動先のディレクトリ
//$dir = new Folder();
//if($dir->create('/work/papers/' . $project_up->id)) {
//                if($dir->create(WWW_ROOT.'docs/' . $project->id)) {
//
//                }
//}



            if ($id === "add" || $id == "addSingle") {
              $this->Flash->success(__('プロジェクト情報を登録しました'));
            } else {
              $this->Flash->success(__('プロジェクト情報を更新しました'));
            }
            // 正常時
            $connection->commit();
            return $this->redirect(['action' => 'index']);

            // 作業員指定の配列取得
            $checkboxs = $this->request->data['operators'];
            foreach($checkboxs as $check):
              $this->log($check, 'debug');
            endforeach;
            $checkboxs = $this->request->data['operators'];
            $this->log('ProjectsController edit() : post', 'debug');
            $this->log("Projects->add() : 999", 'debug');
    //            $this->set(compact('projectUsers'));
    //            $this->set('_serialize', ['projectUsers']);

          } else {
            // 保存失敗時
            // save() に失敗
            $this->set("errors", $project_up->errors ());
            throw new Exception("プロジェクト情報の保存に失敗しました");
          }
        } catch(Exception $e) {
          $this->Flash->error($e->getMessage());
          $connection->rollback();
        }

      }
    // POST処理の終わり
    endif;

    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
//    $this->set(compact('projectUsers'));
//    $this->set('_serialize', ['projectUsers']);
//    $this->set(compact('projectPeriods'));
//    $this->set('_serialize', ['projectPeriods']);
    $this->set(compact('clients'));
    $this->set('_serialize', ['clients']);
    $this->set(compact('categories'));
    $this->set('_serialize', ['categories']);
  }

  /**
   * EditSingle method
   *
   * 単発案件プロジェクト更新
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function editSingle($id = null)
  {
    if( $id === "add" ) {
      $this->set ('mode', 'add');
      $this->set('from', 'add');
    } else {
      $this->set ('mode', 'edit');
      $this->set('from', 'edit');
    }

    $user_id = $this->Auth->user('id');
    $company_id = $this->Auth->user('company_id');
    $this->log("company_id : " . $company_id, 'debug');
    // 作業員
    $users = $this->Users->find('all')
      ->where([
        'company_id' => $company_id,
        'role' => 'operator',
      ]);

//    if ($id == "add" && ($this->request->is(['get']) ||
  //          null != $this->request->data('urlfrom') && null == $this->request->data('edit_single'))) {
      if ($id == "add" && ($this->request->is(['post']) &&
          null != $this->request->data('urlfrom') && null == $this->request->data('edit_single'))) {
      //  add : first
      $this->log("▼", 'debug');
      $this->log("Projects->addSingle(GET) : ", 'debug');
      $project = $this->Projects->newEntity();
      $projectUsers = $this->ProjectUsers->newEntity();
      $projectPeriods = $this->ProjectPeriods->newEntity();
      date_default_timezone_set('Asia/Seoul');
      $projectPeriods->start = date('Y/m/d'); //Period = $this->ProjectPeriods->newEntity();
      $projectPeriods->end = date('Y/m/d');
      $projectPeriods->company_id = $this->Auth->user('company_id');
      $project->project_periods = [$projectPeriods];
    } elseif ($id != "add" && $id != null && $this->request->is(['post']) &&
               null != $this->request->data('urlfrom') &&
               null == $this->request->data('edit_single')) {
      //  edit : first
      $this->log("Projects->editSingle(edit:GET) :" . $id, 'debug');
      $project = $this->Projects->get($id, [
        'contain' => ['ProjectUsers', 'ProjectPeriods']
      ]);
      // 作業期間は１つのみ
      $projectPeriods = $project->project_periods;
      if($projectPeriods == null) {
        $project->start = date('Y/m/d');
        $project->end = date('Y/m/d');
        $project->projectPeriod_id = 0;
      } else {
        $project->project_periods[0]->start = $project->project_periods[0]->start->format('Y/m/d');
        $project->project_periods[0]->end = $project->project_periods[0]->end->format('Y/m/d');
        $project->start = $project->project_periods[0]->start;
        $project->end = $project->project_periods[0]->end;
        $project->projectPeriod_id = $project->project_periods[0]->id;
      }
    } elseif ($this->request->is(['post']) && null != $this->request->data('edit_single')) {
      // POST時
      if ($id === "add") {
        // ADD 時
        $this->log("Projects->addSingle(POST) : 2", 'debug');
        // 'add': next
        $project = $this->Projects->newEntity();
        $projectPeriods = $this->ProjectPeriods->newEntity();
        $projectPeriods->start = $this->request->data['start'];
        $projectPeriods->end = $this->request->data['end'];
        $projectPeriods->id = $this->request->data['projectPeriod_id'];
//        $projectPeriods->start = $projectPeriods->start->format('Y/m/d');
  //      $projectPeriods->end = $projectPeriods->end->format('Y/m/d');
        $projectPeriods->company_id = $this->Auth->user('company_id');
        $project->project_periods = [$projectPeriods];
      }
      if ($id != "add") {
        // EDIT 時
        $this->log("Projects->editSingle(POST) : 2", 'debug');
        $project = $this->Projects->get($id, [
          'contain' => ['ProjectUsers', 'ProjectPeriods']
        ]);
      }
      // ADD と POST で共通の保存処理
      $project = $this->Projects->patchEntity($project, $this->request->data, [
        'validate' => 'addsingle'
      ]);
      if($project->errors ()) {
        // Validation Error時
        $this->set("errors", $project->errors ());

        // 元の値を再取得
        $project = $this->Projects->patchEntity($project, $this->request->data, [
          'validate' => false
        ]);

        // completion_check
        if(isset($this->request->data['completion_check'])) {
            $project->completion_check = true;
        } else {
          $project->completion_check = false;
        }


      } else {
        // Validation 正常時

        // 元の値を再取得
        $project = $this->Projects->patchEntity($project, $this->request->data, [
          'validate' => false
        ]);

        // 金額のカンマ区切り除去
        $project->money = str_replace(",","",$project->money);

        //  会社ID を設定する
        $project->company_id = $this->Auth->user('company_id');
        //  単独プロジェクト・フラグの設定
        $project->single = true;

        if(isset($this->request->data['completion_check'])) {
          $project->completion_check = true;
        } else {
          $project->completion_check = false;
        }

        // completion_check
        if(isset($this->request->data['completion_check'])) {
            $project->completion_check = true;
        } else {
          $project->completion_check = false;
        }


//        $project->start = new \DateTime($this->request->data('start'));
  //      $project->end = $this->request->data('end');

        // トランザクション
        $connection = ConnectionManager::get('default');
        $connection->begin();


        try{

          $pos = 0;
            if(strtotime($project->end) < strtotime($project->start)) {
              // save() に失敗
              throw new Exception('工事着手日と工事完了日に矛盾があります');
            }





            $projectPeriod = $project->project_periods[0];
            $projectPeriod->start = $this->request->data('start');
            $projectPeriod->end = $this->request->data('end');
            $projectPeriod->company_id = $this->Auth->user('company_id');
            $projectPeriod->id = $this->request->data('projectPeriod_id');
            $project->project_periods = [$projectPeriod];  //$this->request->data('start');
  //          $project->project_periods[0]['end'] = $this->request->data('end');
    //        $project->project_periods[0]['company_id'] = $this->Auth->user('company_id');


        // プロジェクトを保存する
        $project_up = $this->Projects->save($project);
        if ($project_up) {
          // プロジェクトが保存できたので、担当作業者と作業期間も保存する
          $key = $this->Auth->user('company_id');


          // プロジェクトの保存できたら、
          // プロジェクトの担当者一覧をいったん全削除して
          if( isset($this->request->data['operators'])) {
            $checkboxs = $this->request->data['operators'];
            $operator_ids = $this->request->data['operator_ids'];
//              $this->ProjectUsers->deleteAll(['project_id' => $project_up->id]);
$pos = 0;
$pos_up = 0;
            $work = [];
//              foreach($checkboxs as $check):
              foreach($operator_ids as $opid):
                $work[$pos] = $this->ProjectUsers->newEntity();
                if(isset($checkboxs[$pos])) {
                    $work[$pos]['user_id'] = $checkboxs[$pos];
//                    $pos_up++;
                } else {
                  $work[$pos]['user_id'] = 0;
//                    $work[$pos]['company_id'] = 0;
                }
                $work[$pos]['company_id'] = $this->Auth->user('company_id');
                $work[$pos]['project_id'] = $project_up->id;
                $work[$pos]['id'] = $opid;
//                $work[$pos]['project_id'] = $project_up->id;
              if($work[$pos]['user_id'] == 0 && $work[$pos]['id'] != 0) {
                // delete
                $entity = $this->ProjectUsers->get($work[$pos]['id']);
                $result = $this->ProjectUsers->delete($entity);
                if($result) {
                //  $this->Flash->success('projectUsers 削除');
                } else {
                  throw new Exception('projectUsers の削除に失敗しました');
                }
              }
              if($work[$pos]['user_id'] != 0 && $work[$pos]['id'] == 0) {
                // insert
                $result = $this->ProjectUsers->save($work[$pos]);
                if($result) {
              //    $this->Flash->success('projectUsers 追加');
                } else {
                  throw new Exception('projectUsers の追加に失敗しました');
                }
              }
              if($work[$pos]['user_id'] != 0 && $work[$pos]['id'] != 0) {
                // update
                $result = $this->ProjectUsers->save($work[$pos]);
                if($result) {
            //      $this->Flash->success('projectUsers 更新');
                } else {
                  throw new Exception('projectUsers の更新に失敗しました');
                }
              }

              // 該当者を改めて追加する
//              $result = $this->ProjectUsers->save($work);
  //            if ($result) {
    //            $this->Flash->success(__('担当作業員を更新しました'));
      //        } else {
        //        $this->Flash->error(__('担当作業員の更新に失敗しました'));
          //    }
//                $this->log($work[$pos] . "  saved.", 'debug');
            $pos++;

            endforeach;


            //$project->project_users = $work;
          }

/*
          // プロジェクトの保存できたら、
          // プロジェクトの担当者一覧をいったん全削除して
          if( isset($this->request->data['operators'])) {
            $checkboxs = $this->request->data['operators'];
            $this->ProjectUsers->deleteAll(['project_id' => $project_up->id]);
            foreach($checkboxs as $check):
              $work = $this->ProjectUsers->newEntity();
              $work['user_id'] = $check;
              $work['company_id'] = $key;
              $work['project_id'] = $project_up->id;
              // 該当者を改めて追加する
              $result = $this->ProjectUsers->save($work);
              if ($result) {
                $this->Flash->success(__('担当作業員を更新しました'));
              } else {
                $this->Flash->error(__('担当作業員の更新に失敗しました'));
              }
              $this->log($work . "  saved.", 'debug');
            endforeach;
          }
*/

/*
          // プロジェクトの作業期間を再設定する
          $projectPeriod_up = $this->ProjectPeriods->find('all')
            ->contain([])
            ->where([
              'company_id' => $this->Auth->user('company_id'),
              'project_id' => $project_up->id,
            ])
            ->first();
*/

//          $start = $this->request->data['start'];
//          $end = $this->request->data['end'];
//          $pid = $this->request->data['projectPeriod_id'];
          // なお、作業期間の削除は個別に実施済
//          $pos = 0;
//          $exist = $this->ProjectPeriods->exists([
//            'id' => $pid, 'start' => $start, 'end' => $end
//          ]);


/*
          if($projectPeriod_up) {
              // UPDATE : 作業期間が既に存在する
              if($projectPeriod_up->start != $project_up->start || $projectPeriod_up->end != $project_up->end):
                 $projectPeriod_up->start = $project_up->start;
                 $projectPeriod_up->end = $project_up->end;
                 $this->log('▼', 'debug');
                 $this->log($projectPeriod_up, 'debug');
                 $result = $this->ProjectPeriods->save($projectPeriod_up);
                 if ($result) {
                   $this->Flash->success(__('作業期間を更新しました'));
                 } else {
                   $this->Flash->error(__('作業業期間の保存に失敗しました'));
                 }
               endif;
          } else {
                // INSERT : 既存の作業期間がまだ無い
            $projectPeriod_up = $this->ProjectPeriods->newEntity();
            $projectPeriod_up['company_id'] = $this->Auth->user('company_id');
            $projectPeriod_up['project_id'] = $project_up->id;
            $projectPeriod_up['start'] = $project_up->start;
            $projectPeriod_up['end'] = $project_up->end;
            $this->log('■', 'debug');
            $this->log($projectPeriod_up, 'debug');
          //  $result = $this->ProjectPeriods->save($projectPeriod_up);
            if ($result) {
              $this->Flash->success(__('作業期間を追加しました'));
            } else {
              $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
          }


          */


}


                    // **************************************************************//
                    //  すべての処理が正常終了したので 作業開始予定のメール送付
                    // **************************************************************//
                    $user_emails = $this->Users->newEntity();

                    // プロジェクトの担当者一覧取得
                    $workers = $this->ProjectUsers->find('all')
                        ->contain(['Users'])
                        ->where([
                            'project_id' => $project_up->id,
                        ]);

                    // メールの宛先をひとつにする
                    $pos = 0;
                    $emails = [];
                    foreach($workers as $usr):
                        if($pos == 0) {
                            $emails = array($usr->user->email => $usr->user->name);
                        } else {
                            $emails = $emails + array($usr->user->email => $usr->user->name);
                        }
                        $pos++;
                    endforeach;
                    $this->log($emails, 'debug');

                    $company = $this->Companies->get($company_id);

                    // 初回登録時のみメール送付する
                    if($id == "add") {
                        $subject = $project->project_name . '(' . $project->num . ')の作業が予定されました。';
                        $body = MailProject::mailProject($company->name, $project_up->num, $project_up->project_name );
                        // 端末承認の為のメールを作業員に送付する
                        $e_mail = new Email('default');

                        $e_mail->to($emails)
                            ->from([$this->Auth->user('email') => $this->Auth->user('name')])
                            ->subject($subject)
                            ->send( $body );
                            $this->log('Email:' , 'debug');
                        }


                    //  正常時 : COMMIT して終了
                     $connection->commit();
                   if ($id === "add") {
                         $this->Flash->success(__('単発プロジェクトを追加しました'));
                     } else {
              $this->Flash->success(__('単発プロジェクトを更新しました'));
          }
          return $this->redirect(['action' => 'index']);

      } catch(Exception $e) {
        $this->Flash->error($e->getMessage());
        $connection->rollback();
      }

//          $pos++;
//        }

      }
      // POST時

      // ユーザー設定の画面表示用
      if(isset($this->request->data['operators'])) {
        $operators = $this->request->data['operators'];
        $operator_ids = $this->request->data['operator_ids'];
        // プロジェクトの担当者一覧を再作成, user_id のみ設定
        $pos = 0;
        $work = [];
        foreach($operator_ids as $opid):
          $work[$pos] = $this->ProjectUsers->newEntity();
          if(isset($operators[$pos])) {
            $work[$pos]->user_id = $operators[$pos];
          } else {
            $work[$pos]->user_id = 0;
          }
          $work[$pos]->id = $opid;
          //           $work['company_id'] = $company_id;
          //           $work['project_id'] = $project_id;
          $this->log($work , 'debug');
          $pos = $pos + 1;
        endforeach;
        //  プロジェクトに設定する
        $project->project_users = $work;
      }

      $project->project_periods[0]['start'] = $this->request->data('start');
      $project->project_periods[0]['end'] = $this->request->data('end');
    }

    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
//    $this->set(compact('projectUsers'));
  //  $this->set('_serialize', ['projectUsers']);
    $this->set(compact('projectPeriod'));
    $this->set('_serialize', ['projectPeriod']);
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

        // トランザクション
        $connection = ConnectionManager::get('default');
        $connection->begin();

        try{
            $project = $this->Projects->get($id);
            if(!$project) {
                throw new Exception('プロジェクト-ID を確認してください');
            }

            // プロジェクトの図面ファイル削除
            $dir_wk = "/work/papers";
            $dir_delete = $dir_wk . '/' . $project->id;
            $dir = new Folder($dir_delete);
            $files = $dir->find();
            foreach ($files as $fname) {
                $this->log('■', 'debug');
                $this->log($fname, 'debug');
                $path = $dir_delete . "/" . $fname;
                $f = new File($path);
                $f->delete();
            }
            if(count($files) >= 1) {
                $this->Flash->success(__('プロジェクトの 図面ファイルを削除しました'));
            }

            // プロジェクトへの参加作業員情報の削除
            $delete = $this->ProjectUsers->query()->delete();
            $delete->where([
                'company_id' => $this->Auth->user('company_id'),
                'project_id' => $project->id,
            ]);
            if ($delete->execute()) {
                $this->Flash->success(__('プロジェクトの 参加作業員情報を削除しました'));
            } else {
                // save() に失敗
                throw new Exception('プロジェクトの 参加作業員情報の削除に失敗しました');
            }

            // プロジェクトの作業期間情報の削除
            $delete = $this->ProjectPeriods->query()->delete();
            $delete->where([
                'company_id' => $this->Auth->user('company_id'),
                'project_id' => $project->id,
            ]);
            if ($delete->execute()) {
                $this->Flash->success(__('プロジェクトの 作業期間情報を削除しました'));
            } else {
                // save() に失敗
                throw new Exception('プロジェクトの 作業期間情報の削除に失敗しました');
            }

            // プロジェクトの日報削除
            $delete = $this->Reports->query()->delete();
            $delete->where([
                'company_id' => $this->Auth->user('company_id'),
                'project_id' => $project->id,
            ]);
            if ($delete->execute()) {
                $this->Flash->success(__('プロジェクトの 日報情報を削除しました'));
            } else {
                // save() に失敗
                throw new Exception('プロジェクトの 日報情報の削除に失敗しました');
            }

            // プロジェクトの削除
            $name = $project->project_name;
            if ($this->Projects->delete($project)) {
                $this->Flash->success('プロジェクト < ' .  $project->num .  ' > を削除しました');
            } else {
                throw new Exception('プロジェクトを削除できませんでした');
            }

            $connection->commit();

        } catch(Exception $e) {
            $this->Flash->error($e->getMessage());
            $connection->rollback();
        }

      return $this->redirect(['action' => 'index']);
    }
}
