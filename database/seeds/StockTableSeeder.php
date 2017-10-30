<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Stock;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Stock::truncate();

        foreach(range(10, 25) as $i) {
            Stock::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address
            ]);
        }
    }
}
