@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>@lang('messages.create-category')</h2>

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

            <form action="{{ route('categories.store') }}" method="post">
                @csrf()

                <div class="form-group">
                    <label for="name">@lang('messages.name')</label>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="@lang('messages.create')" />
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">@lang('messages.back')</a>
                </div>
            </form>
        </div>
    </div>
@endsection
