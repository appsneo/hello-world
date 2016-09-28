<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfirmedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfirmedTable Test Case
 */
class ConfirmedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfirmedTable
     */
    public $Confirmed;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.confirmed',
        'app.users',
        'app.confirmeds'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Confirmed') ? [] : ['className' => 'App\Model\Table\ConfirmedTable'];
        $this->Confirmed = TableRegistry::get('Confirmed', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Confirmed);

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
