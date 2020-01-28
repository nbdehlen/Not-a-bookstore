@extends('layouts.app')

@section('content')
<!-- please note that the borders are currently only set to make it clear how large the sizes of the boxes shall be -->
<div class="container align-items-center d-flex w-100 h-100 ">
    <div class="row h-90 w-100 shop-bg">
        <div class="col-6 p-0 splitter">
            <div class="border-bottom border-secondary">
                <img src="{{asset('images/shop-vendor.png')}}" alt="..." class="img">
            </div>
            <div class="form-row border-bottom border-secondary">
                <!-- placeholder -->
                <div class="col">
                    <input type="search" class="form-control">
                </div>
                <div class="col-auto">
                    <button class="btn btn-texture-red">Search</button>
                </div>
            </div>
            <div class="row">
                @foreach ($items as $item)
                <div class="col-12">
                    @component('npc_item', ['item' => $item])@endcomponent
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-6 splitter align-content-between flex-wrap d-flex p-0">
            <div class="row flex-grow-1 h-50-px align-items-center">
                <div class="col-12">
                    {{--
                        Placeholder cart item
                        This template should probably be made with javascript or be retrieved with an API call 
                    --}}
                    @component('cart_item', ['item' => $items[0]])@endcomponent
                </div>
            </div>
            <div class="row mx-auto">
                <div class="col mx-auto">
                    <div class="input-group input-group-sm">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm btn-texture-blue" type="button">Accept</button>
                        </div>
                        <div class="col-auto ">
                            <p class="mb-0">500$</p>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm btn-texture-red" type="button">Decline</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endsection
