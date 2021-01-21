<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Se obtienen todos los usuarios que ya tienen un producto
        $vendedor = Seller::has('products')->get()->random();

        //usuarios que no es igual al id de usuario vendedor
        $comprador = User::all()->except($vendedor->id)->random();


        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'buyer_id' => $comprador->id,
            'product_id' => $vendedor->products->random(),

        ];
    }
}
