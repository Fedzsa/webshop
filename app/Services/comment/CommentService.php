<?php

namespace App\Services\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentServiceInterface
{
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(array $attributes)
    {
        $comment = new Comment($attributes);

        $comment->user_id = Auth::user()->id;

        $comment->save();

        return $comment->load('user');
    }

    public function update(Comment $comment, array $attributes)
    {
        return $comment->update($attributes);
    }
}
