<div id="notification-{{ $notification->id }}" class="alert alert-warning notification" role="alert">
    <div>
        <a href="{{ route('products.show', ['product' => $notification->data['id']]) }}" class="alert-link" >{{ $notification->data['name'] }}</a> 
        has been updated at 
        <strong>{{ formatStringToDateTime($notification->data['updated_at']) }}</strong>.
    </div>
    
    <button class="btn btn-info" onclick="markAsRead('{{ $notification->id }}')">Mark as read</button>
</div>