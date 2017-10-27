<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Companie;
use App\CompanieItem;

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

        profile::truncate();


        foreach(range(1, 25) as $i) {

            $companie = Companie::create([
                'stock_id' => $i,
                'name' => $faker->sentence,
                'entered_date' => '2017-'.mt_rand(1, 12).'-'.mt_rand(1, 28),
                'entered_time' => '00:00',
                'price' => $faker->numberBetween(1, 100)
            ]);

            foreach(range(1, mt_rand(2, 6)) as $j) {
                CompanieItem::create([
                    'companie_id' => $companie->id,
                    'name' => $faker->sentence,
                    'price' => $faker->numberBetween(1, 100)
                ]);
            }
        }
    }
}
