<?php
use Migrations\AbstractSeed;

/**
 * Trains seed.
 */
class TrainsSeed extends AbstractSeed
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
                'id' => '18',
                'name' => 'TGV',
                'origin_station' => '10',
                'final_station' => '12',
                'private' => '0',
                'created' => '2018-10-12 02:19:40',
                'modified' => '2018-10-12 02:19:40',
            ],
            [
                'id' => '19',
                'name' => 'MailExpress',
                'origin_station' => '12',
                'final_station' => '10',
                'private' => '1',
                'created' => '2018-10-12 02:20:04',
                'modified' => '2018-10-12 02:20:04',
            ],
            [
                'id' => '20',
                'name' => 'Royal_Mark_V',
                'origin_station' => '11',
                'final_station' => '12',
                'private' => '1',
                'created' => '2018-10-12 02:20:47',
                'modified' => '2018-10-12 02:20:47',
            ],
        ];

        $table = $this->table('trains');
        $table->insert($data)->save();
    }
}
