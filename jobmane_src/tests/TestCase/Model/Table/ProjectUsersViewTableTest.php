<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectUsersViewTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectUsersViewTable Test Case
 */
class ProjectUsersViewTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectUsersViewTable
     */
    public $ProjectUsersView;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_users_view',
        'app.companies',
        'app.projects',
        'app.project_periods',
        'app.project_users',
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
        $config = TableRegistry::exists('ProjectUsersView') ? [] : ['className' => 'App\Model\Table\ProjectUsersViewTable'];
        $this->ProjectUsersView = TableRegistry::get('ProjectUsersView', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectUsersView);

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
