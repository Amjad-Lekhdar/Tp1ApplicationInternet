<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Schedules Model
 *
 * @method \App\Model\Entity\Schedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\Schedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Schedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Schedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule findOrCreate($search, callable $callback = null, $options = [])
 */
class SchedulesTable extends Table
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
        $this->addBehavior('Translate', ['fields' => ['Name_schedule','Schedule_Description']]);   
        $this->setTable('schedules');
        $this->setDisplayField('Schedule_ID');
        $this->setPrimaryKey('Schedule_ID');
        
        $this->addBehavior('Timestamp');
        
         $this->belongsTo('Employees', [
            'foreignKey' => 'Employee_ID',
            'joinType' => 'INNER',
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
            ->scalar('Name_schedule')
            ->maxLength('Name_schedule', 255)
            ->requirePresence('Name_schedule', 'create')
            ->notEmptyString('Name_schedule');

        $validator
            ->scalar('Schedule_Description')
            ->maxLength('Schedule_Description', 255)
            ->requirePresence('Schedule_Description', 'create')
            ->notEmptyString('Schedule_Description');

        $validator
            ->date('Schedule_End_Date_Time')
            ->requirePresence('Schedule_End_Date_Time', 'create')
            ->notEmptyDate('Schedule_End_Date_Time');

        $validator
            ->date('Schedule_Start_Date_Time')
            ->requirePresence('Schedule_Start_Date_Time', 'create')
            ->notEmptyDate('Schedule_Start_Date_Time');

        return $validator;
    }
    
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id'], 'Employees'));

        return $rules;
    }
}
