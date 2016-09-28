<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Utils\AppUtility;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('user_id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ProjectUsers', [
            'foreignKey' => 'id',
            'bindingKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    public function findAuth(Query $query)
    {
//        $this->log('Model UsersTable findAuth()', 'debug');

  //      $this->log('findAuth()', 'debug');
        $query->select(['id', 'name']);
  //      $query->where(['Users.status' => '1']);

        return $query;
      }


    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('companyid');

        $validator
            ->notEmpty('name', 'no name')
            ->notEmpty('user_id', 'no user_id');

        $validator
            ->date('birth_date')
            ->allowEmpty('birth_date');

        $validator
            ->allowEmpty('boad');

        $validator
            ->notEmpty('password');

        //    ->allowEmpty('password');

        $validator
            ->dateTime('medical_checkup_date')
            ->allowEmpty('medical_checkup_date');

        $validator
            ->dateTime('indate')
            ->allowEmpty('indate');

        $validator
            ->dateTime('outdate')
            ->allowEmpty('outdate');

        $validator
            ->allowEmpty('phonenumber');

        $validator
            ->allowEmpty('smartphone');

        $validator
            ->notEmpty('email', 'eeeee')
            ->add('email', [
              'length' => [
                'rule' => ['minLength', '10'],
                'message' => 'body length must be 10+'
              ]
            ]);
            //            ->email('email')
        $validator
            ->allowEmpty('status');

//        $validator
  //          ->allowEmpty('photo');
            //->add('avatar', ['list' => [
    //          'rule' =>['inList', ['jpg', 'png', 'gif']],
      //        'message' => 'jpg, png, gif only',
        //    ]]);


        return $validator;
    }

  /**
   * Update validation rules.
   *
   * ユーザー登録時のチェック
   *
   * @param \Cake\Validation\Validator $validator Validator instance.
   * @return \Cake\Validation\Validator
   */
  public function validationUpdate(Validator $validator)
  {
    //お名前は入力必須です
    //ユーザーIDは入力必須です
    //パスワードは入力必須です
    //パスワード再入力とパスワードが一致しません
    //メールアドレスは入力必須です

    $validator
      ->notEmpty('name', 'お名前は入力必須です')
      ->add('name', [
            'length' => [
              'rule' => ['maxLength', '20'],
              'message' => 'お名前は20文字まで入力できます'
            ]
      ]);

    $validator
      ->notEmpty('user_id', 'ユーザーIDは入力必須です')
      ->add('user_id', [
            'length' => [
              'rule' => ['maxLength', '20'],
              'message' => 'ユーザーIDは20文字まで入力できます'
            ]
      ]);

    $validator
      ->notEmpty('password', 'パスワードは入力必須です')
      ->add('password', [
            'length' => [
              'rule' => ['maxLength', '40'],
              'message' => 'パスワードは10文字まで入力できます'
            ]
      ]);

    $validator
      ->allowEmpty('password_check')
      ->add('password_check', [
            'comWith' => [
              'rule' => ['compareWith', 'password'],
              'message' => 'パスワード再入力とパスワードが一致しません',
            ],
      ]);

//      $validator
//      ->email('email', [
//                   'message' => 'メールxxxアドレスは入力必須です'
//
//      ]);

      $validator
        ->notEmpty('email', 'メールアドレスは入力必須です')
        ->add('email', 'validFormat', [
              'rule' => 'email',
              'message' => 'メールアドレスを確認してください'
        ]);

//    $validator
//    ->allowEmpty('email')
//    ->add('email', 'notEmpty', [
//        'rule' => 'notEmpty',
//        'last' => 'true',
//          'message' => 'メールアドレスは入力必須です'
//    ])
//    ->add('email', 'validFormat', [
//          'rule' => 'email',
//          'last' => 'true',
//          'message' => 'メールアドレスを確認してください'
//    ]);
//            ->add('email', [
  //            'length' => [
    //            'rule' => ['minLength', '5'],
      //          'message' => 'body length must be 10+'
        //      ]
          //  ]);

    return $validator;
  }

  /**
   * Default validation rules.
   *
   * @param \Cake\Validation\Validator $validator Validator instance.
   * @return \Cake\Validation\Validator
   */
  public function validationPresident(Validator $validator)
  {
    //        <li>お名前は入力必須です</li>
    //        <li>ユーザーIDは入力必須です</li>
    //        <li>メールアドレスは入力必須です</li>
    //        <li>会社名は入力必須です</li>
    //        <li>所定勤務時間は入力必須です</li>
    //        <li>早出手当は入力必須です</li>
    //        <li>残業手当は入力必須です</li>
    //        $validator
    //            ->integer('id')
    //            ->allowEmpty('id', 'create')
    //            ->requirePresence('user_id');

    $validator = $this->validationUser($validator);

  //  $validator
    //  ->notEmpty('name', 'お名前は入力必須です');

//    $validator
  //    ->notEmpty('user_id', 'ユーザーIDは入力必須です');

//    $validator
  //    ->notEmpty('password', 'パスワードは入力必須です');

//    $validator
  //    ->allowEmpty('password_check')
    //  ->add('password_check', [
      //      'comWith' => [
        //    'rule' => ['compareWith', 'password'],
          //      'message' => 'パスワード再入力とパスワードが一致しません',
            //],
//      ]);

//    $validator
  //    ->notEmpty('email', 'メールアドレスは入力必須です');

  //$validator
    //    ->add('email', 'validFormat', [
      //    'rule' => 'email',
        //  'message' => 'メールアドレスを確認してください'
      //  ]);


    $validator
      ->notEmpty('company_name', '会社名は入力必須です');

    // 所定勤務時間
    $validator
      ->add('rest_minutes', 'custom', [
        'rule' => function($value, $context) {
          if($context['data']['time1'] == '-' || $context['data']['minute1'] == '-') {
            return false;
          }
          if($context['data']['time2'] == '-' || $context['data']['minute2'] == '-') {
            return false;
          }
          if($context['data']['rest_minutes'] == '-') {
            return false;
          }
          return true;
        },
        'message' => '所定勤務時間は入力必須です'
      ]);

    // 早出手当
    $validator
      ->add('early_shift_allowance', 'custom', [
        'rule' => function($value, $context) {
          if($context['data']['early_shift_allowance'] == '有') {
            if($context['data']['time3'] == '-' || $context['data']['minute4'] == '-') {
              return false;
            }
          }
          return true;
        },
        'message' => '早出手当は入力必須です'
      ]);

    // 残業手当
    $validator
      ->add('early_shift_allowance2', 'custom', [
        'rule' => function($value, $context) {
          if($context['data']['early_shift_allowance2'] == '有') {
            if($context['data']['time4'] == '-' || $context['data']['minute5'] == '-') {
              return false;
            }
          }
          return true;
        },
        'message' => '残業手当は入力必須です'
      ]);

    // 最新健康診断年月日
    $validator
      ->add('medical_checkup_year_yy', 'custom', [
        'rule' => function($value, $context) {
          // 始業時間
          $yy = $context['data']['medical_checkup_year_yy'];
          $mm = $context['data']['medical_checkup_month_mm'];
          $dd = $context['data']['medical_checkup_day_dd'];
          if($yy == "-" && $mm == "-" && $dd == "-") {
            return true;
          } elseif($yy == "-" || $mm == "-" || $dd == "-") {
            return false;
          } elseif(!checkdate($mm, $dd, $yy)) {
            return false;
          } else {
            return true;
          }
        },
        'message' => '最新健康診断年月日の設定は無効でした'
      ]);

    // 入社年月日
    $validator
      ->add('joined_year_yy', 'custom', [
        'rule' => function($value, $context) {
          // 始業時間
          $yy = $context['data']['joined_year_yy'];
          $mm = $context['data']['joined_month_mm'];
          $dd = $context['data']['joined_day_dd'];
          if($yy == "-" && $mm == "-" && $dd == "-") {
            return true;
          } elseif($yy == "-" || $mm == "-" || $dd == "-") {
            return false;
          } elseif(!checkdate($mm, $dd, $yy)) {
            return false;
          } else {
            return true;
          }
        },
        'message' => '入社月日の設定は無効でした'
      ]);

    // 退社年月日
    $validator
      ->add('leaving_year_yy', 'custom', [
        'rule' => function($value, $context) {
          // 始業時間
          $yy = $context['data']['leaving_year_yy'];
          $mm = $context['data']['leaving_month_mm'];
          $dd = $context['data']['leaving_day_dd'];
          if($yy == "-" && $mm == "-" && $dd == "-") {
            return true;
          } elseif($yy == "-" || $mm == "-" || $dd == "-") {
            return false;
          } elseif(!checkdate($mm, $dd, $yy)) {
            return false;
          } else {
            return true;
          }
        },
        'message' => '退社年月日の設定は無効でした'
      ]);

    // 生年月日
    $validator
      ->add('birthday_year_yy', 'custom', [
        'rule' => function($value, $context) {
        // 始業時間
        $yy = $context['data']['birthday_year_yy'];
        $mm = $context['data']['birthday_month_mm'];
        $dd = $context['data']['birthday_day_dd'];
        if($yy == "-" && $mm == "-" && $dd == "-") {
          return true;
        } elseif($yy == "-" || $mm == "-" || $dd == "-") {
          return false;
        } elseif(!checkdate($mm, $dd, $yy)) {
          return false;
        } else {
          return true;
        }
      },
      'message' => '生年月日の設定は無効でした'
    ]);

    // 生年月日
    $validator
      ->add('birthday_year_yy', 'custom', [
        'rule' => function($value, $context) {
          // 始業時間
          $yy = $context['data']['birthday_year_yy'];
          $mm = $context['data']['birthday_month_mm'];
          $dd = $context['data']['birthday_day_dd'];
          if($yy == "-" && $mm == "-" && $dd == "-") {
            return true;
          } elseif($yy == "-" || $mm == "-" || $dd == "-") {
            return false;
          } elseif(!checkdate($mm, $dd, $yy)) {
            return false;
          } else {
            return true;
          }
        },
        'message' => '生年月日の設定は無効でした'
      ]);

//      {
//    $validator
  //    ->allowEmpty('photo');

    //$validator
      //->allowEmpty('photo');
            //->add('avatar', ['list' => [
    //          'rule' =>['inList', ['jpg', 'png', 'gif']],
      //        'message' => 'jpg, png, gif only',
        //    ]]);

        return $validator;
    }


    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationLogin(Validator $validator)
    {
        $validator
            ->requirePresence('user_id', 'create', 'need ID')
            ->requirePresence('password', 'create', 'need Password')
            ->notEmpty('user_id' ,'IDは入力必須です')
            ->notEmpty('password' ,'パスワードは入力必須です');

        return $validator;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationPassword(Validator $validator)
    {
        $validator
            ->requirePresence('password01', 'create', 'need Password01')
            ->requirePresence('password02', 'create', 'need Password02')
            ->requirePresence('password03', 'create', 'need Password03')
            ->notEmpty('password01' ,'現在のパスワードは入力必須です')
            ->notEmpty('password02' ,'新しいパスワードは入力必須です')
            ->allowEmpty('password03');

        $validator
            ->add('password02', [
              'comWith' => [
                'rule' => ['compareWith', 'password03'],
                'message' => '新しいパスワード再入力と新しいパスワードが一致しません',
              ],
            ]);


        return $validator;
    }

        /**
         * Default validation rules.
         *
         * @param \Cake\Validation\Validator $validator Validator instance.
         * @return \Cake\Validation\Validator
         */
        public function validationUser(Validator $validator)
        {
            $validator
              ->notEmpty('name', 'お名前は入力必須です');

              $validator
                ->notEmpty('user_id', 'ユーザーIDは入力必須です')
                ->add('user_id', [
                      'length' => [
                        'rule' => ['maxLength', '20'],
                        'message' => 'ユーザーIDは20文字まで入力できます'
                      ]
                ]);
            $validator
              ->notEmpty('password', 'パスワードは入力必須です');

            $validator
              ->allowEmpty('password_check')
              ->add('password_check', [
                    'comWith' => [
                    'rule' => ['compareWith', 'password'],
                        'message' => 'パスワード再入力とパスワードが一致しません',
                    ],
              ]);

//            $validator
  //            ->notEmpty('email', 'メールアドレスは入力必須です')
    //          ->add('email', 'メールアドレスを確認してください', [
      //          'rule' => 'email'
        //      ]);

              $validator
                ->notEmpty('email', 'メールアドレスは入力必須です')
                ->add('email', 'validFormat', [
                      'rule' => 'email',
                      'message' => 'メールアドレスを確認してください'
                ]);


              return $validator;
        }

            /**
             * Default validation rules.
             *
             * @param \Cake\Validation\Validator $validator Validator instance.
             * @return \Cake\Validation\Validator
             */
            public function validationCompany(Validator $validator)
            {
                $validator
                    ->notEmpty('company_name' ,'empty company_name !!')
                    ->requirePresence('user_idx', 'create', 'need IDx')
                    ->requirePresence('passwordx', 'create', 'need Passwordx')
                    ->notEmpty('user_id' ,'empty UserId (Company)!!')
                    ->notEmpty('password' ,'empty Password !!');

                return $validator;
            }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique([ 'user_id']),[
          'errorField' => 'user_id',
          'message' => __('ユーザーID は既に使われています')
        ]);

        return $rules;
    }


    public function beforeSave($event, $entity, $options)
    {
///      \Cake\Log\Log::debug($entity);

      if (isset($entity->photo['error']) && $entity->photo['error'] === UPLOAD_ERR_OK) {
        debug('photo beforeSave OK !!');
//        \Cake\Log\Log::debug('phone beforeSave OK !!');
//        \Cake\Log\Log::debug($entity);
//        \Cake\Log\Log::debug($entity->photo);
        //        debug($entity);
//        debug($entity->photo);

        $entity->image = $this->_buildPhoto($entity->photo);
        debug('image saved');
        \Cake\Log\Log::debug('image saved.');
      } else {
        debug('photo beforeSave NG ??');
//        \Cake\Log\Log::debug('photo beforeSave NG ???');
//        \Cake\Log\Log::debug($entity);
//        \Cake\Log\Log::debug($entity->photo);
        unset($entity->photo);
        // 画像データを保存しないで処理終了する
        //return false;
      }
    }

  protected function _buildPhoto($photo)
  {
    $ret = file_get_contents($photo['tmp_name']);
    if($ret === false) {
      throw new RuntimeException('Can not get phone image.');
    } else {
      list($width, $height, $type, $attr) = getimagesize($photo['tmp_name']);

      $mime = image_type_to_mime_type($type);

      if($type == IMAGETYPE_GIF) {
        $image = imagecreatefromgif($photo['tmp_name']);
      }
      if($type == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($photo['tmp_name']);
      }
      if($type == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($photo['tmp_name']);
      }

      $startX = 0;
      $startY = 0;
      $widthNew = 0;
      if($height >= $width) {
        $startX = 0;
        $startY = ($height - $width) / 2;
        $heightNew = $height - $width;
        if($width > 640) {
          $widthNew = 640;
        } else {
          $widthNew = $width;
        }
        $canvas = imagecreatetruecolor($widthNew, $widthNew);
        imagecopyresampled($canvas, $image, 0,0,
                $startX,    // コピー元の x座標
                $startY,    // コピー元の y座標
                $widthNew,     // 背景画像の幅
                $widthNew,     // 背景画像の高さ
                $width,     // コピー元の 幅
                $width      // コピー元の 高さ
        );
      }
      if($height < $width) {
          $startY = 0;
          $startX = ($width - $height) / 2;
          if($width > 640) {
              $widthNew = 640;
          } else {
              $widthNew = $height;
          }
          $canvas = imagecreatetruecolor($widthNew, $widthNew);
          imagecopyresampled($canvas, $image, 0,0,
                $startX,    // コピー元の x座標
                $startY,    // コピー元の y座標
                $widthNew,     // 背景画像の幅
                $widthNew,     // 背景画像の高さ
                $height,     // コピー元の 幅
                $height      // コピー元の 高さ
          );
        }
      }

      $rand = AppUtility::makeRandStr(10);
      imagejpeg($canvas, "/tmp/crea-" . $rand . ".jpg");
      $ret = file_get_contents( "/tmp/crea-" . $rand . ".jpg");
//        return $cache;
      return $ret;
    }
  }
