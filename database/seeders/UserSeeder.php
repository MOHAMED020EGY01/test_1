<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([ // Create_at Updata_at => بيتعمل بشكل اوتوماتيكي
            'name' => 'ahmed',
            'email' => 'M5e5o@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '0123456789',
            'role' => 'user',
        ]);

        DB::table('users')->insert([// Create_at Updata_at => مش بيتعمل هنا 
            'name' => 'hatem',
            'email' => 'hatem@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '0153456789',
            'role' => 'user',
        ]);
    }
}
