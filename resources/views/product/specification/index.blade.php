@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>Product specifications</h2>
            <hr>

            <table id="product-specification-table" class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>@lang('messages.name')</th>
                        <th>Value</th>
                        <th>Deleted</th>
                        <th>
                            <a href="{{ route('products.specifications.create', ['product' => $product->id]) }}" class="btn btn-outline-light fas fa-plus float-right"></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($specifications) > 0)
                        @foreach($specifications as $specification)
                            <tr id="{{ $specification->id }}">
                                <td>{{ $specification->name }}</td>
                                <td>{{ $specification->pivot->value }}</td>
                                <td id="is-deleted-column">
                                    @if (isset($specification->pivot->deleted_at))
                                        <i class="fas fa-check text-success"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.specifications.edit', ['product' => $product->id, 'specification' => $specification->id]) }}" class="btn btn-primary fas fa-edit"></a>

                                    @if (! isset($specification->pivot->deleted_at))
                                        <button class="btn btn-danger fas fa-trash" onclick="deleteSpecification({{ $product->id }}, {{ $specification->id }})"></button>
                                    @else
                                        <button class="btn btn-warning fas fa-trash-restore" onclick="restoreSpecification({{ $product->id }}, {{ $specification->id }})"></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" align="center">No result</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection