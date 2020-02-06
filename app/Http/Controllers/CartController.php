<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all items from cart
        $cartModel = new Cart();
        $sum = $cartModel->getSum();
        $items = $cartModel->getAllItems();
        $cart = [];

        foreach ($items as $key => $item) {
            $cart[$key] = [
                'name' => $item->name,
                'amount' => $item->amount,
                'price' => $item->price
            ];
        }


        return compact('cart', 'sum');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $amount)
    {
        $cart = new Cart();
        $item = $cart->addToCart($id, $amount);

        return view('cart_item', compact('item'));
    }

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
     * Remove all resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $cart = new Cart();
        return $cart->clear();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = new Cart();
        $cart->remove($id);

        return;
    }
}
