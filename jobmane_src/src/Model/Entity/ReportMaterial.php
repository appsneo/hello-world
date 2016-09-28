<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReportMaterial Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $report_id
 * @property int $material_id
 * @property int $quantity
 * @property string $created_user
 * @property string $modified_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Report $report
 * @property \App\Model\Entity\Material $material
 */
class ReportMaterial extends Entity
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
        'id' => true
    ];
}
