@extends('layouts.app')

@section('content')

<div class="container h-100">

    <ul class="row text-center align-items-center h-75 list-unstyled m-0">
        <div class="col-12">
            <h1 class="exocet-light display-1 text-uppercase text-white">Traders</h1>
            <p class="lead text-white">Select your desired trader</p>
        </div>
        <li class="col-12 col-md-4">
            <img src="{{asset('images/unavailable-vendor-1.png')}}" alt="..." class="img portrait notavailable">
            <h2 class="exocet h6 text-muted mt-2">Unavailable</h2>
        </li>
        <li class="col-12 col-md-4">
            <a href="/shop"><img src="{{ asset('images/main-vendor.png')}}" alt="..." class="img portrait"></a>
            <h2 class="exocet h6 text-white mt-2">Lilith</h2>
        </li>
        <li class="col-12 col-md-4">
            <img src="{{ asset('images/unavailable-vendor-2.png')}}" alt="..." class="img portrait notavailable">
            <h2 class="exocet h6 text-muted mt-2">Unavailable</h2>
        </li>

    </ul>
</div>

@endsection
