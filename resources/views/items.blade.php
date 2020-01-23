@extends('layouts.app')

@section('content')

<ul>
    @foreach($items as $item)
    <li> Auto increment: {{ $item['item_id'] }} </li>
    <li> Name: {{ $item['name'] }} </li>
    <li> Description: {{ $item['description'] }} </li>
    <li> Type: {{ $item['type'] }} </li>
    <li> Price: {{ $item['price'] }} </li>
    <li> Quantity: {{ $item['quantity'] }} </li>
    <br>
    @endforeach
</ul>

@endsection