<?php
use Migrations\AbstractSeed;

/**
 * StationTypes seed.
 */
class StationTypesSeed extends AbstractSeed
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
                'id' => '1',
                'type' => 'station_civile',
                'description' => 'Une station de train traditionnelle.',
                'created' => '2018-10-04 19:35:09',
                'modified' => '2018-10-12 02:04:03',
            ],
            [
                'id' => '2',
                'type' => 'station_industrielle',
                'description' => 'Une station de train destinée à l\'acheminement de marchandises industrielles.',
                'created' => '2018-10-04 19:34:59',
                'modified' => '2018-10-04 19:34:59',
            ],
            [
                'id' => '3',
                'type' => 'station_militaire',
                'description' => 'Une station créée à des fins d\'activités militaires.',
                'created' => '2018-10-04 19:35:20',
                'modified' => '2018-10-04 19:35:20',
            ],
            [
                'id' => '4',
                'type' => 'futur_station',
                'description' => 'Une station non-construite mais qui est prévue.',
                'created' => '2018-10-12 02:06:17',
                'modified' => '2018-10-12 02:06:17',
            ],
        ];

        $table = $this->table('station_types');
        $table->insert($data)->save();
    }
}
