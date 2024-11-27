<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add to cart function
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->course_id;

        // Check if the item is already in the cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if (!$cartItem) {
            // If not, create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
            ]);
        }

        return response()->json(['success' => 'Course added to cart']);
    }

    // Function to get all cart items
    public function getCartItems()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('course')->get();

        return view('website.cart', ['cartItems' => $cartItems]);
    }

    // Remove item from cart
    public function remove($id) {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
        }

        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Item removed successfully.']);
    }



}
