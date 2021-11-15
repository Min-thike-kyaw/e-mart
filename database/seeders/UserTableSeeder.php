<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //admin
            [
                'fullname' => 'Eren Yaegar',
                'username' => 'Eren',
                'email' => 'eren@gmail.com',
                'password'=> Hash::make(1111),
                'role' => 'admin',
                'status' => 'active'
            ],
            //vendor
            [
                'fullname' => 'Yagami Light',
                'username' => 'Light',
                'email' => 'light@gmail.com',
                'password'=> Hash::make(1111),
                'role' => 'vendor',
                'status' => 'active'
            ],
            //customer
            [
                'fullname' => 'Mikasa Ackerman',
                'username' => 'Mikasa',
                'email' => 'mikasa@gmail.com',
                'password'=> Hash::make(1111),
                'role' => 'customer',
                'status' => 'active'
            ],
        ]);
    }
}
