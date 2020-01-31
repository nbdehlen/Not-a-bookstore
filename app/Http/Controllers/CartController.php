<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, $amount)
    {
        $cart = new Cart();
        $cart->updateCart($id, $amount);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('item_id', $id)->firstOrFail()->delete();

        return;
    }
}
