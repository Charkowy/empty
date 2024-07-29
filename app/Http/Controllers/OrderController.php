<?php

namespace App\Http\Controllers;

use App\Apis\Woocommerce\WcOrderApi;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
