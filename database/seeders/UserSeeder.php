<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->hasAddresses(1)
            ->create();

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$VulaUDAL8SWlNcZ5oq1P4O4pz7VVmQjNVO20DinS.c/16Nj3VpKwy', // asdfasdf
            'remember_token' => Str::random(10),
        ]);
    }
}
