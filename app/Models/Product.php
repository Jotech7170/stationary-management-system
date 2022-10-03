<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //Relationship between stock and products
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    //Relationship between products and stock_products
    public function stock_products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    //Relationship between products and salles
    public function salles()
    {
        return $this->hasMany(Salle::class, 'product_id', 'id');
    }
}
