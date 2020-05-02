<div class="card w-100 mb-3 p-3 shadow">
    <div class="row">
        <div class="col">
            <h6>{{ $comment->user->getFullname() }}</h6>
            <small>{{ $comment->created_at }}</small>
        </div>
        <div class="col">
            <button class="btn btn-info fa fa-edit float-right" onclick="commentToChangeable(event, {{ $product->id }}, {{ $comment->id }})"></button>
        </div>
    </div>
    <hr>
    <div id="comment-text">
        <p>{{ $comment->comment }}</p>
    </div>
</div>