<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function getDiscountWithProductData()
    {
        return self::with('product')->get();
    }
}
