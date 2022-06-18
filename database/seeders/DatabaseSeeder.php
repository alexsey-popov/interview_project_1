<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Equipment::truncate();
        EquipmentType::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call(
            [
                EquipmentTypeSeeder::class,
                EquipmentSeeder::class,
            ]
        );
        // \App\Models\User::factory(10)->create();
    }
}
