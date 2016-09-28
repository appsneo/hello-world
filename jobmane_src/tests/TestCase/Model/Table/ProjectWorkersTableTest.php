<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectWorkersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectWorkersTable Test Case
 */
class ProjectWorkersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectWorkersTable
     */
    public $ProjectWorkers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_workers',
        'app.projects',
        'app.assing_workers',
        'app.project_period',
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
        $config = TableRegistry::exists('ProjectWorkers') ? [] : ['className' => 'App\Model\Table\ProjectWorkersTable'];
        $this->ProjectWorkers = TableRegistry::get('ProjectWorkers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectWorkers);

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
