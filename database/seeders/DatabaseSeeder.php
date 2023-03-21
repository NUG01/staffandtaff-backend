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
use Illuminate\Support\Facades\Storage;
use App\Models\Geolocation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(__DIR__ . '/HR&FRtable.sql'));


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






        $frenchCities = Storage::disk('local')->get('france.json');
        $switzCities = Storage::disk('local')->get('switzerland.json');

        if($frenchCities && $switzCities){
            $cities = json_encode(
                array_merge(
                    json_decode($frenchCities, true),
                    json_decode($switzCities, true)
                )
            );

            $cities = json_decode($cities, true);
            foreach ($cities as $key => $value) {
                // $city = $value['city'];
                // // $country = $value['country'];
                // $iso2 = $value['iso2'];
                // $lat = $value['lat'];
                // $lng = $value['lng'];

                DB::table('geolocations')->insert([
                    'country_code' => $value['iso2'],
                    'city_name' => $value['city'],
                    'latitude' => $value['lat'],
                    'longitude' => $value['lng'],
                ]);

        }


            // echo "Id: {$city}, Name: {$country}, code: {$iso2}, lat: {$lat}, lng: {$lng}";
            // echo $value['department'];
        }
    }
}
