<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'quantity' => $this->faker->numberBetween(1, 30),
            'status' => $this->faker->randomElement([Product::PRODUCTO_DISPONIBLE, Product::PRODUCTO_NO_DISPONIBLE,]),
            'image' => $this->faker->randomElement(['image_1.jpg', 'image_2.jpg', 'image_3.jpg']),
            'seller_id' => User::all()->random()->id,
        ];
    }
}
