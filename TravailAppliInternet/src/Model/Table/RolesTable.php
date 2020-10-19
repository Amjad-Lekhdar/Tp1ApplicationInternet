<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\BelongsToMany $Employees
 *
 * @method \App\Model\Entity\Role get($primaryKey, $options = [])
 * @method \App\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Role findOrCreate($search, callable $callback = null, $options = [])
 */
class RolesTable extends Table
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

        $this->setTable('roles');
        $this->setDisplayField('Role_id');
        $this->setPrimaryKey('Role_id');
        
        $this->addBehavior('Translate', ['fields' => ['Role_Name','Role_Description']]);
        
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Employees', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'employee_id',
            'joinTable' => 'employees_roles',
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
            ->integer('Role_id')
            ->allowEmptyString('Role_id', null, 'create');

        $validator
            ->scalar('Role_Name')
            ->maxLength('Role_Name', 255)
            ->requirePresence('Role_Name', 'create')
            ->notEmptyString('Role_Name');

        $validator
            ->scalar('Role_Description')
            ->maxLength('Role_Description', 255)
            ->requirePresence('Role_Description', 'create')
            ->notEmptyString('Role_Description');

        return $validator;
    }
}
