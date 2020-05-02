@extends('layouts.app')

@section('content')
    <div class="container-fluid shadow p-5">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>{{ $product->name }}</h2>
                        <small>{{ $product->created_at }}</small>
                    </div>
                    <div class="col">
                        <h2 class="float-right">{{ $product->price }}$</h2>
                    </div>
                </div>
                <hr>
                
                <div class="row">
                    <div class="col">
                        <h5>Images</h5>
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for ($i = 0; $i < count($product->files); $i++)
                                    <li data-target="#imageCarousel" data-slide-to="{{ $i }}" {{ $i === 0 ? 'class=active' : ''}}></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($product->files as $file)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ asset('storage/'.$file->name) }}" class="d-block w-100" alt="{{ $file->name }}" height="500">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <h5>Specifications</h5>
                        <table class="table table-striped table-bordered">
                            <tbody>
                                @foreach ($product->specifications as $specification)
                                    <tr>
                                        <th>{{ $specification->name }}</th>
                                        <td>{{ $specification->pivot->value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>

    @include('product.comments')
@endsection

@section('script')
    <script src="{{ asset('js/comment.js') }}"></script>
@endsection