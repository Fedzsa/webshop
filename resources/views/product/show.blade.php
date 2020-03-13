@extends('layouts.app')

@section('content')
    <h2>{{ $product->name }}</h2>
    <hr>

    <h5>Specifications</h5>
    <ul>
        @foreach ($product->specifications as $item)
        <li>{{ $item->specification_type }} - {{ $item->specification_description }}</li>
        @endforeach
    </ul>
    <hr>

    <h5>Description</h5>
    <p>{{ $product->description }}</p>
@endsection