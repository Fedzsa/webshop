@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>@lang('messages.categories')</h2>
        </div>
        <div class="col">
            <form action="{{ route('categories') }}" method="get">
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
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $categories)
                    <tr>
                        <td>{{ $categories->id }}</td>
                        <td>{{ $categories->name }}</td>
                        <td>

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
