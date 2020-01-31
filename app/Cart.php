<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    // Modifiable values
    protected $fillable = ['item_id', 'amount'];

    /**
     * Add item from vendor to cart
     */
    public function addToCart($id, $amount)
    {
        // Get item matching ID or throw error
        $item = Item::where('item_id', $id)->firstOrFail();
        // Add amount to item object      
        $item['amount'] = (int) $amount;

        // Insert new or update cart row
        $order = $this->firstOrNew(['item_id' => $id]);

        // Get item inventory
        $inventory = $this->getInventory($id);

        // Verify that amount does not exceed quantity
        if ($item['amount'] <= $inventory['quantity']) {
            // Add values of request amount and database amount
            $tmpAmount = $item['amount'] + $inventory['amount'];

            // Verify that new amount does not exceed quantity
            if ($tmpAmount <= $inventory['quantity']) {
                $order->amount = $tmpAmount;
            }
        } else {
            // Set amount equal to quantity if a number greater than quantity was provided
            $order->amount = $inventory['quantity'];
        }

        $item['amount'] = $order->amount;

        // Save to database
        if ($order->save()) {
            $itemModel = new Item();
            $itemModel->setQuantity($id, $inventory['quantity'] - $order->amount);
        }

        return $item;
    }

    /**
     * Update cart item amount
     */
    public function updateCart($id, $amount)
    {
        if ($amount <= 0) {
            // Remove item from cart if amount is 0 or less
            $this->remove($id);
        } else {
            // Insert new or update cart table
            $order = $this->firstOrNew(['item_id' => $id]);

            // Get item inventory
            $inventory = $this->getInventory($id);

            $quantity = $inventory['quantity'];
            if ($amount <= $inventory['quantity']) {
                $order->amount = $amount;
                $quantity -= $amount;
            } else {
                $order->amount = $inventory['quantity'];
            }

            // Save to database
            if ($order->save()) {
                $itemModel = new Item();
                $itemModel->setQuantity($id, $quantity);
            }
        }
    }

    /**
     * Get vendor item quantity & cart amount by id
     */
    public function getInventory($id)
    {
        $query = DB::table('items')
            ->leftJoin('carts', 'items.item_id', '=', 'carts.item_id')
            ->where('items.item_id', $id)
            ->first(['quantity', 'amount']);

        return [
            'quantity' => $query->quantity,
            'amount' => $query->amount
        ];
    }

    /**
     * Get all items in cart
     */
    public function getAllItems()
    {
        return DB::table('carts')
            ->join('items', 'carts.item_id', '=', 'items.item_id')
            ->get();
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        return $this->where('item_id', $id)->firstOrFail()->delete();
    }

    public function item()
    {
        return $this->hasOne(\App\Item::class, 'item_id', 'item_id');
    }
}
