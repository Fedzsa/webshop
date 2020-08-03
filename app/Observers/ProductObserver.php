<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ModifyProduct;
use Illuminate\Support\Facades\Notification;
use App\Helpers\ModelModification;

class ProductObserver
{
    /**
     * When created a new product send notifications for admins.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $admins = User::admins()->get();

        Notification::send($admins, new ModifyProduct($product, ModelModification::NEW));
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $admins = User::admins()->get();

        Notification::send($admins, new ModifyProduct($product, ModelModification::UPDATE));
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $admins = User::admins()->get();

        Notification::send($admins, new ModifyProduct($product, ModelModification::DELETE));
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $admins = User::admins()->get();

        Notification::send($admins, new ModifyProduct($product, ModelModification::RESTORE));
    }
}
