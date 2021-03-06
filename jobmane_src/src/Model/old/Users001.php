<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Users001 Entity
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $status
 * @property string $blood_type
 * @property \Cake\I18n\Time $medical_checked_date
 * @property \Cake\I18n\Time $joined_date
 * @property \Cake\I18n\Time $leaving_date
 * @property \Cake\I18n\Time $birth_date
 * @property string $emergency
 * @property string $capbilities
 * @property string $safety
 * @property string $created_user
 * @property string $modified_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string|resource $avatar
 */
class Users001 extends Entity
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
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
