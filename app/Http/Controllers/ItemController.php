<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Item;
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
        $items = Item::get();
        return view('shop', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id, $amount)
    {
        $item = Item::where('item_id', $id)->first();
        $item['amount'] = $amount;
        return view('cart_item', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    /* Dynamic search */
    public function search(Request $request)
    {
            // Get search result from database matching item name or item type
            $items = Item::where('name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('type', 'LIKE', '%' . $request->search . "%")->get();

            // if request is type ajax and $items is defined
            if ($request->ajax() && $items) {
               foreach ($items as $key => $item) {
                        return view('npc_items', ['items' => $items]);
               }
            } else {
            // if request is not ajax, return json
               return response()->json($items, 200, array(), JSON_PRETTY_PRINT);
            }
    }
}
