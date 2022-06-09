<?php

namespace Database\Seeders;

use App\Models\EquipmentType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        EquipmentType::insert([
            [
                'name' => 'TP-Link TL-WR74',
                'mask' => 'XXAAAAAXAA',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'D-Link DIR-300',
                'mask' => 'NXXAAXZXaa',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'D-Link DIR-300 S',
                'mask' => 'NXXAAXZXXX',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
