@extends('layouts.app')

@section('content')
    <h2>@lang('messages.users')</h2>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>@lang('messages.name')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->getFullname() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection