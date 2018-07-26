<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'super@gmail.com',
            'password' => bcrypt('123456'),
            'is_admin' => 1,
            'is_active' => 1
        ]);
    }
}
