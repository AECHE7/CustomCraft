<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'shipping_address' => 'required|string',
            'stripeToken' => 'required|string',
        ]);

        $cart = session()->get('cart');

        $order = Order::create([
            'status' => 'pending',
            'customer_email' => $request->email,
            'shipping_address' => $request->shipping_address,
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'customization_data' => json_encode($details['customization_data']),
            ]);
        }

        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }
}
