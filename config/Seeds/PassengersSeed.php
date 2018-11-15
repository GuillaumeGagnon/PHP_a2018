<?php
use Migrations\AbstractSeed;

/**
 * Passengers seed.
 */
class PassengersSeed extends AbstractSeed
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
                'user_id' => '19',
                'train_id' => '19',
                'name' => 'Guillaume Gagnon',
                'address' => '6720 Rue Rivière',
                'phone' => '450-123-1234',
                'other' => 'test_member',
                'created' => '2018-10-12 02:21:57',
                'modified' => '2018-10-12 02:21:57',
            ],
            [
                'id' => '2',
                'user_id' => '18',
                'train_id' => '18',
                'name' => 'Guillaume Gagnon',
                'address' => '6720 Rue Rivière',
                'phone' => '450-123-1234',
                'other' => 'test_admin',
                'created' => '2018-10-12 02:22:01',
                'modified' => '2018-10-12 02:22:01',
            ],
            [
                'id' => '3',
                'user_id' => '18',
                'train_id' => '19',
                'name' => 'Daniel Latour',
                'address' => '1234 Chemin De L\'Échec',
                'phone' => '012-345-6789',
                'other' => '',
                'created' => '2018-10-12 02:23:03',
                'modified' => '2018-10-12 02:23:03',
            ],
            [
                'id' => '4',
                'user_id' => '19',
                'train_id' => '20',
                'name' => 'Yévite L\'Échec',
                'address' => '9876 Chemin De L\'Échec',
                'phone' => '987-654-3210',
                'other' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i',
                'created' => '2018-10-12 02:24:30',
                'modified' => '2018-10-12 02:24:30',
            ],
        ];

        $table = $this->table('passengers');
        $table->insert($data)->save();
    }
}
