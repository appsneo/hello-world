<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BugsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BugsTable Test Case
 */
class BugsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BugsTable
     */
    public $Bugs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bugs',
        'app.wr_users',
        'app.up_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bugs') ? [] : ['className' => 'App\Model\Table\BugsTable'];
        $this->Bugs = TableRegistry::get('Bugs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bugs);

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
