<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'name' => 'Ngoài sân',
            ],
            [
                'name' => 'Tầng trệt',
            ],
            [
                'name' => 'Tầng 1',
            ],
        ]);
    }
}
