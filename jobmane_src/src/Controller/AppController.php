<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

  /**
   * Initialization hook method.
   *
   * Use this method to add common initialization code like loading components.
   *
   * e.g. `$this->loadComponent('Security');`
   *
   * @return void
   */
  public function initialize()
  {
    parent::initialize();

    $controller = $this->name;
    $this->log($controller . '.' . $this->request->action . '()', 'debug');

    //$this->set('menu_from', $controller . '.' . $this->request->action);

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');

//    session_cache_limiter('nocache');

    session_cache_limiter('private_no_expire');
    $this->Session = $this->request->session();

    // 端末承認だけはログインなしでも表示可能
    if($controller == "Regist") {
      return;
    }

    // ログイン認証
    $this->loadComponent('Auth', [
      'authenticate' => [
        'Form' => [
          'userModel' => 'Users',
          'fields' => [
            'username' => 'user_id',
            'password' => 'password'
          ],
//          'columns' => ['company_id'],
           'scope' => ['Users.status' => true]
        ]
      ],
      'loginAction' => [
        'controller' => 'Users',
        'action' => 'Login'
      ],
      'loginRedirect' => [
        'controller' => 'menu',
        'action' => 'index'
      ],
      'logoutRedirect' => [
        'controller' => 'Users',
        'action' => 'login'
      ],
      'authError' => 'login failed.'
    ]);

    $this->Auth->sessionKey = 'Auth.User';
    $auth = $this->Auth->user();
    if ($auth) {
      $this->set(compact('auth'));
      $this->set('_serialize', ['auth']);
    } else {
    //  $this->Flash->error('ログイン認証に失敗しました');
    }

  }

  public function beforeFilter(Event $event)
  {
    // 端末承認だけはログインなしでも表示可能
    if($this->name != "Regist") {
      $this->Auth->allow(['users', 'login']);
    }
    $this->log('AppController beforeFilter()', 'debug');
  }


    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
