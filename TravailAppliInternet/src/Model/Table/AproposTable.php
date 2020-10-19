<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Apropos Model
 *
 * @method \App\Model\Entity\Apropo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Apropo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Apropo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Apropo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apropo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apropo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Apropo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Apropo findOrCreate($search, callable $callback = null, $options = [])
 */
class AproposTable extends Table
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

        $this->setTable('apropos');
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
            ->integer('rien')
            ->requirePresence('rien', 'create')
            ->notEmptyString('rien');

        return $validator;
    }
}
