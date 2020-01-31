<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Item;
use App\Cart;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all items from cart
        $cart = new Cart();
        $cart = $cart->getAllItems();

        // Get all items
        $items = Item::get();


        return view('shop', compact('items', 'cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $amount)
    {
        $cart = new Cart();
        $item = $cart->addToCart($id, $amount);

        return view('cart_item', compact('item'));
    }

    /* Dynamic search */
    public function search(Request $request)
    {
        // Get search result from database matching item name or item type
        $items = new Items();
        $search = $items->search();

        // if request is type ajax and $items is defined
        if ($request->ajax() && $search) {
            foreach ($search as $key => $item) {
                return view('npc_items', compact('search'));
            }
        }
    }
}
