<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Voters;
use App\Utils\Utility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'name' => "NACOS FULafia Admin",
            'email' => "fulafianacos@gmail.com",
            'role' => Utility::ROLES['admin'],
            'password' => Hash::make("@NACOSFULafia2023"),
        ]);
    }
}
