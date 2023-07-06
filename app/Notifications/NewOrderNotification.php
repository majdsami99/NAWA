<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;
    var \App\Models\Order
    protected $order;


    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
$this->order=@$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        ///mail,database,broadcast,vong (sms),slack فالشرح كل واحدة على حدا
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('new order #'.$this->order->id)
                    ->greeting('Hello'.$notifiable->name)
                    ->line('A new order  has been created')
                    ->action('View order', route('orders.show',$this->order->id))

                    ->line('Thank you for using our application!');
    }
    public function toDatabase(object $notifiable):DatabaseMessage{
        return new DatabaseMessage([
            'body'=>" A new order #{$this->order->id} has been created . "
            'icon'=>
        ])
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
