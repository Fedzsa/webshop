<div id="notification-{{ $notification->id }}" class="alert alert-warning notification" role="alert">
    <div>
        @lang('messages.updated-notification', [
            'link' => route('products.show', ['product' => $notification->data['id']]),
            'name' => $notification->data['name'],
            'time' => formatStringToDateTime($notification->data['created_at'])
        ])
    </div>
    
    <button class="btn btn-info" onclick="markAsRead('{{ $notification->id }}')">@lang('messages.mark-as-read')</button>
</div>