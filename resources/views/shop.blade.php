@extends('layouts.app')

@section('content')
<!-- please note that the borders are currently only set to make it clear how large the sizes of the boxes shall be -->
<div class="container align-items-center d-flex w-100 h-100">
    <div class="row h-90 w-100">
        <div class="col-6 p-0 splitter">
            <div class="border-bottom border-secondary">
                <img src="{{asset('images/npc-shop.png')}}" alt="..." class="img">
            </div>
            <div class="form-row border-bottom border-secondary">
                <!-- placeholder -->
                <div class="col">
                    <input type="search" class="form-control">
                </div>
                <div class="col-auto">
                    <button class="btn">Search</button>
                </div>
            </div>
            <div class="row h-75-px">
                <div class="col-auto">
                    <img src="{{asset('images/potion.gif')}}" alt="..." class=" h-75-px">
                </div>
                <div class="col">
                    <h2 class="h6">Name</h2>
                    <p>Desc...<br> 8/100</p>
                </div>
                <div class="col-3 ">
                    <p>500$</p>


                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">-</button>
                        </div>
                        <input type="text" class="form-control" placeholder="0" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">+</button>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">Add</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6 splitter align-content-between flex-wrap d-flex p-0">
            <div class="row flex-grow-1 h-50-px align-items-center">
                <div class="col-auto">
                    <img src="{{asset('images/potion.gif')}}" alt="..." class="h-50-px">
                </div>
                <div class="col">
                    <h2 class="h6 mb-0">Name</h2>
                </div>
                <div class="col-1 ">
                    <p class="mb-0">500$</p>
                </div>
                <div class="col-4 ">

                    <div class="input-group input-group-sm">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">-</button>
                        </div>
                        <input type="text" class="form-control" placeholder="0" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">+</button>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">Remove</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mx-auto">
                <div class="col mx-auto">
                    <div class="input-group input-group-sm">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">Accept</button>
                        </div>
                        <div class="col-auto ">
                            <p class="mb-0">500$</p>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-sm" type="button">Decline</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endsection
