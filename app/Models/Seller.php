<?php

namespace App\Models;

use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        //Cargamos el scope configurado para buyer
        static::addGlobalScope(new SellerScope);
    }
}
