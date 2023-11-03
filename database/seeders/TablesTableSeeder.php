<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            [
                'name' => 'Bàn 1',
                'seats' => 4,
                'status' => true,
                'area_id' => 1,
            ],
            [
                'name' => 'Bàn 2',
                'seats' => 4,
                'status' => true,
                'area_id' => 1,
            ],
            [
                'name' => 'Bàn 3',
                'seats' => 4,
                'status' => true,
                'area_id' => 1,
            ],
            [
                'name' => 'Bàn 4',
                'seats' => 4,
                'status' => true,
                'area_id' => 1,
            ],
            [
                'name' => 'Bàn 5',
                'seats' => 4,
                'status' => true,
                'area_id' => 1,
            ],
            [
                'name' => 'Bàn 1',
                'seats' => 4,
                'status' => true,
                'area_id' => 2,
            ],
            [
                'name' => 'Bàn 2',
                'seats' => 4,
                'status' => true,
                'area_id' => 2,
            ],
            [
                'name' => 'Bàn 3',
                'seats' => 4,
                'status' => true,
                'area_id' => 2,
            ],
            [
                'name' => 'Bàn 4',
                'seats' => 4,
                'status' => true,
                'area_id' => 2,
            ],
            [
                'name' => 'Bàn 5',
                'seats' => 4,
                'status' => true,
                'area_id' => 2,
            ],
            [
                'name' => 'Bàn 1',
                'seats' => 4,
                'status' => true,
                'area_id' => 3,
            ],
            [
                'name' => 'Bàn 2',
                'seats' => 4,
                'status' => true,
                'area_id' => 3,
            ],
            [
                'name' => 'Bàn 3',
                'seats' => 4,
                'status' => true,
                'area_id' => 3,
            ],
            [
                'name' => 'Bàn 4',
                'seats' => 4,
                'status' => true,
                'area_id' => 3,
            ],
            [
                'name' => 'Bàn 5',
                'seats' => 4,
                'status' => true,
                'area_id' => 3,
            ],
        ]);
    }
}
