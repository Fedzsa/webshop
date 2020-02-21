@extends('layouts.app')

@section('content')
    <h2>@lang('messages.create-product')</h2>
    <hr>

    <form action="{{ route('store-product') }}" method="post" class="pt-2 pb-2">
        @csrf()

        <div class="form-group">
            <label for="name">@lang('messages.product-name')</label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="name" class="form-control" />
        </div>

        <div class="form-group">
            <label for="price">@lang('messages.price')</label>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="number" name="price" class="form-control" min="0" />
        </div>

        <div class="form-group">
            <label for="description">@lang('messages.description')</label>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea type="text" name="description" class="form-control" rows="10"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="@lang('messages.save')" class="btn btn-success" />
            <a href="{{ route('products') }}" class="btn btn-primary">@lang('messages.back')</a>
        </div>
    </form>
@endsection