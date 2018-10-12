<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrainsFixture
 *
 */
class TrainsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 191, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'origin_station' => ['type' => 'string', 'length' => 191, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'final_station' => ['type' => 'string', 'length' => 191, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'private' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'origin_station_key' => ['type' => 'index', 'columns' => ['origin_station'], 'length' => []],
            'final_station_key' => ['type' => 'index', 'columns' => ['final_station'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'name' => ['type' => 'unique', 'columns' => ['name'], 'length' => []],
            'trains_ibfk_1' => ['type' => 'foreign', 'columns' => ['origin_station'], 'references' => ['stations', 'name'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'trains_ibfk_2' => ['type' => 'foreign', 'columns' => ['final_station'], 'references' => ['stations', 'name'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'origin_station' => 'Lorem ipsum dolor sit amet',
                'final_station' => 'Lorem ipsum dolor sit amet',
                'private' => 1,
                'created' => '2018-10-05 13:22:52',
                'modified' => '2018-10-05 13:22:52'
            ],
        ];
        parent::init();
    }
}
