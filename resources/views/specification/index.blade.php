@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h2>{{ trans_choice('messages.specification', 2) }}</h2>
        </div>
        <div class="col">
            <form action="{{ route('specifications.index') }}" method="get">
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
            <table id="specification-table" class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>@lang('messages.name')</th>
                    <th>@lang('messages.deleted')</th>
                    <th>
                        <a href="{{ route('specifications.create') }}" class="btn btn-outline-light fas fa-plus float-right"></a>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @if (count($specifications) > 0)
                        @foreach ($specifications as $specification)
                            <tr id="{{ $specification->id }}">
                                <td>{{ $specification->id }}</td>
                                <td>{{ $specification->name }}</td>
                                <td id="is-deleted-column">
                                    @if($specification->trashed())
                                        <i class="fas fa-check text-success"></i>
                                    @endif
                                </td>
                                <td align="right">
                                    <a href="{{ route('specifications.edit', ['specification' => $specification->id]) }}" class="btn btn-primary fas fa-edit"></a>
                                    
                                    @if(!$specification->trashed())
                                        <button class="btn btn-danger fas fa-trash" onclick="deleteSpecification({{ $specification->id }})"></button>
                                    @else
                                        <button class="btn btn-warning fas fa-trash-restore" onclick="restoreSpecification({{ $specification->id }})"></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" align="center" >@lang('messages.no-result')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="paginator">
                {{ $specifications->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/specification.js') }}"></script>
@endsection
