<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string $num
 * @property string $secondar
 * @property string $project_name
 * @property string $sub-title
 * @property string $money
 * @property string $start
 * @property string $end
 * @property string $address
 * @property string $summary
 * @property string $charge
 * @property string $workers
 * @property string $memo
 * @property string $select_file
 * @property string $completino_check
 * @property string $created_user
 * @property string $modified_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\AssingWorker[] $assing_workers
 * @property \App\Model\Entity\ProjectPeriod[] $project_period
 * @property \App\Model\Entity\ProjectWorker[] $project_workers
 */
class Project extends Entity
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
//    protected $_hidden = [
//        'drawing'
//    ];
}
