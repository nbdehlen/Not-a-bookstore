<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Search query
        $query = $request->get('query');

        // Get matching items from database
        $items = Item::where('name', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->get();

        // Return as JSON
        return response()->json($items, 200, array(), JSON_PRETTY_PRINT);
    }
}
