<?php

/**
 * Created by PhpStorm.
 * User: koji
 * Date: 2015/11/26
 * Time: 18:14
 */
namespace App\View\Helper;
use App\Model\Table\MeetsHistoriesTable;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\ORM\TableRegistry;


/**
 * Class ConsumerHelper
 *
 *
 *
 * @package App\View\Helper
 */
class ConsumerHelper  extends  Helper{


/**
   * エラーHTML取得
   * @param unknown $errors
   * @param unknown $err_key
   * @return string
   */
  public function getErrorHtml($errors, $err_key, $is_br_exclude = null) {
      if (empty($err_key) || !isset($errors) || empty($errors) || !is_array($errors) || count($errors) == 0) {
              return "";
      }

      $err_keys = array($err_key);
      if (strpos($err_key, ",") !== FALSE) {
              $err_keys = explode(',', $err_key);
      }

      $result = "";
      $results = array();
      foreach ($errors as $key => $value) {
              $is_exists = false;
              foreach($err_keys as $err_key_value) {
                      if ($key !== $err_key_value) {
                              continue;
                      }
                      $is_exists = true;
                      break;
              }
              if (!$is_exists) {
                      continue;
              }
              foreach($value as $e) {
                      if (in_array($e, $results)) {
                              continue;
                      }

                    //  if (!empty($result)) {
                      //        $result = "<li>" . $result . "</li>";
                    //  }
                      $result = $result . "<li>" . $e . "</li>";
                      $results[] = $e;
              }
            }


//            <ul class="error">
  //            <li>お名前は入力必須です</li>
    //          <li>ユーザーIDは入力必須です</li>
      //        <li>メールアドレスは入力必須です</li>
        //      <li>会社名は入力必須です</li>
          //    <li>所定勤務時間は入力必須です</li>
            //  <li>早出手当は入力必須です</li>
              //<li>残業手当は入力必須です</li>
    //        </ul>


            if (!empty($result)) {
                    if (isset($is_br_exclude) && $is_br_exclude === true) {
                        $result = '<ul class="error" onclick="this.classList.add(' . "'hidden'); this.classList.remove(" . "'error');" . '">' . $result . '</ul>';
                      //      $result = '<span class="message error" style="position: relative;top: 10px;width: 96%;display: inline-block; text-align: center;">' . $result . '</span>';
                    } else {
                      $result = '<br><ul class="error" onclick="this.classList.add(' > "'hidden'); this.classList.remove(" . "'error');" . '">' . $result . '</ul>';
                      //      $result = '<br><span class="message error" style="position: relative;top: 10px;width: 96%;display: inline-block; text-align: center;">' . $result . '</span>';
                    }
            }

            return $result;
        }



        /**
           * エラーHTML取得
           * @param unknown $errors
           * @param unknown $err_key
           * @return string
           */
          public function getSuccessHtml($errors, $err_key, $is_br_exclude = null) {
              if (empty($err_key) || !isset($errors) || empty($errors) || !is_array($errors) || count($errors) == 0) {
                      return "";
              }

              $err_keys = array($err_key);
              if (strpos($err_key, ",") !== FALSE) {
                      $err_keys = explode(',', $err_key);
              }

              $result = "";
              $results = array();
              foreach ($errors as $key => $value) {
                      $is_exists = false;
                      foreach($err_keys as $err_key_value) {
                              if ($key !== $err_key_value) {
                                      continue;
                              }
                              $is_exists = true;
                              break;
                      }
                      if (!$is_exists) {
                              continue;
                      }
                      foreach($value as $e) {
                              if (in_array($e, $results)) {
                                      continue;
                              }

                            //  if (!empty($result)) {
                              //        $result = "<li>" . $result . "</li>";
                            //  }
                              $result = $result . "<li>" . $e . "</li>";
                              $results[] = $e;
                      }
                    }


        //            <ul class="error">
          //            <li>お名前は入力必須です</li>
            //          <li>ユーザーIDは入力必須です</li>
              //        <li>メールアドレスは入力必須です</li>
                //      <li>会社名は入力必須です</li>
                  //    <li>所定勤務時間は入力必須です</li>
                    //  <li>早出手当は入力必須です</li>
                      //<li>残業手当は入力必須です</li>
            //        </ul>


                    if (!empty($result)) {
                            if (isset($is_br_exclude) && $is_br_exclude === true) {
                                $result = '<ul class="success" onclick="this.classList.add(' . "'hidden'); this.classList.remove(" . "'success');" . '">' . $result . '</ul>';
                              //      $result = '<span class="message error" style="position: relative;top: 10px;width: 96%;display: inline-block; text-align: center;">' . $result . '</span>';
                            } else {
                              $result = '<br><ul class="sucess" onclick="this.classList.add(' > "'hidden'); this.classList.remove(" . "'success');" . '">' . $result . '</ul>';
                              //      $result = '<br><span class="message error" style="position: relative;top: 10px;width: 96%;display: inline-block; text-align: center;">' . $result . '</span>';
                            }
                    }

                    return $result;
                }
}
