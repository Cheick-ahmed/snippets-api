<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrator',
            'username' => 'The administrator',
            'email' => 'administrator@snippets.com',
            'password' => Hash::make('admin_password'),
            'role' => 'admin'
        ]);
    }
}
