<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Localized\Validation\ValidationInterface;

/**
 * Passengers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TrainsTable|\Cake\ORM\Association\BelongsTo $Trains
 *
 * @method \App\Model\Entity\Passenger get($primaryKey, $options = [])
 * @method \App\Model\Entity\Passenger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Passenger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Passenger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Passenger|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Passenger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Passenger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Passenger findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PassengersTable extends Table
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

        $this->setTable('passengers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Trains', [
            'foreignKey' => 'train_id',
            'joinType' => 'INNER'
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmpty('address');
		
		/*
		// Ajoute le provider au validator
        $validator->setProvider('fr', 'Localized\Validation\FrValidation');
        // utilise le provider dans une règle de validation de champ
        $validator->add('phoneField', 'myCustomRuleNameForPhone', [
            'rule' => 'phone',
            'provider' => 'fr'
        ]);
		*/
        $validator
            ->scalar('phone')
			//->numerical('phone')
            ->maxLength('phone', 255)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');
			
			
		 $validator
			->requirePresence('phone', 'create')
			->notEmpty('phone')
			->add('phone', 'validFormat',[
                'rule' => array('custom', '^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$^'),
                'message' => 'Please enter a valid phone number.'
			]);
			
			
			/*
			 // Ajoute le provider au validator
        $validator->setProvider('us', 'Localized\Validation\UsValidation');
        // utilise le provider dans une règle de validation de champ
        $validator->add('phoneField', 'phone', [
            'rule' => 'phone',
            'provider' => 'us'
        ]);
			
		*/	
			
		
        

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['train_id'], 'Trains'));

        return $rules;
    }
}
