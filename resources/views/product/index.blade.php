@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col">
                <h2>@lang('messages.products')</h2>
            </div>
            <div class="col">
                <form action="{{ route('products') }}" method="get">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="float-right form-control mb-2" name="search" placeholder="Search..." value="{{ $searchedText }}" />
                        </div>
                        <div class="col-3">
                            <input type="submit" class="btn btn-success form-control" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>@lang('messages.name')</th>
                            <th>@lang('messages.price')</th>
                            <th>@lang('messages.description')</th>
                            <th><a href="{{ route('create-product') }}" class="btn btn-outline-light fas fa-plus"></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->getTruncatedDescription() }}</td>
                                <td>
                                    <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="fas fa-edit"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <div class="paginator">
                    {{ $products->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
@endsection