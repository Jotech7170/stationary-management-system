<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    //Relationship between products and salles
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    //Relationship between salles and stocks
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    //Relationship between products and stock_products
    public function stock_products()
    {
        return $this->belongsTo(StockProduct::class, 'stock_product_id', 'id');
    }
}
