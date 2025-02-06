<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Store::factory()->count(10)->create();
        User::factory()->count(10)->create();
        Category::factory()->count(40)->create();
        Product::factory()->count(100)->create();

        // $this->call(UserSeeder::class);
        //! RUN => php artisan db:seed
    }
}
