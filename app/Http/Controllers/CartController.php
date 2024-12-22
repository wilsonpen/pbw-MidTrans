<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource (view cart).
     */
    public function index()
    {
        // Ambil semua item di cart untuk user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        // Hitung jumlah item di cart
        $cartCount = $cartItems->sum('quantity');

        return view('cart.index', compact('cartItems', 'cartCount'));
    }

    /**
     * Show the form for creating a new resource (not needed for cart).
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage (add to cart).
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // dd($request->all());

        // Tambahkan ke cart
        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->input('quantity', 1), // Gunakan nilai default 1 jika tidak ada input quantity
                'total_price' => Product::find($request->product_id)->price * $request->input('quantity', 1),
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    /**
     * Display the specified resource (not needed for cart).
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource (not needed for cart).
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage (update quantity).
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update item di cart
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $cartItem->product->price * $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove the specified resource from storage (remove item from cart).
     */
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    public function checkout(Request $request)
    {
        // Ambil data keranjang berdasarkan user
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->get();

        // Periksa apakah keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        // Buat data order baru
        $order = Order::create([
            'order_id'=>uniqid(),
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'pending', // Status default untuk order
        ]);

        // Simpan detail setiap item ke order_detail
        foreach ($cartItems as $cartItem) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Kosongkan keranjang setelah checkout
        Cart::where('user_id', $userId)->delete();

        // Redirect ke halaman sukses atau detail order
        return redirect()->route('orders.show', $order->id)->with('success', 'Checkout successful!');
    }
}
