<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //buyers son usuarios que tienen transacciones
        $sellers = Seller::has('products')->get();
        return $this->showAll($sellers);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Buyer $seller */
        $seller = Seller::has('products')->findOrFail($id);
        return $this->showOne($seller);
    }
}
