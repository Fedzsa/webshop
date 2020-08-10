<?php

namespace App\Notifications;

use App\Models\Specification;
use Illuminate\Bus\Queueable;
use App\Helpers\ModelModification;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ModifySpecification extends Notification implements ShouldQueue
{
    use Queueable;

    private const NEW_SPECIFICATION_MESSAGE = 'New specification has been added to the database.';
    private const UPDATED_SPECIFICATION_MESSAGE = 'Specification has been updated.';
    private const DELETED_SPECIFICATION_MESSAGE = 'Specification has been deleted.';
    private const RESTORED_SPECIFICATION_MESSAGE = 'Specification has been restored.';

    private Specification $specification;
    private int $modificationType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Specification $specification, int $modificationType)
    {
        $this->specification = $specification;
        $this->modificationType = $modificationType;
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
            'id' => $this->specification->id,
            'name' => $this->specification->name,
            'modification_type' => $this->modificationType,
            'created_at' => $this->specification->created_at,
            'updated_at' => $this->specification->updated_at,
            'deleted_at' => $this->specification->deleted_at
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
            case ModelModification::NEW: $message->line(self::NEW_SPECIFICATION_MESSAGE); break;
            case ModelModification::UPDATE: $message->line(self::UPDATED_SPECIFICATION_MESSAGE); break;
            case ModelModification::DELETE: $message->line(self::DELETED_SPECIFICATION_MESSAGE); break;
            case ModelModification::RESTORE: $message->line(self::RESTORED_SPECIFICATION_MESSAGE); break;
        }

        return $message->action('View '.$this->specification->name, route('specifications.index'));
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
