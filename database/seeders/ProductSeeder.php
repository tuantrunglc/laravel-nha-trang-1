<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Product::create([
                'name' => $faker->words(3, true),
                'image' => $faker->imageUrl(640, 480, 'technics'),
                'price' => $faker->numberBetween(2, 1000000),
                'description' => $faker->text(200),
                '_token' => $faker->sha256(),  // Sinh một giá trị ngẫu nhiên giống token
            ]);
        }
    }
}
