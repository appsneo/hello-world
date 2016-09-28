<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectPeriodTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectPeriodTable Test Case
 */
class ProjectPeriodTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectPeriodTable
     */
    public $ProjectPeriod;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_period',
        'app.projects',
        'app.assing_workers',
        'app.project_workers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectPeriod') ? [] : ['className' => 'App\Model\Table\ProjectPeriodTable'];
        $this->ProjectPeriod = TableRegistry::get('ProjectPeriod', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectPeriod);

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
