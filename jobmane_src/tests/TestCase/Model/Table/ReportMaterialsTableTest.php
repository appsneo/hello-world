<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReportMaterialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReportMaterialsTable Test Case
 */
class ReportMaterialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReportMaterialsTable
     */
    public $ReportMaterials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.report_materials',
        'app.companies',
        'app.reports',
        'app.users',
        'app.projects_users',
        'app.projects',
        'app.assing_workers',
        'app.project_period',
        'app.project_workers',
        'app.materials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReportMaterials') ? [] : ['className' => 'App\Model\Table\ReportMaterialsTable'];
        $this->ReportMaterials = TableRegistry::get('ReportMaterials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReportMaterials);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
