<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $First_Name
 * @property string $Last_Name
 * @property string $Gender
 * @property \Cake\I18n\FrozenDate $Date_Started_Employement
 * @property \Cake\I18n\FrozenDate $Date_Left_Employement
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 * @property string $slug
 * @property bool|null $published
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Schedule[] $schedules
 * @property \App\Model\Entity\Role[] $roles
 * @property \App\Model\Entity\File[] $files
 */
class Employee extends Entity
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
        'First_Name' => true,
        'Last_Name' => true,
        'Gender' => true,
        'Date_Started_Employement' => true,
        'Date_Left_Employement' => true,
        'user_id' => true,
        'modified' => true,
        'created' => true,
        'slug' => true,
        'published' => true,
        'user' => true,
        'schedules' => true,
        'roles' => true,
        'files' => true,
    ];
}
