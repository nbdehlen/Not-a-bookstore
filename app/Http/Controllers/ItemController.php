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
            $output = "";
            // Get search result from DB matching item name or item type
            $items = Item::where('name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('type', 'LIKE', '%' . $request->search . "%")->get();

            // if request is type ajax and $items is defined
            if ($request->ajax() && $items) {
               foreach ($items as $key => $item) {
                   /* $output .= '<tr>' .
                        '<td>' . $item->name . '</td>' .
                        '<td>' . $item->description . '</td>' .
                        '<td>' . $item->type . '</td>' .
                        '<td>' . $item->price . '</td>' .
                        '<td>' . $item->quantity . '</td>' .
                        '</tr>';*/
                        //$output .= "<div class="col-12"> @component('npc_item', ['item' => $item])@endcomponent  </div>";
                        return view('npc_items', ['items' => $items]);
               }
              
                 
                //return $output;
                //return $output;
               // return ($items);
               //return view('npc_item', $items); //, compact('items'));
               //$view=view('npc_item');
                //$view=$view->render($items);
                //$responseData->responseSuccess($view);
                //return $view;
                //return view('npc_item', compact('items'));
                

               // return view('shop', compact('items'));

            } else /*if ($request == "shop")*/ {
                // Return the search result in JSON when using the direct search path
               return response()->json($items, 200, array(), JSON_PRETTY_PRINT);
               //return $items;
               //echo $request;
               //return view('shop', compact('items'));
            }
    }
}
