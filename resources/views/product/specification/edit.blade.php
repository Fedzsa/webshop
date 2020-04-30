@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>@lang('messages.update-item', ['name' => $specification->name])</h1>
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

            <form action="{{ route('products.specifications.update', ['product' => $product->id, 'specification' => $specification->id]) }}" method="post">
                @csrf()
                @method('PUT')


                <div class="form-group row">
                    <div class="col">
                        <label class="mr-5" for="specification-value">{{ $specification->name }}</label>
                        @error('specification-value')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="form-control" type="text" name="specification-value" value="{{ $specification->pivot->value }}" />
                    </div>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="@lang('messages.update')" />
                    <a href="{{ route('products.specifications.index', ['product' => $product->id]) }}" class="btn btn-primary">@lang('messages.back')</a>
                </div>
            </form>
        </div>
    </div>
@endsection