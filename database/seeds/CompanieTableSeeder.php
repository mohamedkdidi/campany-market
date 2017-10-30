<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Companie;
use App\Exchange;
use App\Stock;

class CompanieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Companie::truncate();
        Exchange::truncate();
        $stock = DB::table('Stocks')->count();
        foreach(range(1, 25) as $i) {

            $companie = Companie::create([
                'name' => $faker->sentence,
                'email' => $faker->email,
                'address' => $faker->address,
            ]);

            foreach(range(1, mt_rand(2, 6)) as $j) {
                Exchange::create([
                    'companie_id' => $companie->id,
                    'stock_id' =>  $faker->numberBetween(0,(int)$stock),
                    'type' => $faker->randomElement($array = array ('common stock','preferred stock')),
                    'entered_date' => $faker->date, //date($format = 'Y-m-d', $min = 'now'),
                    'entered_time' => $faker->time, //time($format = 'H:i:s'),
                    'price' => $faker->numberBetween(1, 100)
                ]);
            }
        }
    }
}
