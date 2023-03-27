<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\Role;
use App\Models\Admin;
use App\Models\Establishment;
use App\Models\Industry;
use App\Models\Talent;
use App\Models\User;
use Database\Factories\IndustryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Geolocation;
use App\Models\Job;

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

        //        \App\Models\User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);

        Industry::factory()->createPositions();

        User::create([
            'name' => 'admin',
            'email' => 'admin@staffandtaff.ch',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'verification_code' => sha1(time()),
            'role_id' => Role::ADMIN,
        ]);
        DB::unprepared(file_get_contents(__DIR__ . '/HRtable.sql'));
//        DB::unprepared(file_get_contents(__DIR__ . '/FRtable.sql'));
//        DB::unprepared(file_get_contents(__DIR__ . '/HR&FRtable.sql'));
        for ($i = 1; $i < 10; $i++) {
            $city = Geolocation::where('id', $i)->first();
            Job::create([
                'establishment_id' => $i % 2 == 1 ? 1 : 2,
                'position' => 'ok',
                'salary' => 200,
                'salary_type' => $i,
                'currency' => 'EU',
                'type_of_contract' => $i,
                'type_of_attendance' => $i,
                'period_type' => $i,
                'period' => 'year',
                'availability' => $i,
                'description' => 'text',
                'start_date' => now(),
                'end_date' => now(),
                'country_code' => $city->country_code,
                'city_name' => $city->city_name,
                'longitude' => $city->longitude,
                'latitude' => $city->latitude,
            ]);
            Establishment::create([
                'id' => $i,
                'logo' => 'logo',
                'name' => 'establishment_name',
                'company_name' => 'company_name',
                'country' => 1,
                'city' => 1,
                'address' => 'address',
                'industry' => 1,
                'number_of_employees' => 2,
                'description' => 'description',

            ]);
        }
    }
}
