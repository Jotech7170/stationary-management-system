<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    use HasFactory;
    //Relationship between stock and stock_products
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    //Relationship between products and stock_products
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    //Relationship between salles and stock_products
    public function salles()
    {
        return $this->hasMany(Salle::class, 'stock_product_id', 'id');
    }
}
