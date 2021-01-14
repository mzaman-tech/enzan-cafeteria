<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Order;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();

        if($validated){

            $order = new Order();
            $order->item_id = $request->item_id;
            $order->quantity = $request->quantity;
            $order->total_price = $request->total_price;
            $order->customer_name = $request->customer_name;
            $order->customer_addess = $request->customer_addess;
            $order->delivery_time = $request->delivery_time;

            if($order->save()){
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
}
