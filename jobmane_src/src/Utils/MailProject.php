<?php
namespace App\Utils;

use Cake\Mailer\Email;

/**
 *
 */
 class MailProject
 {
   public static function mailProject($company_name, $project_num, $project_name) {
     // メールタイトル：
     // プロジェクト名（工事名）の作業が予定されました。
     //
     // メール本文：
     // 会社名
     // 各位
     //
     // プロジェクト名（工事名）の作業にあなたが割り当てられました。
     // 下記ＵＲＬにアクセスしプロジェクト内容をご確認ください。
     // http://xxx.xxx.xx
     //
     // 着工の時期は、改めてお知らせします。
     // よろしくお願いいたします。
     //

//     $to = [];
  //   $pos = 0;
    // foreach($users as $user):

  //  \Cake\Log\Log::debug($president);
  //  \Cake\Log\Log::debug($president['email']);
    //   $this->log($user, 'debug');
       // 該当者を改めて追加する
      // if($user->op == "add"){
        // $to = [$user->email => $user->name];     //AppUtility::mailProject($company->name, $this->Auth->user, $users_up);
        // $/pos++;
         //\Cake\Log\Log::debug($to);
       //}
     //endforeach;

//     "  http://jobmane.japanwest.cloudapp.azure.com:8000" . "\n\n".


     $body = "" . $company_name . "\n" .
       " 各位\n\n" .
       $project_name . '(' . $project_num . ')' . "の作業にあなたが割り当てられました。\n" .
       " 下記ＵＲＬにアクセスしプロジェクト内容をご確認ください。\n\n" .
       "  http://www.jobmane.info" . "\n\n".
       "着工の時期は、改めてお知らせします。\n" .
       "よろしくお願いいたします。\n";

       \Cake\Log\Log::debug($body);

return $body;

     // 端末承認の為のメールを作業員に送付する
//     $e_mail = new Email('default');

  //   $e_mail->to(["ishida.takao@appneo.com" => "takao"])
    //   ->from([$president['email'] => $president['name']])
      // ->subject('プロジェクト名（工事名）の作業が予定されました')
       //->send( $body );


//       \Cake\Log\Log::debug($body);
    // $this->log('Email:' , 'debug');
   }

}
