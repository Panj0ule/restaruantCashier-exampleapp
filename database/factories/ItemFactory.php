<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        $pricePoints = [10000, 15000, 20000, 25000, 30000, 35000, 40000, 45000, 50000, 55000, 60000];
        return [
            'name' => $faker->foodName(),
            'price' => $faker->randomElement($pricePoints),
            'desc' => $faker->sentence(5),
        ];
    }
}

