<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StationTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StationTypesTable Test Case
 */
class StationTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StationTypesTable
     */
    public $StationTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.station_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StationTypes') ? [] : ['className' => StationTypesTable::class];
        $this->StationTypes = TableRegistry::getTableLocator()->get('StationTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StationTypes);

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
