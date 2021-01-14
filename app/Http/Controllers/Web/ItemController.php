<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Http\Requests\Web\ItemRequest;

class ItemController extends Controller
{
    public function show($id, Request $request)
    {
        $item = Item::findOrfail($id);
        $orderCount = $item->orders->where('is_delivered', 0)->count();

        return view('item.show', ['item' => $item, 'orderCount' => $orderCount]);
    }

    public function create(Request $request)
    {
        return view('item.form', ['isNew' => true]);
    }

    public function store(ItemRequest $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        if($request->has('image')){
            $path = \Storage::putFile('images', $request->file('image'));
            $item->image = pathinfo($path)['basename'];
        }
        $item->is_available = isset($request->is_available)? 1 : 0;
        $item->save();

        return redirect()->action('Web\ItemController@show', $item->id);
    }

    public function edit($id, Request $request)
    {
        $item = Item::findOrfail($id);
        return view('item.form', ['item' => $item, 'isNew' => false]);
    }

    public function update($id, ItemRequest $request)
    {
        $item = Item::findOrfail($id);
        $item->name = $request->name;
        $item->price = $request->price;
        if($request->has('image')){
            \Storage::delete('images/'.$item->image);
            $path = \Storage::putFile('images', $request->file('image'));
            $item->image = pathinfo($path)['basename'];
        }
        $item->is_available = isset($request->is_available)? 1 : 0;
        $item->save();

        return redirect()->action('Web\ItemController@show', $item->id);

    }

    public function destroy($id, Request $request)
    {
        $item = Item::findOrfail($id);
        \Storage::delete('images/'.$item->image);
        $item->delete();

        return redirect()->action('Web\DashboardController@index');
    }
}
