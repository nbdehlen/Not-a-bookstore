@extends('layouts.app')

@section('content')
<div class="book">
    <div></div>
</div>
<!-- please note that the borders are currently only set to make it clear how large the sizes of the boxes shall be -->
<div class="container-fluid align-items-center d-flex h-100" style="width: 1299px !important;">
    <div class="row shop-bg">
        <div class="col-6 splitter">
            <div class="top-bar">
                <div class="row">
                    @component('message_box')@endcomponent
                </div>
                <div class="row search">
                    @component('search')@endcomponent
                </div>
            </div>
            <div class="row">
                @foreach ($items as $item)
                    @component('npc_item', ['item' => $item])@endcomponent
                @endforeach
            </div>
        </div>
        <div class="col-6 splitter splitter-right align-content-between flex-wrap d-flex">
            <div class="row flex-grow-1 h-50-px align-items-center">
                <div class="col-12">
                    {{--
                        Placeholder cart item
                        This template should probably be made with javascript or be retrieved with an API call 
                    --}}
                    @component('cart_item', ['item' => $items[0]])@endcomponent
                </div>
            </div>
        </div>
        <div class="bottom-bar col-6 offset-6">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button id="accept" class="btn btn-texture-blue exocet" type="button">Accept</button>
                </div>
                <div class="col-auto">
                    <p class="price mb-0 d-flex align-items-center justify-content-sm-center">
                        500
                        <img src="{{ asset("images/gold.png") }}" class="ml-1" alt="Price">
                    </p>
                </div>
                <div class="col-auto">
                    <button id="decline" class="btn btn-texture-red exocet" type="button">Decline</button>
                </div>
            </div>
        </div>
    </div>
</div>
        @endsection
