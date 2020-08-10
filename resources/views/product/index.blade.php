@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col">
                <h2>@lang('messages.products')</h2>
            </div>
            <div class="col">
                <form action="{{ route('products.index') }}" method="get">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="float-right form-control mb-2" name="search" placeholder="Search..." value="{{ $search }}" />
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
                <table id="product-table" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>@lang('messages.name')</th>
                            <th>@lang('messages.price')</th>
                            <th>@lang('messages.description')</th>
                            <th>@lang('messages.deleted')</th>
                            <th><a href="{{ route('products.create') }}" class="btn btn-outline-light fas fa-plus float-right"></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr id="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ Str::words($product->description, 5, '...') }}</td>
                                    <td id="is-deleted-column">
                                        @if ($product->trashed())
                                            <i class="fas fa-check text-success"></i>
                                        @endif
                                    </td>
                                    <td align="right">
                                        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-primary fas fa-eye"></a>
                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary fas fa-edit"></a>
                                        <a href="{{ route('products.specifications.index', ['product' => $product->id]) }}" class="btn btn-primary fas fa-list-alt"></a>
                                        <a href="{{ route('products.images', ['product' => $product->id]) }}" class="btn btn-primary fas fa-images"></a>

                                        @if (! $product->trashed())
                                            <button class="btn btn-danger fas fa-trash" onclick="deleteProduct({{ $product->id }})" data-toggle="modal" data-target="#deleteModal"></button>
                                        @else
                                            <button class="btn btn-warning fas fa-trash-restore" onclick="restoreProduct({{ $product->id }})"></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center" >@lang('messages.no-result')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="paginator">
                    {{ $products->appends(['search' => $search])->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection