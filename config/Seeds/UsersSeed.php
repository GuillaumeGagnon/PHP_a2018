<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'id' => '6',
                'email' => 'admin@admin.com',
                'role' => '2',
                'password' => '$2y$10$Z8v3k4rjJTt.LDhuXqznh.gjoJvFfZcp/GVq5JgIEDHh3FajXHKfOÔÅÄ',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => '12',
                'email' => '123@123.ru',
                'role' => '2',
                'password' => '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',
                'created' => NULL,
                'modified' => '2018-10-12 01:18:15',
            ],
            [
                'id' => '13',
                'email' => 'admin@me.com',
                'role' => '1',
                'password' => '1234',
                'created' => '2018-10-11 23:37:09',
                'modified' => '2018-10-11 23:37:09',
            ],
            [
                'id' => '16',
                'email' => 'qwe@qwe.qwe',
                'role' => '1',
                'password' => '123',
                'created' => '2018-10-11 23:39:33',
                'modified' => '2018-10-12 01:14:09',
            ],
            [
                'id' => '17',
                'email' => 'ewq@ewq.com',
                'role' => '2',
                'password' => '123',
                'created' => '2018-10-11 23:40:10',
                'modified' => '2018-10-12 01:13:45',
            ],
            [
                'id' => '18',
                'email' => '123@admin.admin',
                'role' => '2',
                'password' => '$2y$10$6J4pnGptylXmSjtKplRt2uN8O8SUHSHPdEhsIuyDdnbbKe7svI59.',
                'created' => '2018-10-11 23:44:03',
                'modified' => '2018-10-11 23:44:03',
            ],
            [
                'id' => '19',
                'email' => 'gaguifire@hotmail.ca',
                'role' => '1',
                'password' => '$2y$10$ogK7ULUmq3ecvHVoGpMqdOoCUyB4GHgILAQQaqvdJZch8Jei56C2m',
                'created' => '2018-10-12 00:12:40',
                'modified' => '2018-10-12 01:18:34',
            ],
            [
                'id' => '24',
                'email' => '123@soleil.lune',
                'role' => '1',
                'password' => '$2y$10$4hIYwON8iJA.EWhaKGHyW.uNxy7tucwNvVoi6Udgv2Qpz/oPxWmPG',
                'created' => '2018-10-12 00:22:57',
                'modified' => '2018-10-12 00:22:57',
            ],
            [
                'id' => '28',
                'email' => 'dernier@test.pls',
                'role' => '1',
                'password' => '$2y$10$guG17yK50hM.zxVqIHQoL.22v3gAwNSNROmz8s.fZUna2YcPYVti6',
                'created' => '2018-10-12 00:44:31',
                'modified' => '2018-10-12 00:44:31',
            ],
            [
                'id' => '29',
                'email' => 'final_test_admin@efef.com',
                'role' => '2',
                'password' => '$2y$10$AdzJZyg55VwqipFQdxIchuC0V91Wj8nxUWBKELbwro/LK4BwX15yC',
                'created' => '2018-10-12 01:02:53',
                'modified' => '2018-10-12 01:02:53',
            ],
            [
                'id' => '30',
                'email' => 'final_test_member@efef.com',
                'role' => '1',
                'password' => '$2y$10$EI5hFRWvvJ6zRHdBEEZXXOvI/mvouPrOzLNtdZSn0ScDf8i7oxwYu',
                'created' => '2018-10-12 01:03:10',
                'modified' => '2018-10-12 01:03:10',
            ],
            [
                'id' => '31',
                'email' => 'test_new_logged_as_member@g.com',
                'role' => '1',
                'password' => '$2y$10$A/aImmEeu4SHpyUfnp9L.OX.yZyyTQhnhKMp6Czh.2SDes.dD2PUW',
                'created' => '2018-10-12 01:06:40',
                'modified' => '2018-10-12 01:06:40',
            ],
            [
                'id' => '32',
                'email' => 'test@123.com',
                'role' => '1',
                'password' => '$2y$10$xWPJ8Fi5REsOtTWu3FXyjORd5hzPCclJc8/ObRR6VgMx7ZQtcXeGe',
                'created' => '2018-10-12 01:20:32',
                'modified' => '2018-10-12 01:20:32',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
