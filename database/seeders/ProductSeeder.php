<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = ['Electronics', 'Fashion', 'Home Appliances', 'Books', 'Sports', 'Beauty'];

        for ($i = 0; $i < 10; $i++) {
            $category = $faker->randomElement($categories);

            DB::table('products')->insert([
                'name' => $this->generateProductName($category, $faker),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 10, 1000),
                'image' => $faker->randomElement([
                    'product1.jpg',
                    'product2.jpg',
                    'product3.jpg',
                    'product4.jpg',
                    'product5.jpg',
                ]),
                'category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Generate product name based on category
     */
    private function generateProductName($category, $faker): string
    {
        switch ($category) {
            case 'Electronics':
                return $faker->randomElement(['Samsung', 'Apple', 'Sony', 'LG', 'Asus']) . ' ' .
                $faker->randomElement(['Galaxy', 'Pro', 'Air', 'X', 'Zen']) . ' ' .
                $faker->randomElement(['S20', '11', 'X500', 'G7', 'Book']);

            case 'Fashion':
                return $faker->randomElement(['T-Shirt', 'Jeans', 'Dress', 'Jacket', 'Shoes']) . ' ' .
                $faker->randomElement(['Premium', 'Classic', 'Sport', 'Elegant', 'Casual']) . ' ' .
                $faker->randomElement(['Edition', 'Series', 'Collection', 'Line', 'Style']);

            case 'Home Appliances':
                return $faker->randomElement(['Refrigerator', 'Washing Machine', 'Microwave', 'Blender', 'Toaster']) . ' ' .
                $faker->randomElement(['Smart', 'Pro', 'Digital', 'Eco', 'Ultra']) . ' ' .
                $faker->randomNumber(3);

            default:
                return $faker->words(3, true);
        }
    }
}
