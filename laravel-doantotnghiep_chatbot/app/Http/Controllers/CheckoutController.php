<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Treconyl\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        $totalPrice = Cart::getTotal();
        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'address'   => 'required|string|max:500',
            'phone'     => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Lưu đơn hàng vào CSDL (tùy chỉnh nếu cần)
        // Order::create([...]);

        // Xóa giỏ hàng sau khi đặt hàng thành công
        Cart::clear();

        return redirect()->route('welcome')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }
}
