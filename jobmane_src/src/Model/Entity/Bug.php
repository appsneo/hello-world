<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bug Entity
 *
 * @property int $id
 * @property string $wr_user_id
 * @property string $up_user_id
 * @property \Cake\I18n\Time $wr_date
 * @property \Cake\I18n\Time $up_date
 * @property string $wr_note
 * @property string $up_note
 * @property string $type
 * @property string $status
 * @property string $created_user
 * @property string $modified_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string|resource $image
 *
 * @property \App\Model\Entity\WrUser $wr_user
 * @property \App\Model\Entity\UpUser $up_user
 */
class Bug extends Entity
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
}
