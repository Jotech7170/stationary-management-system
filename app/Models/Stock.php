<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    //Relationship between stock and stock_products
    public function stock_products()
    {
        return $this->hasMany(StockProduct::class, 'stock_id', 'id');
    }

    //Relationship between salles and stocks
    public function salles()
    {
        return $this->hasMany(Salles::class, 'stock_id', 'id');
    }
}
