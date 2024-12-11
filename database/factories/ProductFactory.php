<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        // Check if there are existing categories or create a new one
        $category = Category::inRandomOrder()->first();

        if (!$category) {
            // Create a category if none exist
            $category = Category::create([
                'name' => $this->faker->word(),
            ]);
        }

        return [
            'barcode' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->word(),
            'category_id' => $category->id,
            'quantity' => $this->faker->numberBetween(1, 100),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'cost' => $this->faker->numberBetween(100, 1000),
            'price' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
