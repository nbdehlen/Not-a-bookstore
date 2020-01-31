<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Get search result from database matching item name or item type
     */
    public function search($term)
    {
        return $this->where('name', 'LIKE', '%' . $term . "%")
            ->orWhere('type', 'LIKE', '%' . $term . "%")->get();
    }

    public function cart()
    {
        return $this->belongsTo(\App\Cart::class, 'item_id');
    }
}
