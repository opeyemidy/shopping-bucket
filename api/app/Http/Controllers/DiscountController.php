<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index()
    {
        $discount_products = Discount::getDiscountWithProductData();
        
        return response()->json($discount_products);
    }
    
}
