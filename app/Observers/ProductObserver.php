<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\NewProduct;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * When created a new product send notifications for admins.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $admins = User::admins()->get();

        Notification::send($admins, new NewProduct($product));
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
