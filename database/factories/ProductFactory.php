<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'brand_id' => Brand::inRandomOrder()->first()->id,
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'sort_description' => $this->faker->realText(),
            'description' => $this->faker->realText(),
            'is_enabled' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
