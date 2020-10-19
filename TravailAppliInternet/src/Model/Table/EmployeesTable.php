<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;


/**
 * Employees Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FilesTable&\Cake\ORM\Association\BelongsToMany $Files
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsToMany $Roles
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Schedules', [
            'foreignKey' => 'Employee_ID',
        ]); 

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('files', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'employees_files',
        ]);
        $this->belongsToMany('roles', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'role_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('First_Name')
            ->maxLength('First_Name', 255)
            ->requirePresence('First_Name', 'create')
            ->notEmptyString('First_Name');

        $validator
            ->scalar('Last_Name')
            ->maxLength('Last_Name', 255)
            ->requirePresence('Last_Name', 'create')
            ->notEmptyString('Last_Name');

        $validator
            ->scalar('Gender')
            ->maxLength('Gender', 255)
            ->notEmptyString('Gender');

        $validator
            ->date('Date_Started_Employement')
            ->requirePresence('Date_Started_Employement', 'create')
            ->notEmptyDate('Date_Started_Employement');

        $validator
            ->date('Date_Left_Employement')
            ->requirePresence('Date_Left_Employement', 'create')
            ->notEmptyDate('Date_Left_Employement');

        /*
        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

       /* $validator
            ->boolean('published')
            ->allowEmptyString('published');
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
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->First_Name);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }
}
