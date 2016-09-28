<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reports Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Report get($primaryKey, $options = [])
 * @method \App\Model\Entity\Report newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Report[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Report|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Report patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Report[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Report findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportsTable extends Table
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

        $this->table('reports');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReportMaterials', [
            'foreignKey' => 'report_id',
            'bindingKey' => 'id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('Users', [
            'foreignKey' => 'id',
            'bindingKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
  //      $this->hasOne('Clients', [
    //        'foreignKey' => 'id',
      //      'bindingKey' => 'client_id',
        //    'joinType' => 'INNER'
    //    ]);
        $this->belongsTo('ProjectUsers', [
            'foreignKey' => ['project_id', 'user_id'],
            'bindingKey' => ['project_id', 'user_id'],
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => ['project_id'],
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationUpdate(Validator $validator)
    {

    //    $validator
    //        ->add('quantity', 'alphaNumeric1', [
    //            'rule' => ['alphaNumeric'],
    //            'message' => '所定勤務時間は入z力必須です'
    //        ]);

    //    $validator
    //      ->notEmpty('note');


//        $validator
//            ->add('note', 'alphaNum', [
//                'rule' => ['alphaNumeric'],
//                'message' => '所定勤務時間は入z力必須です'
//            ]);


/*        $validator
          ->notEmpty('note');

      // 入場時間
      $validator
        ->add('quantity', 'custom', [
          'rule' => function($value, $context) {
            if($context['data']['time2'] == '00') {
              return false;
            }
            return false;
          },
          'message' => '入場時間は入力必須です'
        ]);

      $validator
        ->add('minute', 'custom', [
          'rule' => function($value, $context) {
            if($context['data']['minute'] == '00') {
              return false;
            }
            return true;
          },
          'message' => '入場時間は入力必須です'
        ]);

        $validator
            ->add('quantity', 'alphaNumeric1', [
                'rule' => ['alphaNumeric'],
                'message' => '所定勤務時間は入z力必須です'
            ]);

        // 退場時間
        $validator
          ->add('time2', 'custom', [
            'rule' => function($value, $context) {
              if($context['data']['time2'] == '-' || $context['data']['minute2'] == '-') {
                return false;
              }
              return true;
            },
            'message' => '退場時間は入力必須です'
          ]);
*/

/*
        $validator
          ->add('allowance', [
              'length' => [
                  'rule' => ['maxLength', '20'],
                  'message' => '手当等には200文字まで入力できます'
              ]
        ]);

        $validator
          ->add('note', [
              'length' => [
                  'rule' => ['maxLength', '20'],
                  'message' => '備考には200文字まで入力できます'
              ]
        ]);

        $validator
          ->add('remaining', [
              'length' => [
                  'rule' => ['maxLength', '20'],
                  'message' => '残工事には200文字まで入力できます'
              ]
        ]);
*/
        return $validator;
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
            ->allowEmpty('user_id');

        $validator
            ->allowEmpty('project_id');

        $validator
            ->allowEmpty('company_id');

        $validator
            ->allowEmpty('company_name');

        $validator
          //  ->requirePresence('project_name', 'create')
//          ->notEmpty('project_name');
          ->allowEmpty('project_name');

        $validator
            ->allowEmpty('client');

        $validator
            //    ->time('start_time')
            ->allowEmpty('work_date');

        $validator
        //    ->time('start_time')
            ->allowEmpty('start_time');

        $validator
      //      ->time('end_time')
            ->allowEmpty('end_time');

        $validator
    //        ->integer('pay_vacation')
            ->allowEmpty('salaried');

        $validator
  //          ->integer('holiday_work')
            ->allowEmpty('holiday_work');

        $validator
  //          ->integer('other_work')
            ->allowEmpty('other_work');

        $validator
            ->allowEmpty('materials');

        $validator
            ->allowEmpty('amount');

        $validator
            ->allowEmpty('allowance');

        $validator
            ->allowEmpty('note');

        $validator
            ->allowEmpty('remeining');

        $validator
            ->allowEmpty('created_user');

        $validator
            ->allowEmpty('modified_user');

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
    //    $rules->add($rules->existsIn(['user_id'], 'Users'));
      //    $rules->add($rules->existsIn(['project_id'], 'Projects'));
      //    $rules->add($rules->existsIn(['user_id'], 'Users'));
    //      $rules->add($rules->existsIn(['project_id'], 'ProjectsUsers'));

          return $rules;
    }
}
