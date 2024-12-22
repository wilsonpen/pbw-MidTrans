<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    /**
     * @throws \Exception
     */
    public function show(MidtransService $midtransService, Order $order)
    {
        // get last payment
        $payment = $order->payments->last() ?? null;

        if ($payment == null || $payment->status == 'EXPIRED') {
            $snapToken = $midtransService->createSnapToken($order);

            $order->payments()->create([
                'snap_token' => $snapToken,
                'status' => 'PENDING',
            ]);
        } else {
            $snapToken = $payment->snap_token;
        }

        return view('orders.show', compact('order', 'snapToken'));
    }
}
    