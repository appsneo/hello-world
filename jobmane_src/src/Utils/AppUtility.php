<?php
namespace App\Utils;

/**
 *
 */
 class AppUtility
 {
   public static function convertDate($user, $data)
   {
     $user['email'] = $data['email'];
//      $user->email = $this->request->data['email'];
     // アカウント状態
     if($user['account_status'] == "account_on") {
       $user['status'] = true;
     } else {
       $user['status'] = false;
     }
     // 最新健康診断年月日
     $yy = $data['medical_checkup_year_yy'];
     $mm = $data['medical_checkup_month_mm'];
     $dd = $data['medical_checkup_day_dd'];
     $dt = $yy . "/" . $mm . "/" . $dd;
     if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
       $user['medical_checkup_date'] = new \DateTime($dt);
     } else {
       $user['medical_checkup_date'] = null;
     }
     // 生年月日
     $yy = $data['birthday_year_yy'];
     $mm = $data['birthday_month_mm'];
     $dd = $data['birthday_day_dd'];
     $dt = $yy . "/" . $mm . "/" . $dd;
     if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
       $user['birth_date'] =  new \DateTime($dt);
     } else {
       $user['birth_date'] = null;
     }
     // 入社年月日
     $yy = $data['joined_year_yy'];
     $mm = $data['joined_month_mm'];
     $dd = $data['joined_day_dd'];
     $dt = $yy . "/" . $mm . "/" . $dd;
     if(($yy != "-" && $mm != "-" && $dd != "-") && checkdate($mm, $dd, $yy)) {
       $user['joined_date'] =  new \DateTime($dt);
     } else {
       $user['joined_date'] = null;
     }
     // 退社年月日
     $yy = $data['leaving_year_yy'];
     $mm = $data['leaving_month_mm'];
     $dd = $data['leaving_day_dd'];
     $dt = $yy . "/" . $mm . "/" . $dd;
     if(($yy!="-" && $mm!="-" && $dd!='-') && checkdate($mm, $dd, $yy) ) {
       $user['leaving_date'] =  new \DateTime($dt);
     } else {
       $user['leaving_date'] = null;
     }

     return $user;
   }

   public static function convertCompanyData($company, $data)
   {
   // 会社名
   $company['name'] = $data['company_name'];
   // 早出手当金額
   $buf = str_replace("," , "", $data['hourly_pay']);
   $buf = intval($buf);
   $company['shift_pay'] = $buf;
   // 残業手当金額　
   $buf = str_replace("," , "", $data['hourly_pay2']);
   $buf = intval($buf);
   $company['overtime_pay'] = $buf;
   // 早出手当の有無
   if( $data['early_shift_allowance'] == "有") {
     $company['shift_exist'] = true;
   }
   if( $data['early_shift_allowance'] == "無") {
     $company['shift_exist'] = false;
   }
   // 残業手当の有無
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
   if(($hour != "-" && $min != "-") && AppUtility::checktime($hour, $min)) {
     $tm = new \DateTime($tm);
     $company['overtime_time'] = $tm;
   } else {
     $company['overtime_time'] = null;
   }
   return $company;
 }


  // 作業開始時刻、作業終了時刻、休憩時間から作業時間を求める
  public static function diffTime($start, $end, $rest_minutes)
  {
    if($start == null || $end == null) {
      return "";
    }
    $startSec = strtotime($start);
    $endSec = strtotime($end);
    $rest = strtotime($rest_minutes . ' minute');

    $now = strtotime("now");
    $now_rest = strtotime('+' . $rest_minutes . ' minute');
    $diff = $endSec - $startSec - ($now_rest - $now);

    return gmdate('G:i', $diff);
  }

  // 早出時間を作業開始時刻と早出時刻、早出手当有無から求める
  public static function shiftTime($start, $shift_time, $shift_exist)
  {
    if($shift_exist):
      if($start > $shift_time) {
        return "";
      }
      if($start == null) {
        return "";
      }
      $startSec = strtotime($start);
      $shiftSec = strtotime($shift_time);
      $diff = $shiftSec - $startSec;

      return gmdate('G:i', $diff);
    else:
      return "";
    endif;
  }

  // 残業時間を作業終了時刻と残業開始時刻、残業手当有無から求める
  public static function overTime($end, $over_time, $overtime_exist)
  {
    if($overtime_exist):
      if($end <= $over_time) {
        return "";
      }
      $endSec = strtotime($end);
      $overSec = strtotime($over_time);
      $diff = $endSec - $overSec;

      return gmdate('G:i', $diff);
    else:
      return "";
    endif;
  }

  public static function checkTime($hour, $min)
  {
    if($hour < 0 || $hour > 23 || !is_numeric($hour)) {
      return false;
    }
    if($min < 0 || $min > 59 || !is_numeric($min)) {
      return false;
    }
    return true;
  }

  public static function weekjp($num)
  {
    switch($num) {
      case 0:
        return '日';
        break;
      case 1:
        return '月';
        break;
      case 2:
        return '火';
        break;
      case 3:
        return '水';
        break;
      case 4:
        return '木';
        break;
      case 5:
        return '金';
        break;
      case 6:
        return '土';
        break;
      case 7:
        return '日';
        break;
      default:
        return '?';
        break;
    }
  }

  /**
   * ランダム文字列生成 (英数字)
   * $length: 生成する文字数
   */
  function makeRandStr($length) {
      $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
      $r_str = null;
      for ($i = 0; $i < $length; $i++) {
          $r_str .= $str[rand(0, count($str) - 1)];
      }
      return $r_str;
  }

}

 ?>
