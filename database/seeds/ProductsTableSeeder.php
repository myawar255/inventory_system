<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('products')->insert([
                'userid' => $faker->numberBetween(1, 10),
                'productname' => $faker->words($nb = 3, $asText = true),
                'stock' => $faker->numberBetween(1, 1000),
                'opening_stock' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
                'purchase_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
                'sale_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
