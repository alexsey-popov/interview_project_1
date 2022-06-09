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
        EquipmentType::factory()->createMany([
            [
                'name' => 'TP-Link TL-WR74',
                'mask' => 'XXAAAAAXAA',
            ],
            [
                'name' => 'D-Link DIR-300',
                'mask' => 'NXXAAXZXaa',
            ],
            [
                'name' => 'D-Link DIR-300 S',
                'mask' => 'NXXAAXZXXX',
            ],
        ]);
    }
}
