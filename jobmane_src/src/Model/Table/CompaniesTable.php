<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
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

        $this->table('companies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('post');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('fax');

        $validator
//            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('createuser');

        $validator
            ->allowEmpty('modifieduser');

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
        //        <li>会社名は入力必須です</li>
        //        <li>所定勤務時間は入力必須です</li>
        //        <li>早出手当は入力必須です</li>
        //        <li>残業手当は入力必須です</li>

        $validator
            ->requirePresence('user_idx', 'create', 'need ID')
            ->requirePresence('passwordx', 'create', 'need Password');

            $validator
            ->notEmpty('company_name' ,'会社名は入力必須です');

            $validator
            ->add('time1', 'validValue', [
                        'rule' => ['range', 0, 23],
                        'message' => '所定勤務時間は入力必須です',
                    ]);
            $validator
            ->add('rest_minutes', 'validValue', [
                        'rule' => ['range', 0, 200],
                        'message' => '所定勤務時間は入力必須です',
                    ]);

            $validator
            ->notEmpty('user_id' ,'empty UserId (COM)!!')
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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
