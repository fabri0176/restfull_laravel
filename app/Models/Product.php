<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRODUCTO_DISPONIBLE = 'disponible';
    const PRODUCTO_NO_DISPONIBLE = 'no_disponible';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    public function isDisponible(){
        return $this->status === self::PRODUCTO_DISPONIBLE;
    }
}
