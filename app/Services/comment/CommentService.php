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

    /**
     * Store new comment.
     *
     * @param array $attributes The comment attributes.
     * @return Comment Return the saved comment with user.
     */
    public function store(array $attributes): Comment
    {
        $comment = new Comment($attributes);

        $comment->user_id = Auth::user()->id;

        $comment->save();

        return $comment->load('user');
    }

    /**
     * Update the comment.
     *
     * @param Comment $comment
     * @param array $attributes
     * @return bool
     */
    public function update(Comment $comment, array $attributes): bool
    {
        return $comment->update($attributes);
    }
}
