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
        $sum = $cart->getSum();
        $cart = $cart->getAllItems();

        // Get all items
        $items = Item::get();

        return view('shop', compact('items', 'cart', 'sum'));
    }

    // Get specific item
    public function show($id)
    {
        $item = Item::where('item_id', $id)->firstOrFail();

        return view('npc_item', compact('item'));
    }

    /* Dynamic search */
    public function search(Request $request)
    {
        // Get search result from database matching item name or item type
        $items = new Item();
        $search = $items->search($request->search);

        // if request is type ajax and $items is defined
        if ($request->ajax() && $search) {
            return view('npc_items', ['items' => $search]);
        }
    }
}
