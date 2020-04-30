@extends('layouts.app')

@section('content')
    <h4>{{ trans_choice('messages.specification', 2) }}</h4>
    <hr>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('products.specifications.store', ['product' => $product->id]) }}" method="post">
        @csrf()

        <div class="form-group row">
            <div class="col">
                <select class="form-control" name="specification" id="">
                    <option value="0">--- Choose specification ---</option>
                    @foreach($specifications as $specification)
                        <option value="{{ $specification->id }}">{{ $specification->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input class="form-control" type="text" name="specification-value" />
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-success" type="submit" value="@lang('messages.save')" />
            <a href="{{ route('products.specifications.index', ['product' => $product->id]) }}" class="btn btn-primary">@lang('messages.back')</a>
        </div>
    </form>
@endsection
