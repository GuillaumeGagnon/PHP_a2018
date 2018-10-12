<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainsTable Test Case
 */
class TrainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainsTable
     */
    public $Trains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trains'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Trains') ? [] : ['className' => TrainsTable::class];
        $this->Trains = TableRegistry::getTableLocator()->get('Trains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Trains);

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
