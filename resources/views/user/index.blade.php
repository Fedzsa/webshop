@extends('layouts.app')

@section('content')
    <div id="admin-list">
        <h2>@lang('messages.admins')</h2>

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>@lang('messages.name')</th>
                <th>@lang('messages.email')</th>
                <th>@lang('messages.registrated')</th>
                <th>
                    <a href="{{ route('users.admins.create') }}" class="btn btn-outline-light fas fa-plus float-right"></a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->getFullname() }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="paginator">
            {{ $admins->onEachSide(1)->links() }}
        </div>
    </div>

    <div id="user-list">
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
    </div>
@endsection
