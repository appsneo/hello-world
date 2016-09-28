<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
/**
 * User Entity
 *
 * @property int $id
 * @property string $companyid
 * @property \Cake\I18n\Time $birthday
 * @property string $boad
 * @property string $password
 * @property string $photo
 * @property \Cake\I18n\Time $kensin
 * @property \Cake\I18n\Time $indate
 * @property \Cake\I18n\Time $outdate
 * @property string $phonenumber
 * @property string $smartphone
 * @property string $email
 * @property string $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class User extends Entity
{
    protected function _setPassword($password)
    {
      return (new DefaultPasswordHasher)->hash($password);
    }

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
        'id' => false,
        'image' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password', 'image'
    ];
}
