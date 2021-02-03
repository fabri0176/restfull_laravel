<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SellerScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        //Modificar consulta para que solo tenga encuenta usuarios con transacciones,
        $builder->has('products');
    }
}
