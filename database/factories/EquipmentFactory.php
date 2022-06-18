<?php

namespace Database\Factories;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $equipmentType = EquipmentType::inRandomOrder()->first();

        return [
            'equipment_type_id' => $equipmentType->id,
            'serial_number' => $this->faker->regexify($equipmentType->convertMask()),
            'notes' => $this->faker->randomDigit() > 7 ? $this->faker->sentence() : null,
        ];
    }
}
