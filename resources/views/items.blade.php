@extends('layouts.app')

@section('content')

<input type="text" id="search" name="search"> <br/>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>

    <tbody id="ajax">
        {{-- Where search results show up --}}
    </tbody>

    <tbody id="initial_table">
        {{-- This is hidden unless search field is empty --}}
        @foreach($items as $item)
        <tr>
          <td> {{ $item['name'] }} </td>
          <td>  {{ $item['description'] }} </td>
          <td>  {{ $item['type'] }} </td>
          <td>  {{ $item['price'] }} </td>
          <td>  {{ $item['quantity'] }} </td>
        </tr>
          @endforeach 
    </tbody> 
</table>
@endsection

@section('jquery')
<script src="{{URL::asset('js/jquery.js')}}"></script>
@endsection