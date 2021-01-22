<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Deshabilitar verificación llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        //Truncar tables
        DB::table('users')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('transactions')->truncate();
        DB::table('category_product')->truncate();


        //Ejecutar Factories
        $numUsers = 200;
        $numCategories = 30;
        $numProducts = 1000;
        $numTransactions = 1000;

        \App\Models\User::factory($numUsers)->create();
        \App\Models\Category::factory($numCategories)->create();
        \App\Models\Product::factory($numProducts)->create();


        \App\Models\Product::factory($numTransactions)->create()->each(function ($product) { //Asociar las categorias creadas con los productos
            $categories = Category::all()->random(mt_rand(1, 5))->pluck('id'); //Obtener solo el id
            $product->categories()->attach($categories); //Relacionamos las categoria con el producto.
        });


        \App\Models\Transaction::factory($numTransactions)->create();
        
        
    }
}
