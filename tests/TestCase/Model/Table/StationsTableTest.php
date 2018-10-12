<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StationsTable Test Case
 */
class StationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StationsTable
     */
    public $Stations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Stations') ? [] : ['className' => StationsTable::class];
        $this->Stations = TableRegistry::getTableLocator()->get('Stations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stations);

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
