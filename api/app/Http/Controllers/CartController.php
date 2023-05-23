<?php
namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $deletedProducts = $request->session()->get('deleted_products', []);
        $quantity = $request->input('quantity', 1);
        $productId = $request->input('product_id');

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        // Check if the product already exists in the cart for the user
        if ($cartItem) {
            // If the product exists, update the quantity
            $cartItem->quantity = $quantity;
            $cartItem->save();
        } else {
            // If the product does not exist, create a new cart item
            $cartItem = new Cart([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $cartItem->quantity = $quantity;
            $cartItem->save();

            if (isset($deletedProducts[$productId])) {
                // Remove the product from deleted products array
                unset($deletedProducts[$productId]);
                $request->session()->put('deleted_products', $deletedProducts);
            }
        }

        // Retrieve the cart item with its associated product data
        $cartItemWithProductData = $cartItem->getCartItemWithProductData($cartItem->id);

        return response()->json([
            'message' => 'Product added',
            'data' => $cartItemWithProductData,
        ], 201);
    }

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        $cartId = $request->input('cart_id');
    
        $cartItem = Cart::where('user_id', $user->id)->find($cartId);
    
        if ($cartItem) {
            $productId = $cartItem->product_id;
            
            $deletedProducts = $request->session()->get('deleted_products', []);
            if (!isset($deletedProducts[$productId])) {
                $deletedProducts[$productId] = true;
                $request->session()->put('deleted_products', $deletedProducts);
            }
            
            $cartItem->delete();
            
            return response()->json([
                'message' => 'Item removed from cart',
                'product_id' => $productId
            ], 200);
        }
        throw new CustomException("Item not found in cart", 404);
    }    


    public function getCartItems()
    {
        $user = Auth::user();
        $cartItems = $user->cart;
        $cart = new Cart();
        $cartItems = $cart->getUserCartWithProductData($user->id);

        return response()->json($cartItems, 200);
    }
}
