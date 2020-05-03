@extends('layouts.app')

@section('content')
    @foreach ($notifications as $notification)
        @if ($notification->type === 'App\Notifications\NewProduct')
            <div id="notification-{{ $notification->id }}" class="alert alert-success notification" role="alert">
                <div>
                    <a href="{{ route('products.show', ['product' => $notification->data['id']]) }}" class="alert-link" >{{ $notification->data['name'] }}</a> 
                    has been added to the database at 
                    <strong>{{ formatStringToDateTime($notification->data['created_at']) }}</strong>.
                </div>
                
                <button class="btn btn-info" onclick="markAsRead('{{ $notification->id }}')">Mark as read</button>
            </div>
        @endif
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection