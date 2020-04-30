@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2><h2>@lang('messages.delete-product-specification', ['product-name' => $product->name, 'specification-name' => $specification->name])</h2></h2>
            <hr>

            <form action="{{ route('products.specifications.destroy', ['product' => $product->id, 'specification' => $specification->id]) }}" method="post">
                @csrf()
                @method('DELETE')

                <input class="btn btn-danger" type="submit" value="@lang('messages.delete')">
                <a href="{{ route('products.specifications.index', ['product' => $product->id]) }}" class="btn btn-primary">@lang('messages.back')</a>
            </form>
        </div>
    </div>    
@endsection