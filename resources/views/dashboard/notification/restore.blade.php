<div id="notification-{{ $notification->id }}" class="alert alert-info notification" role="alert">
    <div>
        @lang('messages.restored-notification', [
            'link' => $notification->data['url'],
            'name' => $notification->data['name'],
            'time' => formatStringToDateTime($notification->data['created_at'])
        ])
    </div>
    
    <button class="btn btn-info" onclick="markAsRead('{{ $notification->id }}')">@lang('messages.mark-as-read')</button>
</div>