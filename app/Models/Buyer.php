<?php

namespace App\Models;

use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    protected static function boot()
    {
        parent::boot();

        //Cargamos el scope configurado para buyer
        static::addGlobalScope(new BuyerScope);
    }
}
