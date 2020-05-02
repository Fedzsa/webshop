<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use App\Services\Comment\CommentServiceInterface;

class CommentController extends Controller
{
    private CommentServiceInterface $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;

        $this->middleware('auth');
    }

    public function store(StoreComment $request)
    {
        $comment = $this->commentService->store($request->validated());

        return view('product.comment', compact('comment'));
    }

    public function update(StoreComment $request, int $product, Comment $comment) 
    {
        $this->authorize('update', $comment);

        $this->commentService->update($comment, $request->validated());

        return response()->json(['updated' => true]);
    }
}
