<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all()->sortBy('name');
        return view('shop', ['items' => $items]);
    }
}
