<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use App\Utils\DatetimeUtility;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use \Exception;
use Cake\I18n\Time;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class ReportsController extends AppController
{

  public $paginate = [
//    'fields' => ['id','company_id','project_id','user_id','work_date',
  //               'start_time','end_time','salaried','holiday_work','allowance','note','remaining'],
    'limit' => 10,
    'order' => ['id' => 'desc']
  ];

  public function initialize()
  {
    parent::initialize();

    $this->Session = $this->request->session();


        //      $this->Users  = TableRegistry('Users');
        $this->Companies = TableRegistry::get('Companies');
        $this->Users  = TableRegistry::get('Users');
        $this->Projects = TableRegistry::get('Projects');
        $this->Reports  = TableRegistry::get('Reports');
        $this->ProjectUsers  = TableRegistry::get('ProjectUsers');
        $this->ProjectPeriods  = TableRegistry::get('ProjectPeriods');
        $this->Clients = TableRegistry::get('Clients');
        $this->Materials = TableRegistry::get('Materials');
        $this->Categories = TableRegistry::get('Categories');
        $this->ReportMaterials = TableRegistry::get('ReportMaterials');
        $this->MonthlyReports = TableRegistry::get('MonthlyReports');

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
  public function index($id = NULL)
  {
    /*
    $this->paginate = [
      'fields' => ['id','company_id','project_id','user_id','work_date',
                   'start_time','end_time','salaried','holiday_work','allowance','note','remaining'],
      'limit' => 5,
      'order' => ['id' => 'desc']
    ];


//    $project_id = $this->Session->read('Projct.id');
    $company_id = $this->Auth->user('company_id');

    if($id==null):
        if ($this->request->is(['patch', 'post', 'put'])) {
            $year_yy = $this->request->data('year_yy');
            $month_mm =    $this->request->data('month_mm');
            $day_dd =   $this->request->data('day_dd');
            $dt = $year_yy . '-' . $month_mm . '-' . $day_dd;
        } else{
            $dt = date('Y-m-d');
            $dt = date('2016-9-3');
            $year_yy = date('Y');
            $month_mm = date('m');
            $day_dd = date('d');
            $day_dd = 3;

        }
    else:
        $report = $this->Reports->get($id);
        $dt = $report->work_date;
        $year_yy = $dt->format('Y');
        $month_mm = $dt->format('m');
        $day_dd = $dt->format('d');
    endif;

    $reports = $this->Reports->find('all')
      ->select(['Reports.id','Users.id','Users.name','Users.image'])
      ->contain(['Users'])
      ->where([
        'Reports.company_id' => $company_id,
//          'Reports.project_id' => $project_id,
        'Reports.work_date' => $dt,
        'Reports.single' => 1,
      ]);

    if($this->Auth->user('role') == "operator") {
      $reports = $reports
        ->where([
          'Reports.user_id' => $this->Auth->user('id'),
        ]);
    }

    $reports = $this->paginate($reports);

//    $project = $this->Projects->get($project_id);
//    if($project){
//        $this->Flash->errror('プロジェクト情報が登録され');
//    }
//    $this->Session->write('Project.id', $project_id);

    $this->Session->write('Url.from', 'indexSingle');

    $Url = ['from' => 'index-single'];
    $this->set(compact('Url'));

    $this->set(compact(['year_yy', 'month_mm', 'day_dd']));

    $this->set('role',$this->Auth->user('role'));
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
*/

    $project_id = $id;
    $company_id = $this->Auth->user('company_id');

    if( $project_id == NULL ) {
      $project_id = $this->Session->read('Project.id');
    } else {
      $this->Session->write('Project.id', $id);

    }

    if($id==null):
        if ($this->request->is(['patch', 'post', 'put'])) {

            if(null != $this->request->data('report_end_id')):
                // 印刷済みの設定
                $print_id = $this->request->data('report_end_id');
                $report = $this->Reports->get($print_id);
                $report->printed = true;
                $this->Reports->save($report);
            endif;

            $year_yy = $this->request->data('year_yy');
            $month_mm =    $this->request->data('month_mm');
            $day_dd =   $this->request->data('day_dd');
            $dt = $year_yy . '-' . $month_mm . '-' . $day_dd;
        } else{

//          date_default_timezone_set('Asia/Seoul');
  //          $dt = date('Y-m-d');
    ////          $dt = date('2016-9-3');
      //      $this->Session->write('Url.year', date('Y'));
        //    $this->Session->write('Url.month', date('m'));
          //  $this->Session->write('Url.day', date('d'));

    //        $year_yy = $this->Session->read('Url.year');
      //      $month_mm = $this->Session->read('Url.month');
        //    $day_dd = $this->Session->read('Url.day');
          //  $dt = date($year_yy . '-' . $month_mm . '-' . $day_dd);

          date_default_timezone_set('Asia/Seoul');
            $dt = date('Y-m-d');
  //          $dt = date('2016-9-3');
            $year_yy = date('Y');
            $month_mm = date('m');
            $day_dd = date('d');
      //    //  $day_dd = 3;

        }
    else:
    //  $year_yy = $this->Session->read('Url.year');
    //  $month_mm = $this->Session->read('Url.month');
    //  $day_dd = $this->Session->read('Url.day');
    //  $dt = date($year_yy . '-' . $month_mm . '-' . $day_dd);

          date_default_timezone_set('Asia/Seoul');
                $dt = date('Y-m-d');
  //    $dt = date('2016-9-3');
      $year_yy = date('Y');
      $month_mm = date('m');
      $day_dd = date('d');
  //    $day_dd = 3;

//        $report = $this->Reports->get($id);
  //      $dt = $report->work_date;
    //    $year_yy = $dt->format('Y');
      //  $month_mm = $dt->format('m');
        //$day_dd = $dt->format('d');
    endif;

    $projectUsers = $this->ProjectUsers->find('all')
//    ->select(['ProjectUsers.id','ProjectUsers.user.name','ProjectUsers.user.image','rp.id'])
    ->select(['ProjectUsers.id', 'Users.name', 'Users.id', 'rp.id', 'rp.printed'])
    ->contain(['Users'])
    ->join([
        'table' => 'reports',
        'alias' => 'rp',
        'type' => 'LEFT',  //LEFT',
        'conditions' => [
          'rp.company_id = ProjectUsers.company_id',  // . $company_id,
          'rp.project_id = ProjectUsers.project_id',  // . $project_id,
          'rp.user_id = ProjectUsers.user_id',
          'rp.work_date = ' . "'" . $dt . "'",
          'rp.single = false',
        ],
    ])
    ->where([
      'ProjectUsers.company_id' => $company_id,
      'ProjectUsers.project_id' => $project_id,
//      'Reports.work_date' => $dt,
//          'Users.role' => 'operator',
//      'Reports.single' => 0,
    ])
    ->order([
//      'work_date' => 'asc',
      'ProjectUsers.user_id' => 'desc',
    ]);

    if($this->Auth->user('role') == "operator") {
      $projectUsers = $projectUsers
        ->where([
          'ProjectUsers.user_id' => $this->Auth->user('id'),
        ]);
    }

    $projectUsers = $this->paginate($projectUsers);

foreach ($projectUsers as $projectUser) {
    # code...
}
    $num = $projectUsers->count();

//    $reports = $this->Reports->find('all')
//      ->select(['Reports.id','Users.id','Users.name','Users.image'])
//      ->contain(['Users'])
//      ->where([
//        'Reports.company_id' => $company_id,
//        'Reports.project_id' => $project_id,
//        'Reports.work_date' => $dt,
////          'Users.role' => 'operator',
//        'Reports.single' => 0,
//      ])
//      ->order([
//        'work_date' => 'asc',
//        'Reports.id' => 'asc',
//    ]);


//    if($this->Auth->user('role') == "operator") {
//      $reports = $reports
//        ->where([
//          'Reports.user_id' => $this->Auth->user('id'),
//        ]);
//    }

//    if($Url['from'] == "index") {
//        $reports = $reports
//          ->where([
//            'Reports.project_id' => $project_id,
//          ]);
//    }

//    $reports = $this->paginate($reports);

//     elseif($this->Auth->user('role') == "operator") {
//      $reports = $this->paginate($this->Reports->find('all')
//        ->select(['Reports.id','Users.id','Users.name','Users.image'])
//        ->contain(['Users'])
//        ->where([
//          'Reports.company_id' => $company_id,
//          'Reports.project_id' => $project_id,
//          'Reports.user_id' => $this->Auth->user('id'),
////          'Users.role' => 'operator',
//          'Reports.single' => 0,
//        ])
//        ->order([
//          'work_date' => 'asc',
//          'Reports.id' => 'asc',
//        ])
//    );
 // }
    $project = $this->Projects->get($project_id);

   // $this->Session->write('Project.id', $project_id);

    $Url = ['from' => 'index'];
    $this->set(compact('Url'));

    $this->Session->write('Url.from', 'index');
    $this->set(compact(['year_yy', 'month_mm', 'day_dd']));

    $this->set('role',$this->Auth->user('role'));
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('projectUsers'));
    $this->set('_serialize', ['projectUsers']);
  }

  /**
   * IndexMonthly method
   *
   * @return \Cake\Network\Response|null
   */
  public function indexMonthly()
  {
    $this->paginate = [
     'limit' => 10,
  //   'order' => ['id' => 'desc']
    ];


    // 会社ID
    $company_id  = $this->Auth->user('company_id');
    //
    $clients = $this->Clients->find('all')
      ->where([
        'company_id' => $this->Auth->user('company_id')
      ]);


//    if($this->Auth->user('role') == "operator"):
      // 管理者でログインした場合は社内全体のプロジェクトを参照する
//      $projects = $this->paginate($this->Projects->find('all')
//        ->contain([''])
//        ->where(function ($exp, $q) {
//          return $exp->in('id',
//            $this->ProjectUsers->find('all')
//              ->select(['project_id'])
//              ->where([
//                'company_id' => $this->Auth->user('company_id'),
//              ])
//          );
//        })
//        ->where([
//          'completion_check' => 0,
//        ])
//      );

// 最初は当月で検索する
if ($this->request->is(['get']) ||
  ($this->request->is(['post']) && null != $this->request->data('urlfrom'))) {
    $this->log('Report index-monthly GET', 'debug');
    $now = new \DateTime('Now');
    $year = $now->format('Y');
    $month = $now->format('n');
    $month_str = mb_convert_kana($now->format('n'), 'N');
    $start = strtotime(date('Y/m/01'));
    $end = strtotime(date('Y/m/01'). '+1 month');
    $client_sel = "";
}
elseif ($this->request->is(['post'])) {
    $client_sel = $this->request->data('selectName');
    $year = $this->request->data('year_yy');
    $month = $this->request->data('month_mm');
    $month_str = mb_convert_kana($month, 'N');
    $start = strtotime(date($year . '/' . $month . '/01'));
    $end = strtotime(date($year . '/' . $month . '/01 00:00:00'). '+1 month');
}

$this->Session->write('Project.year', $year);
$this->Session->write('Project.month', $month);

/*
  $projects = $this->Projects->find('all')
  ->contain(['Clients', 'Reports'])
  ->select(['Clients.id', 'Clients.name'])
  ->where([
//      'Projects.single' => false,
      'Reports.company_id' => $company_id,
  //    'Reports.single' => false,
      'Reports.work_date >= ' => $start,  //year . '/' . $month . '/' . '01',
      'Reports.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
  ])
  ->group([
      'Clients.id',
    ])
  ->order(['Clients.id' => 'desc'
  ]);

  if($client_sel != "" && $client_sel != "0" && $client_sel != "all" ) {
    $projects = $projects
    ->where([
        'Client.id' => $client_sel,
    ]);
  }

if($this->Auth->user('role') == "operator") {
  $projects = $projects
    ->where([
        'Reports.user_id' => $this->Auth->user('id'),
    ]);
}

$projects = $this->paginate($projects);
*/
/*
//    if ($this->request->is(['get'])) {
$projectUsers = $this->paginate($this->ProjectUsers->find('all')
  ->contain(['Users', 'MonthlyReports', 'Reports'])
  ->join([
      'table' => 'monthly_reports',
      'alias' => 'mr',
      'type' => 'INNER',  //LEFT',
      'conditions' => [
        'mr.company_id = ' . $company_id,
        'mr.project_id = ' . $project_id,
        'mr.user_id = ProjectUsers.user_id',
        'mr.year = ' . $this->Session->read('Project.year') . "",
        'mr.month = ' .$this->Session->read('Project.month') . "",
      ],
  ])
//        ->join([
//            'table' => 'reports',
//            'alias' => 'rp',
//            'type' => 'LEFT',
//            'conditions' => [
//              'rp.company_id = ' . $company_id,
//              'rp.project_id = ' . $project_id,
//              'rp.user_id = ProjectUsers.user_id',
  //      'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
  //      DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
//            ],
//        ])
  ->select([
    "id" => "ProjectUsers.id",
    "company_id" => "ProjectUsers.company_id",
  ])
  ->where([
    'ProjectUsers.project_id' => $id
  ])
);

*/


      // 管理者でログインした場合は社内全体のプロジェクトを参照する
      $projects = $this->Projects->find('all')
        ->contain(['Clients', 'Reports'])
//        ->select(['Projects.id', 'Projects.num', 'Projects.project_name', 'Clients.name'])
        ->select(['Clients.name', 'Clients.id'])
        ->where([
            'Projects.single' => false,
            'Projects.company_id' => $company_id,
            'Reports.single' => false,
            'Reports.work_date >= ' => $start,  //year . '/' . $month . '/' . '01',
            'Reports.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
        ])
//        ->join([
  //                'table' => 'reports',
    //              'alias' => 'rp',
      //            'type' => 'LEFT',
        //          'conditions' => [
          //            'rp.project_id = Projects.id',
            //          'rp.user_id = ProjectUsers.user_id',
              //        'rp.work_date >= ' . $start,
                //      'rp.work_date < ' . $end,
//                //'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
  //              DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
  //                  ],
    //            ])
        ->group([
            'Clients.id',
    //      ])
//        ->order([
  //          'Projects.id' => 'desc'
        ]);

        if($client_sel != "" && $client_sel != "0" && $client_sel != "all" ) {
            $projects = $projects
            ->where([
                'Projects.client_id' => $client_sel,
            ]);
        }

    if($this->Auth->user('role') == "operator") {
        $projects = $projects
          ->where([
              'Reports.user_id' => $this->Auth->user('id'),
          ]);
    }

    $projects = $this->paginate($projects);



//        ->where(function ($exp, $q) {

      // 管理者でログインした場合は社内全体のプロジェクトを参照する
//      $projects = $this->paginate($this->Projects->find('all')
//        ->contain(['Reports'])
//        ->where(function ($exp, $q) {
//            $now = new \DateTime('Now');
//            $year = $now->format('Y');
//            $month = $now->format('n');
            // 会社ID
//            $company_id  = $this->Auth->user('company_id')

//        });
//          return $exp->in('id',
//            $this->Reports->find('all')
//              ->select(['project_id'])
//              ->where([
//                  'company_id' => $company_id,
//                  'work_date >= ' => $year . '/' . $month . '/' . '01',
//                  'work_date <= ' => $year . '/' . $month . '/' . '29',
//              ])
//              ->group(['project_id'])
//              ->where([
//                'company_id' => $this->Auth->user('company_id'),
//              ])
//          );
        //);
//        ->where([
//          'completion_check' => 0,
//        ])
//      );



//      $reports = $this->Reports->find('all', [
//        'contain' => []
//      ])
//        ->select(['Reports.project_id'])
//        ->where([
//            'Reports.company_id' => $company_id,
//            'Reports.work_date >= ' => $year . '/' . $month . '/' . '01',
//            'Reports.work_date <= ' => $year . '/' . $month . '/' . '29',
//        ])
//        ->group(['project_id'])
//      ;

//      foreach ($reports as $report) {
//          # code...
//      }
//      $reports->count();

//    $projects = $this->Projects->find('all', [
//      'contain' => ['Reports']
//    ])
//      ->select(['Projects.id', 'project_name', 'client_id', 'Projects.company_id'])
//      ->where([
//          'Projects.company_id' => $company_id,
//      ])
//    ;

/*
    // 全社プロジェクト一覧
    if($this->Auth->user('role') == "president"):
      $projects = $this->paginate($this->Projects->find('all', [
        'contain' => ['Companies', 'Clients', 'ProjectUsers']
      ])
        ->select(['Projects.id', 'project_name', 'client_id', 'Projects.company_id'])
        ->where(['Projects.company_id' => $company_id])
    );
    endif;
    // 自分の担当しているプロジェクト一覧
    if($this->Auth->user('role') == "operator"):
c    endif;


//        ->select(['Projects.id', 'project_name', 'client_id', 'Projects.company_id'])
  //      ->where(['Projects.company_id' => $company_id,
    //             'Projects.ProjectUsers.user_id' => $this->Auth->user('id')])
    //);
    //endif;
/*

    if($this->Auth->user('role') == "operator"):
      // 管理者でログインした場合は社内全体のプロジェクトを参照する
      $projects = $this->paginate($this->Projects->find('all')
        ->contain(['ProjectPeriods'])
        ->where(function ($exp, $q) {
          return $exp->in('id',
            $this->ProjectUsers->find('all')
              ->select(['project_id'])
              ->where([
                'company_id' => $this->Auth->user('company_id'),
              ])
          );
        })
        ->where([
          'completion_check' => 0,
        ])
      );
*/

//          ->group(['Projects.id', 'project_name', 'client_id', 'Projects.company_id']);
  //    else:
    //    $monthly = $this->Projects->find('all', [
      //    'contain' => ['Clients']
        //])
          //->select(['Projects.id', 'project_name', 'client_id', 'Projects.company_id'])
    //      ->where(['Projects.company_id' => intval($this->Auth->user('company_id'))])
      //    ->group(['Projects.id', 'project_name', 'client_id', 'Projects.company_id']);
      //endif;
/*
    // 全クライアント一覧
    $clients = $this->Clients->find('all', [
      'contain' => []
    ])
      ->where(['company_id' => $company_id]);


    if ($this->request->is(['get'])) {
      $this->log('Report index-monthly GET', 'debug');
      $now = new \DateTime('Now');
      $year = $now->format('Y');
      $month = $now->format('n');
      $month_str = mb_convert_kana($now->format('n'), 'N');

//      $yyyymm = $year . $month;
      $yyyymm = $year . sprintf("%'.02d", $month);

      $this->Session->write('Project.year', $year);
      $this->Session->write('Project.month', $month);
    }
    if ($this->request->is(['post'])) {
      $this->log('Report index-monthly POST', 'debug');
      $year = $this->request->data('year_yy');
      $month = $this->request->data('month_mm');
      $month_str = mb_convert_kana($month);

//      $month = sprintf("%'.02d", $month);
      $yyyymm = $year . sprintf("%'.02d", $month);
      $month = $this->request->data('month_mm');

      $this->Session->write('Project.year', $year);
      $this->Session->write('Project.month', $month);
    }

    $this->log($year . $month, 'debug');
    // プロジェクトの作業期間が月報一覧の対象月になるかチェックする
    foreach ($projects as $project) {
      $periods = $this->ProjectPeriods->find('all')
        ->where(['project_id' => $project->id]);
      $onmonth = false;
      $project->onmonth = false;
      foreach ($periods as $period) {
        $startYear = $period->start->format('Y');
        $startMonth = $period->start->format('m');
        $startyyyymm = $startYear . $startMonth;
        $endYear = $period->end->format('Y');
        $endMonth = $period->end->format('m');
        $endyyyymm = $endYear . $endMonth;
        $this->log($startyyyymm . '〜' . $endyyyymm, 'debug');
        if($yyyymm >= $startyyyymm && $yyyymm <= $endyyyymm ) {
          $onmonth = true;
          $project->onmonth = true;
        }
      }
      $this->log($project->id . ' : ' . $project->onmonth, 'debug');
    }
*/


    $this->set(compact('year'));
    $this->set(compact('month'));
    $this->set(compact('month_str'));
    $this->set(compact('client_sel'));
    $this->set(compact('projects'));
    $this->set('_serialize', ['projects']);
    $this->set(compact('clients'));
    $this->set('_serialize', ['clients']);
  }


  /**
   * IndexMonth method
   *
   * 月別の月報一覧
   * @return \Cake\Network\Response|null
   */
  public function indexMonth($id = null)
  {
    $client_id = $id;
    $company_id = $this->Auth->user('company_id');

    $this->Session->write('Client.id', $id);

    $this->paginate = [
//     'fields' => [
  //     'id', 'user_id', 'Users.id', 'Users.name',
    //   'ProjectUsers.company_id', 'ProjectUsers.project_id'
    // ],
     'limit' => 10,
  //   'order' => ['id' => 'desc']
    ];

    $year = $this->Session->read('Project.year');
    $month = $this->Session->read('Project.month');
//    $month_str = mb_convert_kana($month, 'N');
    $start = strtotime(date($year . '/' . $month . '/01'));
    $end = strtotime(date($year . '/' . $month . '/01 00:00:00'). '+1 month');

    $start = date('Y-m-d', strtotime(date($year . '/' . $month . '/01')));
    $end = date('Y-m-d', strtotime(date($year . '/' . $month . '/01 00:00:00'). '+1 month'));

    $client = $this->Clients->get($client_id);

    // 管理者でログインした場合は社内全体のプロジェクトを参照する
    $projects = $this->Projects->find('all')
//    ->contain(['Clients', 'Reports'])
    ->contain([])
//        ->select(['Projects.id', 'Projects.num', 'Projects.project_name', 'Clients.name'])
      ->select(['pu.user_id', 'mr.id', 'cl.name'])
      ->where([
          'cl.id' => $client_id,
          'pu.user_id IS NOT' => null,
          'Projects.single' => false,
          'Projects.company_id' => $company_id,
//          'Reports.single' => 0,
//          'rp.work_date >= ' => $start,  //year . '/' . $month . '/' . '01',
  //        'rp.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
      ])
      ->join([
                'table' => 'clients',
                'alias' => 'cl',
                'type' => 'INNER',
                'conditions' => [
                    'cl.company_id = Projects.company_id',
                //    'ru.user_id = ProjectUsers.user_id',
              //      'ru.work_date >= ' . $start,
              //      'ru.work_date < ' . $end,
                ],
//                //'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
//              DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
//                  ],
      ])
      ->join([
                'table' => 'project_users',
                'alias' => 'pu',
                'type' => 'INNER',
                'conditions' => [
                    'pu.project_id = Projects.id',
                //    'ru.user_id = ProjectUsers.user_id',
              //      'ru.work_date >= ' . $start,
              //      'ru.work_date < ' . $end,
                ],
//                //'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
//              DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
//                  ],
      ])
//      ->join([
  //              'table' => 'reports',
    //            'alias' => 'rp',
      //          'type' => 'LEFT',
        //        'conditions' => [
          //        'rp.company_id = Projects.company_id',
            //      'rp.single' => 0,  //year . '/' . $month . '/' . '01',
              //    'rp.work_date >= ' => $start,  //$year . '/' . $month . '/' . '01',
                //  'rp.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
//          //    //    'rp.project_id = Projects.id',
//                ],
  //    ])
      ->join([
          'table' => 'monthly_reports',
          'alias' => 'mr',
          'type' => 'LEFT',
          'conditions' => [
            'mr.company_id = ' . $company_id,
            'mr.client_id = ' . $client_id,
            'mr.user_id = pu.user_id',
            'mr.year = ' . $this->Session->read('Project.year') . "",
            'mr.month = ' .$this->Session->read('Project.month') . "",
          ],
      ])
      ->group([
          'pu.user_id', 'mr.id', 'cl.name',
      ])
      ->order([
          'mr.id' => 'desc',
      ]);

//      if($client_sel != "" && $client_sel != "0" && $client_sel != "all" ) {
  //        $projects = $projects
    //      ->where([
      //        'Projects.client_id' => $client_sel,
        //  ]);
    //  }

  if($this->Auth->user('role') == "operator") {
      $projects = $projects
        ->where([
          'pu.user_id' => $this->Auth->user('id'),
//          'Reports.user_id' => $this->Auth->user('id'),
        ]);
  }

  $projects = $this->paginate($projects);

  foreach ($projects as $project) {
    $this->log('■', 'debug');
    $this->log($project, 'debug');
    $this->log($project->pu['user_id'], 'debug');
    // 作業員の名前
    $user = $this->Users->get($project->pu['user_id']);
    $project->pu['user_name'] = $user->name;
    // 日報の有無
    $report = $this->Reports->find('all')
      ->contain([])
      ->select([
        "id" => "Reports.id",
      ])
      ->where([
        'Reports.user_id' => $project->pu['user_id'],
        'Reports.single' => 0,  //year . '/' . $month . '/' . '01',
        'Reports.work_date >= ' => $start,  //$year . '/' . $month . '/' . '01',
        'Reports.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
      ])
      ->first();

    if($report) {
      $project->rep_exist = true;
    } else {
      $project->rep_exist = false;
    }


  }

/*
    if($this->Auth->user('role') == "president"):
      // 管理者でログインした場合は該当プロジェクトを担当する作業員を一覧
      $projectUsers = $this->paginate($this->ProjectUsers->find('all')
        ->contain(['Users', 'MonthlyReports', 'Reports'])
        ->join([
            'table' => 'monthly_reports',
            'alias' => 'mr',
            'type' => 'INNER',  //LEFT',
            'conditions' => [
              'mr.company_id = ' . $company_id,
              'mr.project_id = ' . $project_id,
              'mr.user_id = ProjectUsers.user_id',
              'mr.year = ' . $this->Session->read('Project.year') . "",
              'mr.month = ' .$this->Session->read('Project.month') . "",
            ],
        ])
//        ->join([
//            'table' => 'reports',
//            'alias' => 'rp',
//            'type' => 'LEFT',
//            'conditions' => [
//              'rp.company_id = ' . $company_id,
//              'rp.project_id = ' . $project_id,
//              'rp.user_id = ProjectUsers.user_id',
        //      'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
        //      DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
//            ],
//        ])
        ->select([
          "id" => "ProjectUsers.id",
          "company_id" => "ProjectUsers.company_id",
        ])
        ->where([
          'ProjectUsers.project_id' => $id
        ])
      );

    else:
      // 作業員でログインした場合は該当プロジェクトを担当する場合にのみ表示する
      $projectUsers = $this->ProjectUsers->find('all')
        ->contain(['Users', 'MonthlyReports', 'Reports'])
        ->join([
            'table' => 'monthly_reports',
            'alias' => 'mr',
            'type' => 'LEFT',
            'conditions' => [
              'mr.company_id = ' . $company_id,
              'mr.project_id = ' . $project_id,
              'mr.user_id = ProjectUsers.user_id',
              'mr.year = ' . $this->Session->read('Project.year') . "",
              'mr.month = ' .$this->Session->read('Project.month') . "",
            ],
        ])
        ->select([
          "id" => "ProjectUsers.id",
          "company_id" => "ProjectUsers.company_id",
        ])
        ->where([
          'ProjectUsers.project_id' => $id,
          'ProjectUsers.user_id' => $this->Auth->user('id'),
        ]);

if($this->Auth->user('role') == "operator") :
    $projectUsers = $projectUsers
      ->where([
        'ProjectUsers.user_id' => $this->Auth->user('id'),
    ]);
endif;

    $projectUsers = $this->paginate($projectUsers);


//      $projectUsers = $this->ProjectUsers->find('all')
  //      ->contain([])
    //    ->where([
      //    'project_id' => $id,
        //  'user_id' => $this->Auth->user('id')
    //    ]);

  //    $projectUsers = $this->paginate($projectUsers);

  //    $projectUsers = $this->paginate($this->ProjectUsers->find('all')
    //    ->contain(['Users'])
      //  ->where([
        //  'project_id' => $id,
          //'user_id' => $this->Auth->user('id')
    //    ])
    //  );
    endif;
*/


    // 年月の取得
    $this->set('year', $this->Session->read('Project.year'));
    $this->set('month', $this->Session->read('Project.month'));
    // プロジェクト情報の取得
      //$project_id = $this->Session->read('Project.id');
//      $project = $this->Projects->get($project_id, [
  //        'contain' => ['Clients']
    //  ]);

//      $this->Session->write('Project.id', $project_id);
  //      $users = $this->paginate($this->Users);

  $this->set(compact('client'));
  $this->set('_serialize', ['client']);
      $this->set(compact('projectUsers'));
      $this->set('_serialize', ['projectUsers']);
      $this->set(compact('projects'));
      $this->set('_serialize', ['projects']);
    }

  /**
   * IndexSingle method
   * 単発案件一覧
   * @return \Cake\Network\Response|null
   */
  public function indexSingle($id = null)
  {
    $this->paginate = [
      'fields' => ['id','company_id','project_id','user_id','work_date',
                   'start_time','end_time','salaried','holiday_work','allowance','note','remaining'],
      'limit' => 5,
      'order' => ['id' => 'desc']
    ];


//    $project_id = $this->Session->read('Projct.id');
    $company_id = $this->Auth->user('company_id');

    if($id==null):
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(null == $this->request->data('year_yy')) {
              date_default_timezone_set('Asia/Seoul');
                $dt = date('Y-m-d');
                $year_yy = date('Y');
                $month_mm = date('m');
                $day_dd = date('d');
            } else {
              $year_yy = $this->request->data('year_yy');
              $month_mm =    $this->request->data('month_mm');
              $day_dd =   $this->request->data('day_dd');
              $dt = $year_yy . '-' . $month_mm . '-' . $day_dd;
            }
        } else{
          date_default_timezone_set('Asia/Seoul');
            $dt = date('Y-m-d');
            $this->log('■', 'debug');
            $this->log($dt, 'debug');

//            $dt = date('2016-9-3');
            $year_yy = date('Y');
            $month_mm = date('m');
            $day_dd = date('d');
//            $day_dd = 3;

        }
    else:
        $report = $this->Reports->get($id);
        $dt = $report->work_date;
        $year_yy = $dt->format('Y');
        $month_mm = $dt->format('m');
        $day_dd = $dt->format('d');
    endif;

    $reports = $this->Reports->find('all')
      ->select(['Reports.id','Users.id','Users.name','Users.image'])
      ->contain(['Users'])
      ->where([
        'Reports.company_id' => $company_id,
//          'Reports.project_id' => $project_id,
        'Reports.work_date' => $dt,
        'Reports.single' => 1,
      ]);

    if($this->Auth->user('role') == "operator") {
      $reports = $reports
        ->where([
          'Reports.user_id' => $this->Auth->user('id'),
        ]);
    }

    $reports = $this->paginate($reports);

//    $project = $this->Projects->get($project_id);
//    if($project){
//        $this->Flash->errror('プロジェクト情報が登録され');
//    }
//    $this->Session->write('Project.id', $project_id);

    $this->Session->write('Url.from', 'indexSingle');

    $Url = ['from' => 'index-single'];
    $this->set(compact('Url'));

    $this->set(compact(['year_yy', 'month_mm', 'day_dd']));

    $this->set('role',$this->Auth->user('role'));
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);

//    $this->render('index');

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
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($this->request->is(['get'])) {
            $year_yy = $this->Session->read('Url.year_yy');
            $month_mm = $this->Session->read('Url.month_mm');
            $day_dd = $this->Session->read('Url.day_dd');
        }
        if ($this->request->is(['post'])) {
            $this->Session->write('Url.year_yy', $this->request->data('year_yy'));
            $this->Session->write('Url.month_mm', $this->request->data('month_mm'));
            $this->Session->write('Url.day_dd', $this->request->data('day_dd'));
                    $year_yy = $this->Session->read('Url.year_yy');
                    $month_mm = $this->Session->read('Url.month_mm');
                    $day_dd = $this->Session->read('Url.day_dd');
        }


        $company_id  = $this->Auth->user('company_id');

        $report = $this->Reports->get($id, [
            'contain' => []
        ]);
        $this->log('■', 'debug');
        $this->log($id, 'debug');
        $this->log($report, 'debug');

        $user_id  = $report->user_id;
        $user = $this->Users->get($user_id);

        $reportMaterials = $this->ReportMaterials->find('all', [
            'contain' => ['Materials']
          ])
          ->where(['report_id' => $id]);
        // ************************************************** //
        // 前の日、次の日の表示制御用
        $reports = $this->Reports->find('all', [
            'contain' => []
          ])
          ->where([
            'company_id' => $report->company_id,
           'user_id' => $report->user_id,
          'single' => $report->single,
        //    'work_date' => $report->work_date,
          ])
          ->order([
            'id' => 'asc',
          ]);

//      if($this->Auth->user('role') =='president') :
 //         $reports = $reports
 //           ->where([
 //               'project_id' => $report->project_id,
 //           ]);
 //     endif;

          if(!$report->single):
              $project = $this->Projects->get($report->project_id, [
                'contain' => ['Categories', 'Clients']
              ]);
              $reports = $reports
                ->where([
                    'project_id' => $report->project_id,
                ]);
          endif;

   //     if($this->Auth->user('role') =='operator') :
   //         $reports = $reports
   //         ->where([
   //           'user_id' => $report->user_id,
   //       ]);
   //     endif;

        $pos = 0;
        $exists = false;
        foreach ($reports as $report_cmp) {
    //        if($exists) {
    //            $pos++;
    //            break;
    //        }
          if($id == $report_cmp->id) {
              $exists = true;
              break;
          } else {
            $pos++;
          }
        }
        $this->log('■', 'debug');
        $this->log($pos, 'debug');

        $on_left = true;
        $on_right = true;
        if ($pos == 0 ) {
          $on_left = false;
        }
        if($reports->count() <= 1) {
            $on_left = false;
            $on_right = false;
        }
        if (($pos + 1)== $reports->count()) {
          $on_right = false;
        }
      // ************************************************** //


        $company = $this->Companies->get($company_id);

        $report->work_date_str = $report->work_date->format('Y/m/d');
        $report->work_date_str = $report->work_date_str . '(' . AppUtility::weekjp($report->work_date->format('w')) . ')';

//        $this->Session->write('Url.year_yy', $this->request->data('year_yy'));
//        $this->Session->write('Url.month_mm', $this->request->data('month_mm'));
//        $this->Session->write('Url.day_dd', $this->request->data('day_dd'));

//        $this->set('year_yy', $this->request->data('year_yy'));
//        $this->set('month_mm', $this->request->data('month_mm'));
//        $this->set('day_dd', $this->request->data('day_dd'));
        $this->set(compact('year_yy'));
        $this->set(compact('month_mm'));
        $this->set(compact('day_dd'));

        $this->set(compact('report'));
        $this->set('_serialize', ['report']);
        $this->set(compact('reportMaterials'));
        $this->set('_serialize', ['reportMaterials']);
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $this->set(compact(['on_left', 'on_right']));
    }

  /**
   * view-next method
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|null
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function viewNext($id = null)
  {
    $report_id = $id;
    $report = $this->Reports->get($id);
    $company_id = $report->company_id;
    $user_id = $report->user_id;
    // 日誌情報から次日の日報を探す
    // 次の日付の日誌を検索 ： 必ずしも明日の日誌では無い !!
    $reports_next = $this->Reports->find('all')
              ->select(['id'])
              ->where([
                'company_id' => $company_id,
              'user_id' => $report->user_id,
//               'work_date = ' => $report->work_date,
//                'id !=' => $id,
                'single' => $report->single,
              ])
              ->order([
//                  'work_date' => 'asc',
                  'id' => 'asc',
              ]);
//            ->first();


          if(!$report->single):
         //     $project = $this->Projects->get($report->project_id, [
           //     'contain' => ['Categories', 'Clients']
             // ]);
              $reports_next = $reports_next
                ->where([
                    'project_id' => $report->project_id,
                ]);
          endif;

 //   if($this->Auth->user('role') =='president') :
//        $reports_next = $reports_next
  //      ->where([
  //          'project_id' => $report->project_id,
  //        ]);
  //  endif;

//    if($this->Auth->user('role') =='operator') :
//        $reports_next = $reports_next
//        ->where([
///              'user_id' => $report->user_id,
    //      ]);
//    endif;
$this->log('○', 'debug');
$this->log(count($reports_next), 'debug');
    $exists = false;
    foreach ($reports_next as $next) {
        $this->log('○', 'debug');
        if($exists) {
            $report_id = $next->id;
            $this->log('■', 'debug');
            $this->log($report_id, 'debug');
            break;
        }
        if($next->id == $report->id) {
            $exists = true;
            $this->log($next->id, 'debug');
        }
    }
//    if($report_next) {
//      $report_id = $report_next->id;
//    }
$this->log('○', 'debug');
$this->log($report_id, 'debug');

    return $this->redirect(['action' => 'view/' . $report_id]);
  }


    /**
     * view-pre method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewPre($id = null)
    {
      $report_id = $id;
      $report = $this->Reports->get($report_id);
      $company_id = $report->company_id;
      $user_id = $report->user_id;

      // 日誌情報から次日の日報を探す ： 無かったら同じ日誌を再表示
      // 次の日付の日誌を検索 ： 必ずしも明日の日誌では無い !!
      $reports_pre = $this->Reports->find('all')
                ->select(['id'])
                ->where([
                    'company_id' => $company_id,
	             'user_id' => $report->user_id,
     //               'user_id' => $user_id,
 //                   'work_date = ' => $report->work_date,
                    //'id !=' => $id,
                    'single' => $report->single,
                ])
                ->order([
//                    'work_date' => 'asc',
                    'id' => 'desc',
                ]);

          if(!$report->single):
   //           $project = $this->Projects->get($report->project_id, [
     //           'contain' => ['Categories', 'Clients']
       //       ]);
              $reports_pre = $reports_pre
                ->where([
                    'project_id' => $report->project_id,
                ]);
          endif;

 //       if($this->Auth->user('role') =='president') :
 //           $reports_pre = $reports_pre
 //           ->where([
 //               'project_id' => $report->project_id,
 //             ]);
 //       endif;

    //    if($this->Auth->user('role') =='operator') :
    //        $reports_next = $reports_next
    //        ->where([
    ///              'user_id' => $report->user_id,
        //      ]);
    //    endif;

      $exists = false;
      foreach ($reports_pre as $pre) {
          if($exists) {
              $report_id = $pre->id;
              break;
          }
          if($pre->id == $report->id) {
              $exists = true;
          }
      }
//      if($this->Auth->user('role') =='operator') :
//          $reports_pre = $reports_pre
//          ->where([
//             'user_id' => $report->user_id,
//            ]);
//     endif;

//      if($report_pre) {
//        $report_id = $report_pre->id;
//      }

      return $this->redirect(['action' => 'view/' . $report_id]);
    }

  /**
   * ViewMonth method
   *
   * 月次報告書の表示
   * @param string|null $id User id.
   * @return \Cake\Network\Response|null
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function viewMonth($id = null)
  {
    $company_id  = $this->Auth->user('company_id');

    $company_id = $this->Auth->user('company_id');
    $project_id = $this->Session->read('Project.id');
    $year = $this->Session->read('Project.year');
    $month = $this->Session->read('Project.month');
    //$client_id = $id;

    $monthlyReport = $this->MonthlyReports->get($id);

/*
    $monthlyReport = $this->MonthlyReports->find('all', [
      'contain' => ['Users']
    ])
      ->where([
        'MonthlyReports.company_id' => $this->Auth->user('company_id'),
        'project_id' => $this->Session->read('Project.id'),
        'MonthlyReports.user_id' => $user_id,
        'year' => $year,
        'month' => $month
      ])
      ->first();
*/

//$yy = $year;
//$mm = $month;
//$dd = $entity['day_dd'];
//$dt = $yy . "/" . $mm . "/" . $dd;
//if(($mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
  //  $entity['bonus_date'] = new \DateTime($dt);
//} else {
  //  $entity->bonus_date = null;
//}
//    if($monthlyReport == null) {
//      $monthlyReport = $this->MonthlyReports->newEntity();
//    } else {
      // ボーナス日
      $monthlyReport->bonus_date_jp = DatetimeUtility::date('Jk', strtotime($year .'/'. $month .'/'. '01 10:20:30'));
//    }

    $month_first = new Time($year.'-'.$month.'-1 0:0:0');
    $month_last = new Time($year.'-'.$month.'-1 0:0:0');
    $month_last->addMonth(1);
/*
    $reports = $this->Reports->find('all')
      ->contain(['Projects'])
      ->where([
        'Reports.company_id' => $company_id,
//        'project_id' => $this->Session->read('Project.id'),
        'Projects.client_id' => $monthlyReport->client_id,
        'Reports.user_id' => $monthlyReport->user_id,
        'Reports.work_date >= ' => $month_first,
        'Reports.work_date < ' => $month_last
      ])
      ->order(['work_date' => 'asc']);
*/

      $reports = $this->Reports->find('all')
  //    ->contain(['Clients', 'Reports'])
  //    ->contain(['Reports'])
  //        ->select(['Projects.id', 'Projects.num', 'Projects.project_name', 'Clients.name'])
        ->select([
          'Reports.work_date',
          'Reports.start_time',
          'Reports.end_time',
          'Reports.salaried',
          'Reports.holiday_work',
          'Reports.other_work',
          'Reports.allowance',
          'Reports.note',
          'Reports.remaining',
          'pr.num',
          'pr.project_name',
          'pr.secondary',
          'pr.category_id',
          'cl.name'
        ])
        ->where([
          'Reports.company_id' => $company_id,
          'Reports.user_id' => $monthlyReport->user_id,
          'Reports.work_date >= ' => $month_first,
          'Reports.work_date < ' => $month_last,
          'Reports.single' => 0,
          'pr.client_id' => $monthlyReport->client_id,
        ])
        ->join([
              'table' => 'projects',
              'alias' => 'pr',
              'type' => 'INNER',
              'conditions' => [
                      'pr.company_id = Reports.company_id',
                      'pr.id = Reports.project_id',
                  ],
                  'where' => [
                    'pr.client_id' => $monthlyReport->client_id,
                    'pr.completion_check = false',
                    'pr.single = false',
                  ],

  //                //'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
  //              DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
        //          ],
        ])
        ->join([
                  'table' => 'clients',
                  'alias' => 'cl',
                  'type' => 'INNER',
                  'conditions' => [
                      'cl.id = pr.client_id',
                //      'ru.work_date >= ' . $start,
                //      'ru.work_date < ' . $end,
                  ],
  //        //        //'rp.work_date->format('Y') = ' . $this->Session->read('Project.year') . "",
  //      //        DATE_FORMAT(rp.work_date, '%Y') = ' .$this->Session->read('Project.month') . "",
  //    //              ],
        ])
        ->order(['work_date' => 'asc']);
    //    ->join([
  //                'table' => 'reports',
//                  'alias' => 'rp',
                  //'type' => 'LEFT',
                //  'conditions' => [
              //      'rp.company_id = Projects.company_id',
            //        'rp.single' => 0,  //year . '/' . $month . '/' . '01',
          //          'rp.work_date >= ' => $start,  //$year . '/' . $month . '/' . '01',
        //            'rp.work_date < ' => $end,  //year . '/' . $month . '/' . '01',
  //  //        //        'rp.project_id = Projects.id',
    //              ],
  //      ])
//        ->join([
          //  'table' => 'monthly_reports',
        //    'alias' => 'mr',
      //      'type' => 'LEFT',
    //        'conditions' => [
  //            'mr.company_id = ' . $company_id,
//              'mr.client_id = ' . $client_id,
              //'mr.user_id = pu.user_id',
            //  'mr.year = ' . $this->Session->read('Project.year') . "",
          //    'mr.month = ' .$this->Session->read('Project.month') . "",
        //    ],
      //  ])
    //    ->group([
  //          'pu.user_id', 'mr.id', 'cl.name',
//        ]);



      // 合計日数
      $total = 0;
      // 通常出勤日
      $normal = 0;
      // 有給休暇
      $salaried = 0;
      // 休日出勤
      $holiday_work = 0;
      foreach ($reports as $report) {
        $total++;
        if($report->salaried){
          $salaried++;
        }
        if($report->holiday_work){
          $holiday_work++;
        }
        else{
          $normal++;
        }
      }
    $this->set(compact(['total','normal','salaried','holiday_work']));

    if($reports->count() == 0) {
        $this->Flash->error('日報が１日も登録されていません');
    }

    $user = $this->Users->get($monthlyReport->user_id, [
      'contain' => []
    ]);

    $company = $this->Companies->get($company_id);
    if($company->overtime_exist == 1) {
      $company['overtime'] = $company->overtime_time->format('G時i分以降').'　'.$company->overtime_pay.'円/時間';
    }

    // プロジェクト情報
    $project_id = $this->Session->read('Project.id');
//    $project = $this->Projects->get($project_id, [
//        'contain' => ['Categories', 'Clients']
//    ]);
$categories_name = [];
$secondaries_name = [];
    foreach($reports as $report) {
      $report['diffTime'] = AppUtility::diffTime($report->start_time, $report->end_time, $company->rest_minutes);
      $report->shiftTime = AppUtility::shiftTime($report->start_time, $company->shift_time, $company->shift_exist);
      $report->overTime = AppUtility::overTime($report->end_time, $company->overtime_time, $company->overtime_exist);

      // 受注元工事店名
      $catid = $report->pr['category_id'];
      if($catid > 0) {
        $category = $this->Categories->get($catid);
        $catname = $category->name;

        $this->log($catname, 'debug');

        $categories_name += [$catname => $catname];
      }
      $secondaries_name += [$report->pr['secondary'] => $report->pr['secondary']];
      $this->log($report->pr['secondary'], 'debug');
    }
    $this->log('★', 'debug');
    $this->log($categories_name, 'debug');
    $this->log('★', 'debug');
    $this->log($secondaries_name, 'debug');

    $category_names = '';
    foreach ($categories_name as $key => $val) {
      $this->log($val, 'debug');
      $category_names .= $val;
    }
    $secondary_names = '';
    foreach ($secondaries_name as $key => $val) {
      $secondary_names .= $val;
    }
    $this->log('★', 'debug');
    $this->log($category_names, 'debug');
    $this->log('★', 'debug');
    $this->log($secondary_names, 'debug');
    // 受注元工事店名
    $client_id = $monthlyReport->client_id;
    $client = $this->Clients->get($client_id);
    $client_name = $client->name;
    $this->log('★', 'debug');
    $this->log($client_name, 'debug');

    foreach ($reports as $report) {
//      $cname = $report->project->client_id;
//      $secondary  = $report->project->secondary;
//      $ctname = $report->project->category_id;
    }

    $this->set(compact('monthlyReport'));
    $this->set('_serialize', ['monthlyReport']);
    $this->set(compact('reports'));
    $this->set('_serialize', ['reports']);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
    $this->set(compact('company'));
    $this->set('_serialize', ['company']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('client_name'));
    $this->set(compact('category_names'));
    $this->set(compact('secondary_names'));
  }


  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
      if($this->Auth->user('role') == 'president') {
          $this->Flash->error('作業員権限の日報を管理者は作成できません');
          return $this->redirect(['action' => 'index']);
      }

        $method = "GET";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $method = "PUT";
        }
        $this->log("ReportController add( " . $method . " )", 'debug');

        $this->set('from', 'add');
        $this->edit("add");
        $this->render('edit');

      /*
      $user = $this->Users->newEntity();
      $company = $this->Companies->get($this->Auth->user('company_id'));
      $project = $this->Projects->get($this->Session->read('Project.id'));
      $report = $this->Reports->newEntity();

      if ($this->request->is('post')) {

          if(isset($this->request->data['year_yy'])) {

            // Date
            $data = $this->request->data();
            $yy = $data['year_yy'];
            $mm = $data['month_mm'];
            $dd = $data['day_dd'];
            $sdt = $yy . "/" . $mm . "/" . $dd;
            if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
              $dt = new \DateTime($sdt);
              $w = $dt->format('w');
              AppUtility::weekjp($w);
              $sdt = $dt->format('Y/m/d');
              $report['work_date_string'] = $sdt . '(' . AppUtility::weekjp($w) .')';
              $report['work_date'] = $sdt;
            } else {
              $report['work_date_string'] = '';
              $report['work_date'] = NULL;
            }
        //    $report['project_name'] = $project['name'];
        //    $report['project_num'] = $project['num'];
          //  $report['client'] = $project['name'];
            $repoprt['company_id'] = $this->Auth->user('company_id');
            $repoprt['project_id'] = $this->Session->read('Project.id');
            $report['user_id'] = $this->Auth->user('id');
            $report['user_name'] = $this->Auth->user('name');
            $this->log($report, 'debug');
          } else {


//        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            $repoprt['company_id'] = $this->Auth->user('company_id');
            $repoprt['project_id'] = $this->Session->read('Project.id');
            $report['user_id'] = $this->Auth->user('id');
            $this->log($report, 'debug');
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
          }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        $this->set(compact('company'));
        $this->set('_serialize', ['company']);

        $this->set(compact('project'));
        $this->set('_serialize', ['project']);

        $this->set(compact('report'));
        $this->set('_serialize', ['report']);

        $this->set('mode', 'add');

        $this->render('edit');

        */
    }

  /**
   * Index method
   * 単発案件日誌の新規作成
   * @return \Cake\Network\Response|null
   */
  public function addSingle()
  {
      if($this->Auth->user('role') == 'president') {
          $this->Flash->error('作業員権限の日報を管理者は作成できません');
          return $this->redirect(['action' => 'index-single']);
      }

//    $this->Session->write('Report.id', $id);
    $this->set('from', 'addSingle');
    $this->edit("addSingle");
    $this->render('edit');
  }

  /**
   * Index method
   * 単発案件日誌の新規作成
   * @return \Cake\Network\Response|null
   */
  public function editSingle($id = null)
  {
    // ReportMaterials.delete から Redirect するために設定
    $this->Session->write('Report.id', $id);
    $this->set('from', 'editSingle');
    $this->edit("editSingle");
    $this->render('edit');
  }
  /**
   * Edit method
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = NULL)
  {
    // 共通画面での表示切替用
    if ($id==="add") {
//      $this->set('mode', 'add');
      $this->set('from', 'add');
      $this->set('next', 'add');
    } elseif ($id==="addSingle") {
  //    $this->set('mode', 'add');
      $this->set('from', 'addSingle');
      $this->set('next', 'edit/' . $id);
    } elseif ($id==="editSingle") {
      $this->set('from', 'editSingle');
      $report_id = $this->Session->read('Report.id');
      $this->set('next', 'editSingle/' . $this->Session->read('Report.id'));
    } else {
    //  $this->set('mode', 'edit');
      $this->set('from', 'edit');
      $this->set('next', 'edit/' . $id);
      $report_id = $id;
      $this->Session->write('Url.next', '/reports/edit/' . $id);
    }


//    $this->log('★', 'debug');
//    $this->log($id, 'debug');
//    $this->log($this->request->is('post'), 'debug');
//    $this->log($this->request->data['year_yy'], 'debug');
//    $this->log($this->request->data(), 'debug');

    // 共通の情報取得
    $company = $this->Companies->get($this->Auth->user('company_id'));

    if ($id != 'addSingle' && $id != 'editSingle') {
        $project = $this->Projects->get($this->Session->read('Project.id'), [
            'contain' => ['Categories', 'Clients']
        ]);
    }

//            ->where(['project_id' => $this->Session->read('Project.id')]);

    $user = $this->Users->get($this->Auth->user('id'));
    $user['user_name'] = $this->Auth->user('name');
    $materials = $this->Materials->find('all')
      ->where(['company_id' => $this->Auth->user('company_id')]);

    if (($id === "add" || $id === "addSingle") && $this->request->is('post') && isset($this->request->data['year_yy'])):
        // **************************************************************//
        // ADD 初回時 : 日報の初期日付を取得するためにPOSTで送られてくる
        // **************************************************************//
        $this->log('★', 'debug');
        $this->log('★', 'debug');
        $this->log('★', 'debug');


        $report = $this->Reports->newEntity();
        $user = $this->Users->newEntity();
        $user->id = $this->Auth->user('id');
        $user->name = $this->Auth->user('name');
        $report->user = $user;

      $reportMaterials = $this->ReportMaterials->newEntity();
      $data = $this->request->data();
      $yy = $data['year_yy'];
      $mm = $data['month_mm'];
      $dd = $data['day_dd'];

      $this->Session->write('Url.year', $data['year_yy']);
      $this->Session->write('Url.month', $data['month_mm']);
      $this->Session->write('Url.day', $data['day_dd']);
//      $this->set('year_yy', $data['year_yy']);
  //    $this->set('month_mm', $data['month_mm']);
    //  $this->set('day_dd', $data['day_dd']);

      $sdt = $yy . "/" . $mm . "/" . $dd;
      if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
        $dt = new \DateTime($sdt);
        $w = $dt->format('w');
        AppUtility::weekjp($w);
        $sdt = $dt->format('Y/m/d');
        $report['work_date_string'] = $sdt . '(' . AppUtility::weekjp($w) .')';
        $report['work_date'] = $sdt;
      } else {
        $report['work_date_string'] = 'aaa';
        $report['work_date'] = NULL;
      }
      // 入場時間
      if($company->start_time) {
        $report->start_time = $company->start_time;
      } else {
        $report->start_time = null;
      }
      // 退場時間
      if($company->end_time) {
        $report->end_time = $company->end_time;
      } else {
        $report->end_time = null;
      }

      $this->log($report, 'debug');

  //  elseif (($id === "editSingle") && $this->request->is('get')):
            // EDIT 初回時 : 日報の初期日付を取得するためにPOSTで送られてくる
    //        $report = $this->Reports->get($this->Session->read('Report.id') , [
      //        'contain' => 'ReportMaterials'
        //    ]);

//            $reportMaterials = $this->ReportMaterials->newEntity();
    //        $data = $this->request->data();
      //      $yy = $data['year_yy'];
        //    $mm = $data['month_mm'];
          //  $dd = $data['day_dd'];
            //$sdt = $yy . "/" . $mm . "/" . $dd;
          //  if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
      //        $dt = $report->work_date;  //new \DateTime($sdt);
        //      $w = $dt->format('w');
          //    AppUtility::weekjp($w);
          //    $sdt = $dt->format('Y/m/d');
            //  $report['work_date_string'] = $sdt . '(' . AppUtility::weekjp($w) .')';
//              $report['work_date'] = $sdt;
      //      } else {
    //          $report['work_date_string'] = 'aaa';
  //            $report['work_date'] = NULL;
        //    }
            // 入場時間
      //      if($company->start_time) {
        //      $report->start_time = $company->start_time;
          //  } else {
            //  $report->start_time = null;
        //    }
            // 退場時間
          //  if($company->end_time) {
            //  $report->end_time = $company->end_time;
          //  } else {
            //  $report->end_time = null;
          //  }


    elseif ($id != "add" && $id != "addSingle" &&
           ($this->request->is(['get']) ||
            null != $this->request->data('urlfrom') && null == $this->request->data('minute2'))):
        // **************************************************************//
      // EDIT 初回
//      $report = $this->Reports->get($id);

      if ($id === "editSingle"){
        // ADD 初回時 : 日報の初期日付を取得するためにPOSTで送られてくる
        $report = $this->Reports->get($this->Session->read('Report.id') , [
          'contain' => ['ReportMaterials', 'Users']
        ]);
      } else {

        $report = $this->Reports->get($id , [
          'contain' => ['ReportMaterials', 'Users']
        ]);
        // ReportMaterials.delete から Redirect するために設定
        $this->Session->write('Report.id', $id);
      }

      // 作業年月日のFormat
      if($report->work_date == NULL) {
        $report['work_date_string'] = '???';
      } else {
        $w = $report->work_date->format('w');
        $sdt = $report->work_date->format('Y/m/d');
        $report['work_date_string'] = $sdt . '(' . AppUtility::weekjp($w) .')';
      }
  //    $reportMaterials = $this->ReportMaterials->find('all')
      //    ->where(['report_id' => $id]);

    elseif($this->request->is('post')):
        // **************************************************************//
      // ADD or EDIT ２回目以降
      //        if ($this->request->is('post')) {
      if ($id === "add"){
        // ADD
        $report = $this->Reports->newEntity();
      } elseif ($id === "addSingle"){
        // ADD
        $report = $this->Reports->newEntity();
        // 単発
        $report->single = true;
        // Date
      } elseif ($id === "addxxxx" || $id === "editSingle"){
  //    } else {
        // ADD 初回時 : 日報の初期日付を取得するためにPOSTで送られてくる
        $report = $this->Reports->get($this->Session->read('Report.id') , [
          'contain' => 'ReportMaterials'
        ]);
          // ADD
//          $report = $this->Reports->newEntity();
          // 単発
  //        $report->single = true;
          // Date
      } else {
        // EDIT
        $report = $this->Reports->get($id, [
          'contain' => 'ReportMaterials'
        ]);
      }
      $report_p = $this->Reports->patchEntity($report, $this->request->data, [
        'validate' => 'update'
      ]);
      if($report_p->errors ()) {
        // Validation Error時
        $this->set("errors", $report_p->errors ());
      }

      // Validate で消えた値の復活用
      $report_p = $this->Reports->patchEntity($report, $this->request->data, [
        'validate' => false
      ]);

      $company_id = $this->Auth->user('company_id');
      $report_p['company_id'] = $company_id;
      $report_p['project_id'] = $this->Session->read('Project.id');
      if ($id === "add" || $id == "addSingle"){
        $report_p['user_id'] = $this->Auth->user('id');
      }
      // 入場時間
      $hour = $report_p['time'];
      $min = $report_p['minute'];
      $tm = $hour. ":" . $min ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $report_p['start_time'] = new \Datetime($tm);
      } else {
        $report_p['start_time'] = null;
      }
      // 退場時間
      $hour = $report_p['time2'];
      $min = $report_p['minute2'];
      $tm = $hour. ":" . $min ;
      $this->log($tm, 'debug');
      if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
        $report_p['end_time'] = new \Datetime($tm);
      } else {
        $report_p['end_time'] = null;
      }
      // 作業日
      if($report->work_date != NULL) {
        $dt = new \DateTime($report_p->work_date);
        $sdt = $dt->format('Y/m/d');
        $report_p['work_date'] = $sdt;
      }
      // 有給休暇
      if(isset($this->request->data['salaried'])) {
        $report->salaried = true;
      } else {
        $report->salaried = false;
      }
      // 休日出勤
      if(isset($this->request->data['holiday_work'])) {
        $report->holiday_work = true;
      } else {
        $report->holiday_work = false;
      }
      // 他の仕事あり
      if(isset($this->request->data['other_work'])) {
        $report->other_work = true;
      } else {
        $report->other_work = false;
      }

      // メモ
      $report_p->memo = $report->memo;
      // 完了チェック

if(isset($this->request->data['completion_check'])) {
    $report_p->completion_check = true;
} else {
  $report_p->completion_check = false;
}

   //   $check = false;
   //   if($report->completion_check=="completion_check") {
   //     $check = true;
   //   }
    //  $report_p->completion_check = $check;
      // Validation:report-data
      if($report_p->errors ()):
        // Validate Error 時
        $this->set("errors", $report_p->errors ());
      else:
        // Transaction 開始
        $connection = ConnectionManager::get('default');
        $connection->begin();
        try {
          // ■ 日誌の保存 ： report->id を設定するので先に保存する　
          $this->log($report_p, 'debug');
          $report_up = $this->Reports->save($report_p);
          if ($report_up) {
            $this->Flash->success(__('日報を保存しました'));
      //      return $this->redirect(['action' => 'index']);
          } else {
            throw new Exception("日報の保存に失敗しました");
            $this->Flash->error(__('日報の保存に失敗しました'));
          }

          $grps = $this->request->data['group-a'];
          $pos = 0;
          foreach ($grps as $grp) {
              $this->log('■', 'debug');
              $this->log($grp, 'debug');
//              $this->log($grp['quantity'], 'debug');
//              $grps[$pos]['quantity'] = intval(mb_convert_kana($grp['quantity'], 'kvrn'));
//              $this->log('■', 'debug');
//              $this->log($grp, 'debug');
//              $this->log($grp['quantity'], 'debug');
              $pos++;
          }

          $this->log('★', 'debug');
          $this->log($grps, 'debug');

          // 使用部材
          $reportMaterials = $this->ReportMaterials->newEntity();
//          $reportMaterials = $this->ReportMaterials->patchEntities($reportMaterials, $this->request->data['group-a'], [
              $reportMaterials = $this->ReportMaterials->patchEntities($reportMaterials, $grps, [
                    'validate' => 'default'
              ]);
        //  $reportMaterials = $this->ReportMaterials->patchEntities($reportMaterials, $this->request->data['group-a'], [
        //          'validate' => false
        // ]);
        foreach ($reportMaterials as $reportMaterial) {
        if($reportMaterial->errors ()) {
          // Validate Error 時
          $this->set("errors", $reportMaterial->errors ());
        }
        }

          $this->log($reportMaterials, 'debug');
//      $reportMaterials = $this->request->material;
  //    $reportQuantities = $this->request->quantity;
    //  $reportIds = $this->request->material_id;
          foreach($reportMaterials as $reportMaterial):
            if($reportMaterial->material_id == 0) {
              // 使用部材が選択されていないので、保存しない
              continue;
            }
            $reportMaterial->quantity = $reportMaterial->quantity;
            $this->log($reportMaterial, 'debug');
            $this->log('■', 'debug');
            $exist = $this->ReportMaterials->exists([
              'id'=>$reportMaterial->reportmaterials_id,'material_id'=>$reportMaterial->material_id,'quantity'=>$reportMaterial->quantity
            ]);
            $this->log($reportMaterial, 'debug');
            $this->log('exist=' . $exist, 'debug');

            if(!$exist && ($reportMaterial->reportmaterials_id != null && $reportMaterial->reportmaterials_id != 0)) {
              // UPDATE
              $this->log('UPDATE material', 'debug');
              $entity = $this->ReportMaterials->get($reportMaterial->reportmaterials_id);
              $entity->id = $reportMaterial->reportmaterials_id;
              $entity->material_id = $reportMaterial->material_id;
          //    $entity->material_name = $repmat->material;
              $entity->quantity = $reportMaterial->quantity;
              $entity->company_id = $company_id;
          // reports->id 設定
              $entity->report_id = $report_up->id;
              $result = $this->ReportMaterials->save($entity);
              if ($result) {
                $this->Flash->success(__('日報の使用部材情報を保存しました'));
              } else {
                throw new Exception("日報の使用部材情報の保存に失敗しました");
//                $this->Flash->error(__('The material could not be saved. Please, try again.'));
              }
            }
            if(!$exist && ($reportMaterial->reportmaterials_id == null || $reportMaterial->reportmaterials_id == 0)) {
              // INSERT
              $this->log('INSERT material', 'debug');
//          if($reportMaterial->material_name != null && $reportMaterial->material_name != "") {
            //$entity->material_id = $reportMaterials->material_id;
              $entity = $this->ReportMaterials->newEntity();
          //    $entity->id = $reportMaterial->reportmaterials_id;
              $entity->material_id = $reportMaterial->material_id;
//            $entity->material_name = $reportMaterial->material;

$this->log('▼', 'debug');
$this->log($reportMaterial->quantity, 'debug');

              $entity->quantity = $reportMaterial->quantity;
              $entity->company_id = $company_id;
            // reports->id 設定
              $entity->report_id = $report_up->id;
              $result = $this->ReportMaterials->save($entity);
              if ($result) {
                $this->Flash->success(__('日報の使用部材情報を追加しました'));
              } else {
                throw new Exception("日報の使用部材情報の追加に失敗しました");
//                $this->Flash->error(__('The material could not be saved. Please, try again.'));
              }
            }
//            elseif($reportMaterial->reportmaterials_id > 0) {
  //            // DELETE
    //          $this->log('DELETE material', 'debug');
//    //          $entity = $this->ReportMaterials->newEntity();
        //      $rm_id = $reportMaterial->reportmaterials_id;
//        //      $entity->material_id = $reportMaterial->material_id;
  //        /    $entity->quantity = $reportMaterial->quantity;
    //          $entity->company_id = $company_id;
      //      // reports->id 設定
        //      $entity->report_id = $report_up->id;
            //  $result = $this->ReportMaterials->delete($rm_id);
          //  }
          endforeach;
          $this->log('commit', 'debug');
          $connection->commit();
          // 保存後
          if ($id == "addSingle" || $id == "editSingle" ) {
            return $this->redirect(['action' => 'indexSingle']);
          } else {
            return $this->redirect(['action' => 'index']);
          }

        } catch(Exception $e) {
          $this->Flash->error($e->getMessage());
          // errors情報として設定する
          $errors = [
            'save' => [
                '_empty' => '日報の保存に失敗しました'
            ]
          ];
          $this->log('rollback', 'debug');
          $this->set(compact('errors'));
          $connection->rollback();
        }

      endif;
    endif;

//$this->log($report, 'debug');

    $this->set('role', $this->Auth->user['role']);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
    $this->set(compact('company'));
    $this->set('_serialize', ['company']);
    $this->set(compact('project'));
    $this->set('_serialize', ['project']);
    $this->set(compact('report'));
    $this->set('_serialize', ['report']);
    $this->set(compact('materials'));
    $this->set('_serialize', ['materials']);

    $this->set(compact('reportMaterials'));
    $this->set('_serialize', ['reportMaterials']);

  //  $this->render('edit');
  }


  /**
   * Edit method
   *
   * @param string|null $id User id.
   * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function addMonth($id = null)
  {
      $this->Session->write('User.id', $id);
      $this->editMonth("addMonth");
      $this->render('editMonth');

//    $user_id = $id;

  //  $company_id = $this->Auth->user('company_id');
//      $project_id = $this->Session->read('Project.id');
//    $year = $this->Session->read('Project.year');
  //  $month = $this->Session->read('Project.month');
    //$client_id = $this->Session->read('Client.id');
//      $project = $this->Projects->get($project_id, [
//        'contain' => ['Clients']
//      ]);
  //  $user = $this->Users->get($user_id, [
    //  'contain' => []
  //  ]);
  }





    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editMonth($id = null)
    {
      if($id == "addMonth"):
        $user_id = $this->Session->read('User.id');
      else:
        $user_id = $id;
      endif;

      $company_id = $this->Auth->user('company_id');
//      $project_id = $this->Session->read('Project.id');
      $year = $this->Session->read('Project.year');
      $month = $this->Session->read('Project.month');
      $client_id = $this->Session->read('Client.id');
//      $project = $this->Projects->get($project_id, [
//        'contain' => ['Clients']
//      ]);
      $user = $this->Users->get($user_id, [
        'contain' => []
      ]);

  //    if ($this->request->is(['post']) && isset($this->request->data['urlfrom'])):
      if ($id === 'addMonth'):

//        $monthlyReport = $this->MonthlyReports->find('all', [
//          'contain' => ['Users']
//        ])
  //        ->where([
    //        'MonthlyReports.company_id' => $this->Auth->user('company_id'),
//            'project_id' => $this->Session->read('Project.id'),
  //          'MonthlyReports.user_id' => $user_id,
    //        'year' => $year,
      //      'month' => $month
        //  ])
          //->first();
          $client = $this->Clients->get($client_id);

//        if($monthlyReport == null) {
          $monthly = $this->MonthlyReports->newEntity();
          $monthly->company_id = $company_id;
          $monthly->client_id = $client_id;
          $monthly->user_id = $user_id;
          $monthly->year = $year;
          $monthly->month = $month;

          $monthly->client = $client;
  //        $monthly_up = $this->MonthlyReports->save($monthly);
          $this->set('monthlyReport', $monthly);
//        } else {
  //        $this->set('monthlyReport', $monthlyReport);
    //    }

    elseif($this->request->is(['post']) && isset($this->request->data['urlfrom'])):
      // EDIT 初回
      $monthly = $this->MonthlyReports->find('all', [
        'contain' => ['Clients', 'Users']
      ])
        ->where([
          'MonthlyReports.company_id' => $this->Auth->user('company_id'),
          'MonthlyReports.client_id' => $client_id,
          'MonthlyReports.user_id' => $user_id,
          'year' => $year,
          'month' => $month
        ])
        ->first();
        $this->set('monthlyReport', $monthly);

      elseif($this->request->is(['post'])): // && isset($this->request->data['urlfrom'])):

        $entity = $this->MonthlyReports->find('all', [
          'contain' => ['Clients', 'Users']
        ])
          ->where([
            'MonthlyReports.company_id' => $this->Auth->user('company_id'),
            'MonthlyReports.client_id' => $client_id,
            'MonthlyReports.user_id' => $user_id,
            'year' => $year,
            'month' => $month
          ])
          ->first();
        if($entity == null) {
          $entity = $this->MonthlyReports->newEntity();
        }
        $entity = $this->MonthlyReports->patchEntity($entity, $this->request->data, [
            'validate' => 'update'
        ]);
        if($entity->errors ()) {
          // Validate Error 時
          $this->set("errors", $entity->errors ());
        }

        $entity->company_id = $company_id;
        $entity->client_id = $client_id;
        $entity->user_id = $user_id;
        $entity->year = $year;
        $entity->month = $month;

        $yy = $year;
        $mm = $entity['month_mm'];
        $dd = $entity['day_dd'];
        $dt = $yy . "/" . $mm . "/" . $dd;
        if(($mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
            $entity['bonus_date'] = new \DateTime($dt);
        } else {
            $entity->bonus_date = null;
        }

        if($entity->errors ()) {
          $this->set('monthlyReport', $entity);
        }
        else
        {
          // 保存する
//          $this->log($entity, 'debug');
          $this->MonthlyReports->save($entity);

          return $this->redirect(['action' => 'index-month/' . $client_id]);
        }
      endif;

      $this->set(compact('client'));
      $this->set('_serialize', ['client']);
      $this->set(compact('project'));
      $this->set('_serialize', ['project']);
      $this->set(compact('user'));
      $this->set('_serialize', ['user']);

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editSinglexxx($id = null)
    {
//        $user = $this->Users->get($id, [
  //          'contain' => []
    //    ]);
      //  if ($this->request->is(['patch', 'post', 'put'])) {
        //    $user = $this->Users->patchEntity($user, $this->request->data);
          //  if ($this->Users->save($user)) {
            //    $this->Flash->success(__('The user has been saved.'));

//                return $this->redirect(['action' => 'index']);
  //          } else {
    //            $this->Flash->error(__('The user could not be saved. Please, try again.'));
      //      }
        //}
//        $this->set(compact('user'));
  //      $this->set('_serialize', ['user']);
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
