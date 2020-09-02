<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Helpers\ModelModification;

class ModifyProduct extends Notification implements ShouldQueue
{
    use Queueable;

    private const NEW_PRODUCT_MESSAGE = 'New product has been added to the database.';
    private const UPDATED_PRODUCT_MESSAGE = 'Product has been updated.';
    private const DELETED_PRODUCT_MESSAGE = 'Product has been deleted.';
    private const RESTORED_PRODUCT_MESSAGE = 'Product has been restored.';

    private Product $product;
    private int $modificationType;
    private string $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product, int $modificationType)
    {
        $this->product = $product;
        $this->modificationType = $modificationType;
        $this->url = route('products.edit', ['product' => $this->product->id]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'modification_type' => $this->modificationType,
            'url' => $this->url,
            'created_at' => $this->product->created_at,
            'updated_at' => $this->product->updated_at,
            'deleted_at' => $this->product->deleted_at,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->greeting('Hello!');

        switch ($this->modificationType) {
            case ModelModification::NEW:
                $message->line(self::NEW_PRODUCT_MESSAGE);
                break;
            case ModelModification::UPDATE:
                $message->line(self::UPDATED_PRODUCT_MESSAGE);
                break;
            case ModelModification::DELETE:
                $message->line(self::DELETED_PRODUCT_MESSAGE);
                break;
            case ModelModification::RESTORE:
                $message->line(self::RESTORED_PRODUCT_MESSAGE);
                break;
        }

        return $message->action('View ' . $this->product->name, $this->url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
                //
            ];
    }
}
