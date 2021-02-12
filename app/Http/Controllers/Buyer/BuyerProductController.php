<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //Carga lista de transacciones con los productos de cada transacción, y cargamos los productos
        $products = $buyer->transactions()->with('product')
            ->get()
            ->pluck('product');

        return $this->showAll($products);
    }
}
