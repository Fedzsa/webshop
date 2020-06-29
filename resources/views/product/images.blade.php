@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/image.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h2>@lang('messages.product-images', ['name' => $product->name])</h2>
            <hr>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('products.images.store', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf()

                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input id="image-input" type="file" name="image" class="custom-file-input" onchange="writeOutFileName()">
                        <label id="image-label" class="custom-file-label" for="image">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-success input-group-text" value="Upload" />
                    </div>
                </div>
            </form>

            <div class="container mt-5">
                <div class="row">
                    @foreach ($images as $image)
                        <div id="image-{{ $image->id }}" class="col">
                            <div>
                                <button class="btn btn-danger btn-delete fas fa-trash" onclick="deleteImage({{ $product->id }}, {{ $image->id }})"></button>
                                <img src="{{ asset('storage/'.$image->name) }}" alt="{{ $image->name }}" width="300" height="300" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection