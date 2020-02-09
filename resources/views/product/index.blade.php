@extends('layouts.app')

@section('content')
    <h2>@lang('messages.products')</h2>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>@lang('messages.name')</th>
                <th>@lang('messages.price')</th>
                <th>@lang('messages.description')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="fas fa-edit"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection