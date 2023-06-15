<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAmount()
    {
        // Calculate the total amount based on the added products
        return $this->sum('product.price');
    }
}
