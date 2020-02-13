<?php

namespace App;

use App\Item;
use Exception;
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
        try {
            // Get item matching ID or throw error
            $item = Item::where('item_id', $id)->firstOrFail();
        } catch (Exception $exception) {
            abort(404, "No item with ID matching $id was found");
        }
        // Add amount to item object
        $item['amount'] = (int) $amount;

        // Insert new or update cart row
        $order = $this->firstOrNew(['item_id' => $id]);

        // Get item inventory
        $inventory = $this->getInventory($id);

        $quantity = $inventory['quantity'];
        // Verify that amount does not exceed quantity
        if ($item['amount'] <= $quantity) {
            // Add values of request amount and database amount
            $order->amount = $item['amount'] + $inventory['amount'];
            $quantity -= $item['amount'];
        } else {
            // if ($quantity !== 0) {
            //     // Set amount equal to quantity if a number greater than quantity was provided
            //     $order->amount = $quantity;
            //     $quantity = 0;
            // }
            abort(500, 'Given amount exceeds vendor quantity');
        }

        $item['amount'] = $order->amount;

        // Save to database
        if ($order->save()) {
            $itemModel = new Item();
            $itemModel->setQuantity($id, $quantity);
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
                if ($amount > $inventory['amount']) {
                    // Increase cart amount by one and decrease vendor quantity by one
                    $order->amount += 1;
                    $quantity -= 1;
                } else {
                    // Decrease cart amount by one and increase vendor quantity by one
                    $order->amount -= 1;
                    $quantity += 1;
                }
            } else {
                if ($amount > $inventory['amount']) {
                    // Set cart amount equal to vendor item quantity plus cart amount from db
                    $order->amount = $inventory['quantity'] + $inventory['amount'];
                    $quantity = 0;
                } else {
                    $order->amount -= 1;
                    $quantity += 1;
                }
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
     * Get price sum of cart items
     */
    public function getSum()
    {
        return DB::table('carts')
            ->select(DB::raw('SUM(price * amount) as sum'))
            ->join('items', 'carts.item_id', '=', 'items.item_id')
            ->first()
            ->sum;
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        // Get item inventory
        $inventory = $this->getInventory($id);

        // Add quantity and amount
        $amount = $inventory['quantity'] + $inventory['amount'];

        // Delete item from cart
        $response = $this->where('item_id', $id)->firstOrFail()->delete();

        if ($response) {
            // Add item amount from cart back to item stock quantity
            $itemModel = new Item();
            $itemModel->setQuantity($id, $amount);
        }

        return $response;
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $itemModel = new Item();
        // Get cart items
        $inventory = $this->getAllItems();

        // Add quantity back to vendor
        foreach ($inventory as $item) {
            $itemModel->incrementQuantity($item->item_id, $item->amount);
        }

        return $this->query()->delete();
    }

    public function item()
    {
        return $this->hasOne(\App\Item::class, 'item_id', 'item_id');
    }
}
