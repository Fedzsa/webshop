@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>@lang('messages.categories')</h2>
        </div>
        <div class="col">
            <form action="{{ route('categories.index') }}" method="get">
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
            <table id="category-table" class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.deleted')</th>
                        <th>
                            <a href="{{ route('categories.create') }}" class="btn btn-outline-light fas fa-plus"></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr id="{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->trashed())
                                    <i class="fas fa-check text-success"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary fas fa-edit"></a>
                                @if(! $category->trashed())
                                    <a href="{{ route('categories.delete', ['category' => $category->id]) }}" class="btn btn-danger fas fa-trash"></a>
                                @else
                                    <button class="btn btn-warning fas fa-trash-restore" onclick="restore({{ $category->id }})"></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="paginator">
                {{ $categories->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
