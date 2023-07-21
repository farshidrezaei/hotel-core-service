<?php

namespace Database\Factories;

use App\Models\specialProperty;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class specialPropertyFactory extends Factory
{
    protected $model = specialProperty::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
