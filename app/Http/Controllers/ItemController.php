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
        return view('items', compact('items'));

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
    public function show(Item $item)
    {
        //
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

    /*
    Dynamic search. If the request is ajax, fetch rows from table 'items' where 'name' or 'type' 
    match the ajax search value. Loop over matching rows and return.
    */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $items = DB::table('items')->where('name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('type', 'LIKE', '%' . $request->search . "%")->get();

            if ($items) {
                foreach ($items as $key => $item) {
                    $output .= '<tr>' .
                        '<td>' . $item->name . '</td>' .
                        '<td>' . $item->description . '</td>' .
                        '<td>' . $item->type . '</td>' .
                        '<td>' . $item->price . '</td>' .
                        '<td>' . $item->quantity . '</td>' .
                        '</tr>';
                }
                return ($output);
            }
        }
    }
}
