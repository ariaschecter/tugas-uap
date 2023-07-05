<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SwitchUtil;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Yuda',
            'email' => 'yuda@gmail.com',
            'role' => 'admin'
        ]);
        SwitchUtil::factory()->create([
            'switch' => 0,
        ]);
    }
}
