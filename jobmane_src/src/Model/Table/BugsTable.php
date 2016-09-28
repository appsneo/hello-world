<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bugs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $WrUsers
 * @property \Cake\ORM\Association\BelongsTo $UpUsers
 *
 * @method \App\Model\Entity\Bug get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bug newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bug[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bug|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bug patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bug[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bug findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BugsTable extends Table
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

        $this->table('bugs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'wr_user_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'up_user_id'
        ]);
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
            ->dateTime('wr_date')
            ->allowEmpty('wr_date');

        $validator
            ->dateTime('up_date')
            ->allowEmpty('up_date');

        $validator
            ->allowEmpty('wr_note');

        $validator
            ->allowEmpty('up_note');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('created_user');

        $validator
            ->allowEmpty('modified_user');

        $validator
            ->allowEmpty('image');

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
        $rules->add($rules->existsIn(['wr_user_id'], 'WrUsers'));
        $rules->add($rules->existsIn(['up_user_id'], 'UpUsers'));

        return $rules;
    }
}
