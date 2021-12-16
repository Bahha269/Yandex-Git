<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = new \App\Models\User();
        $u1->name = "Alice";
        $u1->email = 'alice@gmail.com';
        $u1->email_verified_at = date('Y-m-d H:i:s');
        $u1->password = \Hash::make("alice");
        $u1->save();

        $u2 = new \App\Models\User();
        $u2->name = "Bob";
        $u2->email = 'bob@gmail.com';
        $u2->email_verified_at = date('Y-m-d H:i:s');
        $u2->password = \Hash::make("bob");
        $u2->save();
    }
}
