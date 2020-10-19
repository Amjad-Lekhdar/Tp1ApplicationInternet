<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $Schedule_ID
 * @property int $Employee_ID
 
 * @property string $Name_schedule
 * @property string $Schedule_Description
 * @property \Cake\I18n\FrozenDate $Schedule_End_Date_Time
 * @property \Cake\I18n\FrozenDate $Schedule_Start_Date_Time
 */
class Schedule extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        //'Employee_ID' => true,
        
        'Name_schedule' => true,
        'Schedule_Description' => true,
        'Schedule_End_Date_Time' => true,
        'Schedule_Start_Date_Time' => true,
        'created' => true,
        'modified' => true,
        'employee' => true,
    ];
}
