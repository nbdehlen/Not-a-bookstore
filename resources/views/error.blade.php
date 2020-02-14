@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row h-100">
        <div class="col-auto mx-auto my-auto">
            <img src="https://http.cat/{{ $code }}" alt="Error {{ $code }}">
            <p class="lead text-center text-white mt-2">{{ $message ?? '' }}</p>
        </div>
    </div>
</div>
@endsection
