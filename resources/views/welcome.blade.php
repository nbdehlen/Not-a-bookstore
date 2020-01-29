@extends('layouts.app')

@section('content')

<div class="container d-flex align-items-center h-100">
    <ul class="row text-center align-items-center list-unstyled m-0">
        <div class="col-12 landing-headline">
            <h1 class="exocet-light display-1 text-uppercase text-white text-shadow mb-0">Traders</h1>
            <p class="exocet-light lead text-uppercase text-shadow">Select your desired trader</p>
        </div>
        <li class="col-12 col-md-4 not-available">
            <img src="{{asset('images/unavailable-vendor-1.png')}}" alt="..." class="img portrait">
            <h2 class="exocet h6 text-muted text-shadow mt-2">Unavailable</h2>
        </li>
        <li class="col-12 col-md-4">
            <a href="/shop"><img src="{{ asset('images/main-vendor.png')}}" alt="..." class="img portrait"></a>
            <h2 class="exocet h6 text-white text-shadow mt-2">Lilith</h2>
        </li>
        <li class="col-12 col-md-4 not-available">
            <img src="{{ asset('images/unavailable-vendor-2.png')}}" alt="..." class="img portrait">
            <h2 class="exocet h6 text-muted text-shadow mt-2">Unavailable</h2>
        </li>

    </ul>
</div>

@endsection
