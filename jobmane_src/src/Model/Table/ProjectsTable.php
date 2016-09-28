<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\HasMany $AssingWorkers
 * @property \Cake\ORM\Association\HasMany $ProjectPeriod
 * @property \Cake\ORM\Association\HasMany $ProjectWorkers
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
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

        $this->table('projects');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->hasMany('AssingWorkers', [
//            'foreignKey' => 'project_id'
//        ]);
        $this->hasMany('ProjectPeriods', [
            'foreignKey' => 'project_id'
        ]);
        $this->hasMany('ProjectUsers', [
            'foreignKey' => 'project_id'
        ]);
//        'foreignKey' => 'id',
  //      'bindingKey' => 'user_id',
    //    'joinType' => 'INNER'



        $this->belongsTo('Companies', [
          'className' => 'Companies',
            'foreignKey' => 'company_id'
        ]);
        $this->belongsTo('Clients', [
//          'className' => 'Clients',
            'foreignKey' => 'client_id'
        ]);
        $this->belongsTo('Categories', [
            'className' => 'Categories',
            'foreignKey' => 'category_id'
        ]);

        $this->hasOne('Reports', [
            'foreignKey' => 'project_id'
        ]);

//$this->belongsTo('Reports', [
//  'className' => 'Reports',
//    'foreignKey' => 'id',
//    'bindingKey' => 'project_id',
//]);
//        $this->hasMany('Reports', [
//            'foreignKey' => 'project_id',
//            'bindingKey' => 'id',
//            'joinType' => 'INNER'
//        ]);
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
      ->notEmpty('num', '工事物件Noは入力必須です')
      ->notEmpty('client', '依頼元は入力必須です');
//        $validator
//            ->notEmpty('secondary', '協力会社名は入力必須です');




    $validator
      ->notEmpty('project_name', '工事名は入力必須です');


    $validator
      ->notEmpty('category', '作業種別は入力必須です');
    $validator
      ->notEmpty('money', '受注金額は入力必須です');
//      $validator
  //        ->notEmpty('start', '期間は入力必須です');
    //  $validator
      //    ->notEmpty('end', '期間は入力必須です');
    $validator
      ->notEmpty('address', '施工場所は入力必須です')
      ->add('address', 'custom', [
        'rule' => function ($value, $context) {
          if($context['data']['document'] || $context['data']['drawing']['error'] == 0) {
//            if($context['data']['drawing']['error'] == 4) {
            return true;
          }
          return false;
        },
        'message' => '図面書類は入力必須です'
      ]);
    $validator
      ->notEmpty('charge', '本体工事店建築担当者は入力必須です');
    $validator
      ->requirePresence('operators', true, '作業員は入力必須です');

//    $validator
  //    ->notEmpty('document', '図面書類は入力必須です');
    $validator
  //    ->notEmpty('drawing', '図面書類を選択してください')
      ->notEmpty('dummy', '工事着手日と工事完了日に矛盾があります');

      // 早出手当
//      $validator
  //      ->add('document', 'custom', [
    //      'rule' => function ($value, $context) {
      //      return false;
        //  },
          //'message' => '図面書類は入力必須です 22 !!'
      //  ]);

    // 早出手当
//    $validator
  //    //->notEmpty('document', '図面書類は入力必須です')
    //  ->add('document', 'custom', [
      //  'rule' => function($value, $context) {
//          if(isset($context['data']['document'])) {  //} || isset($context['data']['drawing'])) {
  //          return false;
    //      }
//          return false;
        //},
  //      'message' => '図面書類は入力必須です !!'
//      ]);

        /*
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('num');

        $validator
            ->allowEmpty('secondar');

        $validator
            ->allowEmpty('project_name');

        $validator
            ->allowEmpty('sub-title');

        $validator
            ->allowEmpty('money');

        $validator
            ->allowEmpty('start');

        $validator
            ->allowEmpty('end');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('summary');

        $validator
            ->allowEmpty('charge');

        $validator
            ->allowEmpty('workers');

        $validator
            ->allowEmpty('memo');

        $validator
            ->allowEmpty('select_file');

        $validator
            ->allowEmpty('completino_check');

        $validator
            ->allowEmpty('created_user');

        $validator
            ->allowEmpty('modified_user');

*/

//        $validator
  //          ->notEmpty('num', '工事物件Noは入力必須です');

        return $validator;
    }

    public function numchar($value, $context) {
      return (bool) preg_match('/^[0-9][a-z]$/', $value);
    }


  /**
   * Default validation rules.
   *
   * @param \Cake\Validation\Validator $validator Validator instance.
   * @return \Cake\Validation\Validator
   */
  public function validationAdd(Validator $validator)
  {
        /*
//        $validator
  //          ->integer('id')
    //        ->allowEmpty('id', 'create');
        $validator
            ->notEmpty('num', '工事物件Noは入力必須です')
            ->notEmpty('client', '依頼元は入力必須です');
//        $validator
//            ->notEmpty('secondary', '協力会社名は入力必須です');
*/



        $validator
            ->notEmpty('project_name', '工事名は入力必須です');

/*
       $validator
            ->notEmpty('category', '作業種別は入力必須です');
        $validator
            ->notEmpty('money', '受注金額は入力必須です');
        $validator
            ->notEmpty('start', '期間は入力必須です');
        $validator
            ->notEmpty('end', '期間は入力必須です');
        $validator
            ->notEmpty('address', '施工場所は入力必須です');
        $validator
            ->notEmpty('charge', '本体工事店建築担当者は入力必須です');
        $validator
            ->requirePresence('operators', true, '作業員は入力必須です');
        $validator
            ->notEmpty('select_file', '図面書類は入力必須です')
            ->notEmpty('dummy', '工事着手日と工事完了日に矛盾があります');
*/
        return $validator;
    }


        /**
         * Default validation rules.
         *
         * @param \Cake\Validation\Validator $validator Validator instance.
         * @return \Cake\Validation\Validator
         */
        public function validationUpdate(Validator $validator)
        {
    //        $validator
      //          ->integer('id')
        //        ->allowEmpty('id', 'create');
//            $validator
//                ->notEmpty('num', '工事物件Noは入力必須です')
//                ->notEmpty('client', '依頼元は入力必須です');
//    //        $validator
//    //            ->notEmpty('secondary', '協力会社名は入力必須です');


    $validator
      ->notEmpty('num', 'メールアドレスは入力必須です')
      ->add('num', 'validFormat', [
            'rule' => 'email',
            'message' => 'メールアドレスを確認してください'
      ]);

            $validator
                ->notEmpty('project_name', '工事名は入力必須です');
/*

            $validator
                ->notEmpty('category', '作業種別は入力必須です');
            $validator
                ->notEmpty('money', '受注金額は入力必須です');
            $validator
                ->notEmpty('start', '期間は入力必須です');
            $validator
                ->notEmpty('end', '期間は入力必須です');
            $validator
                ->notEmpty('address', '施工場所は入力必須です');
            $validator
                ->notEmpty('charge', '本体工事店建築担当者は入力必須です');
            $validator
                ->requirePresence('operators', true, '作業員は入力必須です');
            $validator
                ->notEmpty('dummy', '工事着手日と工事完了日に矛盾があります');
*/
            return $validator;
        }


        /**
         * Default validation rules.
         *
         * @param \Cake\Validation\Validator $validator Validator instance.
         * @return \Cake\Validation\Validator
         */
        public function validationAddsingle(Validator $validator)
        {
            $validator
                ->notEmpty('project_name', '現場名は入力必須です');
            $validator
                ->notEmpty('num', '注文番号は入力必須です');
            $validator
                ->requirePresence('operators', true, '作業員は入力必須です');

//            $validator
//                ->notEmpty('start', '期間は入力必須です');
//            $validator
//                ->notEmpty('end', '期間は入力必須です');
//            $validator
//                ->notEmpty('dummy', '工事着手日と工事完了日に矛盾があります');

            return $validator;
        }


        public function beforeSave($event, $entity, $options)
        {
 //     //    \Cake\Log\Log::debug($entity);

          if (isset($entity->drawing['error']) && $entity->drawing['error'] === UPLOAD_ERR_OK) {
 //       //      \Cake\Log\Log::debug('drawing beforeSave OK !!');
 //         //    \Cake\Log\Log::debug($entity);
 //           //  \Cake\Log\Log::debug($entity->drawing);
 //   //        \Cake\Log\Log::debug('select_file beforeSave OK !!');
 //   //            debug($entity);
 //   //            \Cake\Log\Log::debug($entity);
 //   //            debug($entity->drawing);

 //     //      $this->_buildDrawing($entity);

            $entity->document = $entity->drawing['name'];

          } else {
 //   //        debug($entity->drawing);
////             \Cake\Log\Log::debug('select_file beforeSave NG ??');
  ////           \Cake\Log\Log::debug($entity);
    ////         \Cake\Log\Log::debug($entity->drawing);

       ////     $this->_buildDrawing($entity->drawing);

////            \Cake\Log\Log::debug('select_file beforeSave NG ?? : ' . $entity->select_file['tmp_name']);
            unset($entity->drawing);
          }
        }

          protected function _buildDrawing($entity)
          {
//        //    debug($photo);
//            $dir_to = "/work/papers";
//            $file_to = "";

 //           $doc = file_get_contents($entity->drawing['tmp_name']);

 //       //      $ret = file_get_contents('/img/default_avatar0.png');
 //           if($doc === false) {
 //             throw new RuntimeException('Can not get drawing image.');
 //           } else {
 //               $folder = new Folder($dir_to, true, 0755);
 //               $folder->create($dir_to . '/' . $entity->id);
 //               $fname = urlencode($entity->drawing['name']);

 //               $file_to = $dir_to . '/' . $entity->id . "/" . $fname;

 //               file_put_contents($file_to, $doc);

////                file_put_contents("/tmp/takao.txt", $doc);
 //               return;
   //         }
          }


}
