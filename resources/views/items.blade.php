@extends('layouts.app')

@section('head')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@endsection

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

<script>
$('#search').on('keyup',function(){
    /* "this" refers to the value in #search  */
    var value = $(this).val();

    $.ajax({
        type: 'GET',
        url: '{{ url("items/search") }}',
        data: {
            search: value,
        },

        success:function(data) {
            $('#initial_table').hide();
            $('#ajax').html(data);
        },
        error:function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + " : " + errorThrown);
        },
    });
});
</script>

@endsection