<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Category;
use App\Helpers\ModelModification;

class ModifyCategory extends Notification implements ShouldQueue
{
    use Queueable;

    private const NEW_CATEGORY_MESSAGE = "New category has been added to the database.";
    private const UPDATED_CATEGORY_MESSAGE = "Category has been updated.";
    private const DELETED_CATEGORY_MESSAGE = "Category has been deleted.";
    private const RESTORED_CATEGORY_MESSAGE = "Category has been restored.";

    private Category $category;
    private int $modificationType;
    private string $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Category $category, int $modificationType)
    {
        $this->category = $category;
        $this->modificationType = $modificationType;
        $this->url = route('categories.edit', ['category' => $this->category->id]);
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

    /**
     * Store notification in the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable) {
        return [
            'id' => $this->category->id,
            'name' => $this->category->name,
            'modification_type' => $this->modificationType,
            'url' => $this->url,
            'created_at' => $this->category->created_at,
            'updated_at' => $this->category->updated_at,
            'deleted_at' => $this->category->deleted_at
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

        switch($this->modificationType) {
            case ModelModification::NEW: $message->line(self::NEW_CATEGORY_MESSAGE); break;
            case ModelModification::UPDATE: $message->line(self::UPDATED_CATEGORY_MESSAGE); break;
            case ModelModification::DELETE: $message->line(self::DELETED_CATEGORY_MESSAGE); break;
            case ModelModification::RESTORE: $message->line(self::RESTORED_CATEGORY_MESSAGE); break;
        }

        return $message->action('View', $this->url);
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
