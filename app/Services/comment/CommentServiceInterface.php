<?php

namespace App\Services\Comment;

use App\Models\Comment;

interface CommentServiceInterface
{
    function store(array $attributes): Comment;
    function update(Comment $comment, array $attributes): bool;
}
