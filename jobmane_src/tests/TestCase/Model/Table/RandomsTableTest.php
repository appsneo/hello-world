<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RandomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RandomsTable Test Case
 */
class RandomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RandomsTable
     */
    public $Randoms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.randoms',
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
        $config = TableRegistry::exists('Randoms') ? [] : ['className' => 'App\Model\Table\RandomsTable'];
        $this->Randoms = TableRegistry::get('Randoms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Randoms);

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
