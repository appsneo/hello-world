<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectUsersView Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $project_id
 * @property int $user_id
 * @property string $user_name
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\User $user
 */
class ProjectUsersView extends Entity
{

}
