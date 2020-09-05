@extends('layouts.app')

@section('content')
    <div id="notification-info-card">
        <div class="row">
            <div class="col">
                @lang('messages.notification-info', ['value' => count($notifications)])
            </div>
            <div class="col">
                <button class="btn btn-primary" onclick="markAllAsRead()">@lang('messages.mark-all-as-read')</button>
            </div>
        </div>
    </div>

    <div id="notification-panel">
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection
