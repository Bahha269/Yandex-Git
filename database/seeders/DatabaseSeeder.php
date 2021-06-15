<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        \App\Models\Post::factory(10)->create();
        DB::table('users')->insert([
            [ 'name' => 'Admin', 'email' => 'admin@email.net', 'password' => bcrypt('password'), 'admin' => 1]
        ]);
    }
}
