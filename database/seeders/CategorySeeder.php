<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::factory()
            ->create([
                'name' => 'Bandas',
                'description' => 'Organiza conteúdo pelas bandas',
                'position' => 1
            ]);

        Category::factory()
            ->create([
                'name' => 'Bonés',
                'description' => 'Categoria de bonés',
                'position' => 3
            ]);
        Category::factory()
            ->create([
                'name' => 'Masculino',
                'description' => 'Categoria de conteúdo masculino',
                'position' => 4
            ]);
        Category::factory()
            ->create([
                'name' => 'Feminino',
                'description' => 'Categoria de conteúdo feminino',
                'position' => 5
            ]);
        Category::factory()
            ->create([
                'name' => 'Infantil',
                'description' => 'Categoria de conteúdo infantil',
                'position' => 6
            ]);
        Category::factory()
            ->create([
                'name' => 'Livraria',
                'description' => 'Categoria de conteúdo livraria',
                'position' => 7
            ]);
    }
}
