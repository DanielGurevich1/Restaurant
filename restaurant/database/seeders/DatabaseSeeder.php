<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1, 10) as $_) {
            $faker = Factory::create();
            DB::table('menus')->insert([
                'title' => $faker->firstName(),
                'price' => $faker->randomNumber(2),
                'weight' => $faker->randomNumber(2),
                'meat' => $faker->randomNumber(2),
                'about' => $faker->realText(rand(10, 20))
            ]);
        }

        //
        foreach (range(1, 10) as $_) {
            $faker = Factory::create();
            DB::table('restaurants')->insert([
                'title' => $faker->company(),
                'customer' => $faker->randomNumber(2),
                'employee' => $faker->randomNumber(2),
                // 'menu_id' => $faker->randomNumber(1),

            ]);
        }
    }
}
