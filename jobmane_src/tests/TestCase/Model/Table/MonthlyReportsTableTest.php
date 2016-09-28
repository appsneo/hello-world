<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonthlyReportsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonthlyReportsTable Test Case
 */
class MonthlyReportsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MonthlyReportsTable
     */
    public $MonthlyReports;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.monthly_reports',
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
        $config = TableRegistry::exists('MonthlyReports') ? [] : ['className' => 'App\Model\Table\MonthlyReportsTable'];
        $this->MonthlyReports = TableRegistry::get('MonthlyReports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MonthlyReports);

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
