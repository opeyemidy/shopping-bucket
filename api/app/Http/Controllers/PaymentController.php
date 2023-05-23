<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Jobs\ProcessDiscountsJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store()
    {
        $sessionData = Session::get('deleted_products');
        $user = Auth::user();

        // order logic

        Cart::where('user_id', $user->id)->delete();

        if($sessionData){
            ProcessDiscountsJob::dispatch(array_keys($sessionData));
            Session::put('deleted_products', []);
        }
        return response()->json(['message'=>'payment route']);
    }
}
