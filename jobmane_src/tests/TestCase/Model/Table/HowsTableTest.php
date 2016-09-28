<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HowsTable Test Case
 */
class HowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HowsTable
     */
    public $Hows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Hows') ? [] : ['className' => 'App\Model\Table\HowsTable'];
        $this->Hows = TableRegistry::get('Hows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Hows);

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
}
