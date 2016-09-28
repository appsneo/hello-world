<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectPeriodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectPeriodsTable Test Case
 */
class ProjectPeriodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectPeriodsTable
     */
    public $ProjectPeriods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_periods',
        'app.companies',
        'app.projects',
        'app.assing_workers',
        'app.project_period',
        'app.project_workers',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectPeriods') ? [] : ['className' => 'App\Model\Table\ProjectPeriodsTable'];
        $this->ProjectPeriods = TableRegistry::get('ProjectPeriods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectPeriods);

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
