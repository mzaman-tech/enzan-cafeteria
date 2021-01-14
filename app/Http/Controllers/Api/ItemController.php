<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Item::paginate());
    }
}
