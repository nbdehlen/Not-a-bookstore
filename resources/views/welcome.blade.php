@extends('layouts.app')

@section('content')

<div class="container h-100">
    <ul class="row text-center align-items-center h-100 list-unstyled">
        <li class="col-12 col-md-4">
            <a href="/shop"><img src="{{asset('images/npc-landingpage.png')}}" alt="..." class="img img-thumbnail"></a>
        </li>
        <li class="col-12 col-md-4">
            <img src="{{ asset('images/npc-landingpage-2.png')}}" alt="..." class="img img-thumbnail notavailable">
        </li>
        <li class="col-12 col-md-4">
            <img src="{{ asset('images/npc-landingpage-1.png')}}" alt="..." class="img img-thumbnail notavailable">
        </li>

    </ul>
</div>

@endsection
