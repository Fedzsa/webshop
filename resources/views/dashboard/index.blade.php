@extends('layouts.app')

@section('content')
    @foreach ($notifications as $notification)
        @switch($notification->data['modification_type'])
            @case(ModelModification::NEW)
                @include('dashboard.notification.new')
                @break
            @case(ModelModification::UPDATE)
                @include('dashboard.notification.update')
                @break
            @case(ModelModification::DELETE)
                @include('dashboard.notification.delete')
                @break
            @case(ModelModification::RESTORE)
                @include('dashboard.notification.restore')
                @break
        @endswitch
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection