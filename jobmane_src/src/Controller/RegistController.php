<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use \Exception;
use App\Utils\LocalStorage;

/**
 * Resist Controller
 *
 * @property NONE \App\Model\Table\MenuUsersTable $Users
 */
class RegistController extends AppController
{


  /**
   * Initialize method
   */
  public function initialize()
  {
    parent::initialize();

    $this->Users  = TableRegistry::get('Users');
    $this->Randoms  = TableRegistry::get('Randoms');
    $this->Confirmed  = TableRegistry::get('Confirmed');

    $this->Session = $this->request->session();
  }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
//      $this->log('MenuController index()', 'debug');
//        $users = $this->paginate($this->Users);

  //    $this->set('role', $this->Auth->user('role'));

  //      $this->set(compact('users'));
    //    $this->set('_serialize', ['users']);
    }


  /**
   * Authetication method
   *
   * 端末認証を開始する
   *
   * @return \Cake\Network\Response|null
   */
  public function authentication($id = null)
  {
    // $id は 乱数字
    $rnd = $id;
//    $user = null;
    $result_msg = "端末承認してください";
    $user_id = "";
    $confirm_id = "";
    $confirm_disp_id = "";
    $title_next = '認証する';
    $url_error = false;

    try {
      // 乱数の検索（認証対象なのかのチェック用）
      $random = $this->Randoms->find('all')
        ->contain([])
        ->where([
          'random' => $rnd,
        ])
        ->order(['created' => 'desc'])
        ->first();

      if(!$random) {
        throw new Exception("認証の対象でありません。<br>URLに有効なパラメータ値が設定されていません !?");
      }

      // 乱数の検索（認証対象なのかのチェック用）
      $confirm = $this->Confirmed->find('all')
        ->contain([])
        ->where([
          'user_id' => $random->user_id,
        ])
        ->order(['created' => 'desc'])
        ->first();

      if(!$confirm) {
        throw new Exception("認証の対象でありません。");
      }
      $confirm_id = $confirm->confirmed_id;
      $confirm_disp_id = substr($confirm_id, 0, 20);
      $user_id = $random->user_id;

    // 認証番号の発行
//    $confirm_id = md5($random->user_id . date("Ymd His"));

    //$user = $this->Users->get($id);
//    $confirm = md5($user_id . date("Ymd His"));

//    $confirm = $this->Confirmed->newEntity();
//    $confirm->user_id = $user_id;
//    $confirm->confirmed_id = $confirm_id;
//    $confirm->checked = false;
//    $this->Confirmed->save($confirm);


    } catch(Exception $e) {
        $title_next = '無効なURLパラメータ値です'; // . $e->getMessage();
        $confirm_disp_id = "無効なURLパラメータ値です";
    // 認証時に問題発生
     // $this->Flash->error($e->getMessage());
      $result_msg = $e->getMessage();
      $url_error = true;
    }

    $this->log('▼', 'debug');
    $this->log($confirm_id, 'debug');


    // ユーザー情報
    $this->set(compact('user_id'));
    $this->set(compact('title_next'));

    $this->set(compact('url_error'));
    // 認証番号
    $this->set(compact('confirm_id'));
    $this->set(compact('confirm_disp_id'));
    // 次表示タイトル
    $this->set(compact('result_msg'));
    // heder の slide表示なし
    $this->set('header', 'no');

  }

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function confirmed()
  {
//    $user = $this->Users->get($id);
//    $rnd = md5($user->id . date("Ymd His"));

//    $user_id = 0;
//    $this->log($user_id, 'debug');
//    $user = $this->Users->get($user_id);

$confirmed_id = $this->request->data('confirmed_id');
$user_id = $this->request->data('user_id');
    $result_msg = "端末認証されました";

    $this->log($confirmed_id, 'debug');
    $this->log($user_id, 'debug');
    //$cook_non = '';
    //$cook_set = '';

    try {

      // $js = LocalStorage::loadStorage('testID');
      // $js2 = LocalStorage::loadStorage('valID');

      // localStorage.setItem('aaa','xxxxx');

//$js = localStorage.getItem('aaa');


  //     $this->set(compact(['js', 'js2']));

      // 乱数の検索（認証対象なのかのチェック用）
    //  $random = $this->Confirmed->find('all')
      //  ->contain([])
        //->where([
          //'confirmed_id' => $confirmed_id,
        //])
      //  ->order(['created' => 'desc'])
        //->first();

      //if(!$random) {
        //throw new Exception("認証対象でないか、認証期間が過ぎました");
    //  }
//      $user_id = $random->user_id;

      // 認証番号の発行
  //    $confirmed_id = md5($random->user_id . date("Ymd His"));

      // まずは存在しないことの検証
      //$cook_non = $_COOKIE["coco"];
      // 認証番号の有無を念のために確認する
    //  $confirmed = $this->Confirmed->find('all')
    //    ->contain([])
    //    ->where([
    //      'user_id' => $user_id,
    //      'confirmed_id' => $confirm_id,
    //    ])
    //    ->order(['created' => 'desc'])
    //    ->first();

    //  if($confirmed) {
      //  $cook_set = $confirmed->confirmed_id;
        //if($cook_non == $confirmed->confirmed_id) {
          //throw new Exception("既に認証されています");
  //      }
    //  }

      // 認証番号をクッキーに保存
      //setcookie("coco", $confirmed_id, time() + (100 * 12 * 24 * 3600), "/regist/");
      // ちゃんと書けたかの確認
//      $cook_set = $_COOKIE["coco"];

  //    if($cook_set != $confirmed_id) {
      //  throw new Exception("この端末は認証できません");
    //  }
    $confirmed = $this->Confirmed->find('all')
      ->contain([])
      ->where([
        'user_id' => $user_id,
        'confirmed_id' => $confirmed_id,
      ])
      ->order(['created' => 'desc'])
      ->first();


      // 認証情報の更新
      if($confirmed) {
    //      $confirmed = $this->Confirmed->newEntity();
     // }
      $confirmed->user_id = $user_id;
      $confirmed->confirmed_id = $confirmed_id;
      $confirmed->checked = true;
      $this->Confirmed->save($confirmed);
 } else {
}

    } catch(Exception $e) {
      // 認証時に問題発生
      $result_msg = $e->getMessage();
    }
//    $cook_set = $_COOKIE["coco"];
  //  if($cook_set != $confirmed_id) {
//      $result_msg = "この端末は認証できません";
  //  }

  $confirm_disp_id = substr($confirmed_id, 0, 24);
  $this->set(compact('confirm_disp_id'));

  $this->set(compact('confirmed_id'));
  $this->set(compact('user_id'));
    $this->set(compact('result_msg'));
    // heder の slide表示なし
    $this->set('header', 'no');

    $this->set(compact('comfirm_id'));
    $this->set(compact('cook_set'));
  }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexSupervisor()
    {
      $this->log('MenuController index()', 'debug');
//        $users = $this->paginate($this->Users);

  //      $this->set(compact('users'));
    //    $this->set('_serialize', ['users']);
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

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
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
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
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
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
