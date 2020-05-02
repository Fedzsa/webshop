<?php

namespace App\Services\Comment;

use App\Models\Comment;

interface CommentServiceInterface {
    function store(array $attributes);
    function update(Comment $comment, array $attributes);
}