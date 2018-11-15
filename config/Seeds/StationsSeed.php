<?php
use Migrations\AbstractSeed;

/**
 * Stations seed.
 */
class StationsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '10',
                'name' => 'Cartier',
                'type' => '1',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => '11',
                'name' => 'Rosemont',
                'type' => '1',
                'created' => NULL,
                'modified' => '2018-10-12 02:01:11',
            ],
            [
                'id' => '12',
                'name' => 'Valcartier',
                'type' => '3',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => '16',
                'name' => 'test_civile',
                'type' => '1',
                'created' => '2018-10-12 01:51:58',
                'modified' => '2018-10-12 01:51:58',
            ],
            [
                'id' => '17',
                'name' => 'test_industrielle',
                'type' => '2',
                'created' => '2018-10-12 01:52:14',
                'modified' => '2018-10-12 01:52:14',
            ],
            [
                'id' => '18',
                'name' => 'test_militaire',
                'type' => '3',
                'created' => '2018-10-12 01:52:32',
                'modified' => '2018-10-12 01:52:32',
            ],
            [
                'id' => '19',
                'name' => 'test_',
                'type' => '1',
                'created' => '2018-10-12 01:59:35',
                'modified' => '2018-10-12 01:59:47',
            ],
        ];

        $table = $this->table('stations');
        $table->insert($data)->save();
    }
}
