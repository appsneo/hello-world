<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Users001Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Users001Table Test Case
 */
class Users001TableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Users001Table
     */
    public $Users001;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users001'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users001') ? [] : ['className' => 'App\Model\Table\Users001Table'];
        $this->Users001 = TableRegistry::get('Users001', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users001);

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
