@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>@lang('messages.delete-category', ['name' => $category->name])</h2>

            @error('status')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror

            <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                @method('DELETE')
                @csrf()
                <button type="submit" class="btn btn-danger">@lang('messages.delete')</button>
                <a href="{{ route('categories.index') }}" class="btn btn-primary">@lang('messages.back')</a>
            </form>
        </div>
    </div>
@endsection
