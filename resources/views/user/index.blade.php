@extends('layouts.app')

@section('content')
    <h2>@lang('messages.users')</h2>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>@lang('messages.name')</th>
                <th>@lang('messages.email')</th>
                <th>@lang('messages.registrated')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->getFullname() }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="paginator">
        {{ $users->onEachSide(1)->links() }}
    </div>
@endsection