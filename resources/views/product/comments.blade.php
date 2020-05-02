<section id="comment-section">
    <div class="container-fluid shadow mt-5 p-5">
        <div class="row">
            <div class="col">
                <h4>Comments</h4>
                <hr>
                <div id="comment-editor">
                    <form>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <textarea name="comment" class="form-control" rows="5" placeholder="Leave comment here..."></textarea>
                        <button type="button" class="btn btn-success float-right mt-3" onclick="storeComment({{ $product->id }})">Comment</button>
                    </form>
                </div>
            
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col p-0">
                <div id="comments">
                    @foreach ($product->comments as $comment)
                        @include('product.comment')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>