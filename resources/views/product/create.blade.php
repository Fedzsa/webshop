@extends('layouts.app')

@section('content')
    <h2>@lang('messages.create-product')</h2>
    <hr>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @error('status')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror

    <form action="{{ route('products.store') }}" method="post" class="pt-2 pb-2">
        @csrf()

        <div class="form-group">
            <label for="name">@lang('messages.product-name')</label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="name" class="form-control" />
        </div>

        <div class="form-group">
            <label for="category">@lang('messages.categories')</label>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select class="form-control" name="category_id">
                <option value="0">@lang('messages.choose-category')</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col">
                <label for="price">@lang('messages.price')</label>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="number" name="price" class="form-control" min="0" />
            </div>
            <div class="form-group col">
                <label for="amount">@lang('messages.amount')</label>
                @error('amount')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="number" name="amount" class="form-control" min="0" />
            </div>
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
            <a href="{{ route('products.index') }}" class="btn btn-primary">@lang('messages.back')</a>
        </div>
    </form>
@endsection
