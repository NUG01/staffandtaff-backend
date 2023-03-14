<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\Role;
use App\Models\Admin;
use App\Models\Industry;
use App\Models\Talent;
use App\Models\User;
use Database\Factories\IndustryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Industry::factory()->createPositions();

        User::create([
            'name' => 'admin',
            'email' => 'admin@staffandtaff.ch',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'verification_code' => sha1(time()),
            'role_id' => Role::ADMIN,
        ]);
    }
}
