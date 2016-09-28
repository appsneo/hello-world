<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectUsersView Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ProjectUsersView get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectUsersView newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectUsersView[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUsersView|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectUsersView patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUsersView[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUsersView findOrCreate($search, callable $callback = null)
 */
class ProjectUsersViewTable extends Table
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

        $this->table('project_users_view');

//        $this->belongsTo('Companies', [
//            'foreignKey' => 'company_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('Projects', [
//            'foreignKey' => 'project_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('Users', [
//            'foreignKey' => 'user_id',
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
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('user_name');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
