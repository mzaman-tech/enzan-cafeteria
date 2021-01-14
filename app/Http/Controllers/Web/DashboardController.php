<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = $request->get('query', null);
        if(!empty($query)){
            $items = Item::with(['orders' => function($q) {
                $q->where('is_delivered', 0);
            }])->where('name', 'LIKE', '%'.$query.'%')->paginate(10);
        } else {
            $items = Item::with(['orders' => function($q) {
                $q->where('is_delivered', 0);
            }])->paginate(10);
        }

        return view('dashboard', ['items' => $items, 'query' => $query]);
    }
}
