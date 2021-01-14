<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query', null);
        if(!empty($query)){
            $orders = Order::with('item')->where('customer_name', 'LIKE', '%'.$query.'%')->orderBy('id', 'desc')->paginate();
        } else {
            $orders = Order::with('item')->orderBy('id', 'desc')->paginate();
        }

        return view('order.index', ['orders' => $orders, 'query' => $query]);
    }

    public function confirmDelivery($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->is_delivered = 1;
        $order->save();

        return redirect()->action('Web\OrderController@index');
    }
}
