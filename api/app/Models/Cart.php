<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id','created_at','updated_at'];
    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getUserCartWithProductData($userId)
    {
        return $this->with('product')->where('user_id', $userId)->get();
    }
    public function getCartItemWithProductData($cartItemId)
    {
        return $this->with('product')->find($cartItemId);
    }
}
