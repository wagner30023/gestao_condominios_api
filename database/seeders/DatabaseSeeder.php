<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // $lastUser = User::find(1);

        Db::table('units')->insert([
            'name' => 'APT 100',
            'id_owner' => 1
        ]);

        Db::table('units')->insert([
            'name' => 'APT 101',
            'id_owner' => 1
        ]);

        Db::table('units')->insert([
            'name' => 'APT 200',
            'id_owner' => ''
        ]);

        Db::table('units')->insert([
            'name' => 'APT 201',
            'id_owner' => ''
        ]);

        Db::table('areas')->insert([
            'allowed' => '1',
            'cover' => 'gyn.jpg',
            'title' => 'Academia',
            'days' => '1,2,4,5',
            'start_time' => '06:00:00',
            'end_time' => '22:00:00'
        ]);

        Db::table('areas')->insert([
            'allowed' => '1',
            'title' => 'Piscina',
            'cover' => 'pool.jpg',
            'days' => '1,2,3,4,5',
            'start_time' => '07:00:00',
            'end_time' => '23:00:00'
        ]);

        Db::table('areas')->insert([
            'allowed' => '1',
            'title' => 'Churrasqueira',
            'cover' => 'barbecue.jpg',
            'days' => '4,5,6',
            'start_time' => '09:00:00',
            'end_time' => '23:00:00'
        ]);

        Db::table('walls')->insert([
            'title' => 'Titulo de aviso de teste',
            'body'  => 'Lorem ipsum dolor sit amet, consectetur adipis',
            'datecreated' => '2020-12-20 15:00:00'
        ]);

        Db::table('walls')->insert([
            'title' => 'Alerta geral para todos',
            'body'  => 'Cuidado, Lorem ipsum dolor sit amet, consectetur adipis',
            'datecreated' => '2020-12-20 18:00:00'
        ]);
    }
}
