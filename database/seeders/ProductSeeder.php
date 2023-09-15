<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();
        Product::factory()
            // ->has(
            //     Sku::factory()
            //         ->hasAttached(Feature::factory()->count(1), ['value' => '1'])
            //         ->count(3)
            // )
            ->count(5)
            ->create();

        // Product::factory(1)
        //     ->sequence(fn ($sequence) => ['brand_id' => $brands->random(1)->first()->id])
        //     ->hasAttached($categories->random(rand(3, 6)), ['created_at' => now(), 'updated_at' => now()])
        //     ->create();
    }
}
