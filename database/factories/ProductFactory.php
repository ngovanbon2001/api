<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => 3,
            'brand_id' => 3,
            'name' => $this->faker->word,
            'image_url' => "product-1.jpg",
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'old_price' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->text(200),
            'tags' => $this->faker->text(10),
            'is_best_sell' => $this->faker->numberBetween(0, 4),
            'is_new' => $this->faker->numberBetween(0, 4),
            'sort_order' => $this->faker->numberBetween(0, 4),
            'active' => $this->faker->numberBetween(0, 4),
            'amount' => $this->faker->randomNumber()
        ];
    }
}
