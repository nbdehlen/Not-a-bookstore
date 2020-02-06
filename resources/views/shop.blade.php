@extends('layouts.app')

@section('content')
@component('modal')@endcomponent
<div class="book">
    <div></div>
</div>
<!-- please note that the borders are currently only set to make it clear how large the sizes of the boxes shall be -->
<div class="container-fluid align-items-center d-flex h-100" style="width: 1299px !important;">
    <div class="row shop-bg">
        <div class="col-6 splitter-left">
            <div class="top-bar">
                <div class="row">
                    @component('message_box')@endcomponent
                </div>
                <div class="row search">
                    @component('search')@endcomponent
                </div>
            </div>
            <div id="shop" class="row scrollbar scrollbar-left">
                @foreach ($items as $item)
                    @component('npc_item', ['item' => $item])@endcomponent
                @endforeach
            </div>
        </div>
        <div class="col-6 splitter-right scrollbar scrollbar-right align-content-between flex-wrap d-flex">
            <div id="cart" class="row flex-grow-1 h-50-px align-items-center">
                @component('cart_items', ['cart' => $cart])@endcomponent
            </div>
        </div>
        <div class="bottom-bar col-6 offset-6">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button id="accept" class="btn btn-texture-blue exocet" type="button" {{ $sum <= 0 ? 'disabled' : '' }}>Accept</button>
                </div>
                <div class="col-auto">
                    <p  class="price mb-0 d-flex align-items-center justify-content-sm-center">
                        <span id="totalPrice">{{ $sum ?? '0' }}</span>
                        <img src="{{ asset("images/gold.png") }}" class="ml-1" alt="Price">
                    </p>
                </div>
                <div class="col-auto">
                    <button id="decline" class="btn btn-texture-red exocet" type="button" {{ $sum <= 0 ? 'disabled' : '' }}>Decline</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
