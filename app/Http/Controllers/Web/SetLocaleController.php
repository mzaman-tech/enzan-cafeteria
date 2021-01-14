<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetLocaleController extends Controller
{
    public function __invoke(Request $request)
    {
        $locale = $request->lang;
        session(['locale' => $locale]);
        return $locale;
    }
}
