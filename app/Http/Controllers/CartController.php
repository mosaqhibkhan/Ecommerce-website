<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // View cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // Add product to cart
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Remove product from cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    // Update quantity using AJAX
    public function updateQuantity(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action');

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($action === 'increment') {
            $cart[$id]['quantity'] += 1;
        } elseif ($action === 'decrement') {
            $cart[$id]['quantity'] -= 1;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                $cartTotal = 0;
                foreach ($cart as $item) {
                    $cartTotal += $item['price'] * $item['quantity'];
                }

                return response()->json([
                    'removed' => true,
                    'cart_total' => $cartTotal,
                ]);
            }
        }

        session()->put('cart', $cart);

        $itemTotal = $cart[$id]['price'] * $cart[$id]['quantity'];
        $cartTotal = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json([
            'quantity' => $cart[$id]['quantity'],
            'item_total' => $itemTotal,
            'cart_total' => $cartTotal,
            'removed' => false
        ]);
    }

    // ✅ Show checkout form
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // ✅ Process checkout form
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);

        $order = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'cart' => session('cart'),
            'total' => array_reduce(session('cart', []), function ($sum, $item) {
                return $sum + $item['price'] * $item['quantity'];
            }, 0)
        ];

        // Clear cart
        session()->forget('cart');

        return view('checkout-success', compact('order'));
    }
}
