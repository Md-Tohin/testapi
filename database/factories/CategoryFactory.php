<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(8);        
        return [
            'code' => strtoupper($this->faker->unique()->lexify('??????')),
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => $this->faker->imageUrl(64, 64, 'cats', true, 'Faker'),
            'image' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            'description' => $this->faker->sentence,
            'discount' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
