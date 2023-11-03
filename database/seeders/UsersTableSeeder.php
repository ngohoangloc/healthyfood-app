<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullName' => 'Admin',
            'address' => 'Ninh Kiều, TP. Cần Thơ',
            'phone' => '0886992212',
            'account_id' => 1,
            'role_id' => 1,
        ]);
    }
}
