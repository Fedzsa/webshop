<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Specification;
use App\Helpers\ModelModification;
use App\Notifications\ModifySpecification;
use Illuminate\Support\Facades\Notification;

class SpecificationObserver
{
    public function created(Specification $specification)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifySpecification($specification, ModelModification::NEW)
        );
    }

    public function updated(Specification $specification)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifySpecification($specification, ModelModification::UPDATE)
        );
    }

    public function deleted(Specification $specification)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifySpecification($specification, ModelModification::DELETE)
        );
    }

    public function restored(Specification $specification)
    {
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new ModifySpecification($specification, ModelModification::RESTORE)
        );
    }
}
