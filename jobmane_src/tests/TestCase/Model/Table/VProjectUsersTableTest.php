<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VProjectUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VProjectUsersTable Test Case
 */
class VProjectUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VProjectUsersTable
     */
    public $VProjectUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.v_project_users',
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
        $config = TableRegistry::exists('VProjectUsers') ? [] : ['className' => 'App\Model\Table\VProjectUsersTable'];
        $this->VProjectUsers = TableRegistry::get('VProjectUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VProjectUsers);

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
