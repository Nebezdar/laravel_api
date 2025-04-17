<?php

namespace Database\Factories;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EquipmentTypeFactory extends Factory
{
    protected $model = EquipmentType::class;

    public function definition(): array
    {
        return [
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'name' => $this->faker->name(),
        ];
    }
}
