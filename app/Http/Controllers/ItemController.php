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
    public function index(Request $request)
    {
        // Get all items
        $items = Item::get();

        if ($request->route()->getPrefix() === 'api' ) {
            return response()->json($items, 200, array(), JSON_PRETTY_PRINT);
        }

        // Get all items from cart
        $cart = new Cart();
        $sum = $cart->getSum();
        $cart = $cart->getAllItems();

        return view('shop', compact('items', 'cart', 'sum'));
    }

    // Get specific item
    public function show(Request $request, $id)
    {
        $item = Item::where('item_id', $id)->firstOrFail();

        if($request->wantsJson()) {
            return response()->json($item, 200, array(), JSON_PRETTY_PRINT);
        }

        return view('npc_item', compact('item'));
    }

    /* Dynamic search */
    public function search(Request $request)
    {
        // Get search result from database matching item name or item type
        $items = new Item();
        $search = $items->search($request->search);

        if ($request->wantsJson()) {
            return response()->json($search, 200, array(), JSON_PRETTY_PRINT);
        }

        return view('npc_items', ['items' => $search]);
    }
}
