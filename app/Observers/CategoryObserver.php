<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Category;
use App\Notifications\ModifyCategory;
use App\Helpers\ModelModification;
use Illuminate\Support\Facades\Notification;

class CategoryObserver
{
    public function created(Category $category)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifyCategory($category, ModelModification::NEW)
        );
    }

    public function updated(Category $category)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifyCategory($category, ModelModification::UPDATE)
        );
    }

    public function deleted(Category $category)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifyCategory($category, ModelModification::DELETE)
        );
    }

    public function restored(Category $category)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifyCategory($category, ModelModification::RESTORE)
        );
    }
}
