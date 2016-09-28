<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users001 Model
 *
 * @method \App\Model\Entity\Users001 get($primaryKey, $options = [])
 * @method \App\Model\Entity\Users001 newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Users001[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Users001|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Users001 patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Users001[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Users001 findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class Users001Table extends Table
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

        $this->table('users001');
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
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('blood_type');

        $validator
            ->date('medical_checked_date')
            ->allowEmpty('medical_checked_date');

        $validator
            ->date('joined_date')
            ->allowEmpty('joined_date');

        $validator
            ->date('leaving_date')
            ->allowEmpty('leaving_date');

        $validator
            ->date('birth_date')
            ->allowEmpty('birth_date');

        $validator
            ->allowEmpty('emergency');

        $validator
            ->allowEmpty('capbilities');

        $validator
            ->allowEmpty('safety');

        $validator
            ->allowEmpty('created_user');

        $validator
            ->allowEmpty('modified_user');

        $validator
            ->allowEmpty('avatar');

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
