<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Companie;
use App\Exchange;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Profile::truncate();




        $profile = Profile::create([
            'name' => $faker->sentence,
            'email' => $faker->email,
            'address' => $faker->address,
        ]);
/*
        $companie = Companie::create([
            'name' => $faker->sentence,
            'email' => $faker->email,
            'address' => $faker->address,
        ]);

        Exchange::create([
            'companies_id' => $companie->id,
            'price' => $faker->numberBetween(1, 100),
            'type' => '',
            'entered_date' => '',
            'entered_time' => '',
        ]);
 */       

    }
}
