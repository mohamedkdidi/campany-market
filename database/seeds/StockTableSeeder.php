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

        Customer::truncate();

        foreach(range(1, 25) as $i) {
            Customer::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address
            ]);
        }
    }
}
