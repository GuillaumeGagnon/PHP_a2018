<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Trains Model
 *
 * @property |\Cake\ORM\Association\HasMany $Passengers
 *
 * @method \App\Model\Entity\Train get($primaryKey, $options = [])
 * @method \App\Model\Entity\Train newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Train[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Train|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Train|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Train patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Train[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Train findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainsTable extends Table
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

        $this->setTable('trains');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		

        $this->hasMany('Passengers', [
            'foreignKey' => 'train_id'
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
            ->scalar('name')
            ->maxLength('name', 191)
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('origin_station')
            ->maxLength('origin_station', 191)
            ->requirePresence('origin_station', 'create')
            ->notEmpty('origin_station');

        $validator
            ->scalar('final_station')
            ->maxLength('final_station', 191)
            ->requirePresence('final_station', 'create')
            ->notEmpty('final_station');

        $validator
            ->boolean('private')
            ->allowEmpty('private');

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
