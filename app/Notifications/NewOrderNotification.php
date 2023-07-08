<?php

namespace App\Notifications;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewOrderNotification extends Notification
{
    use Queueable;
    /**
     * @var \App\Models\Order
     */

    protected $order;


    /**
     * Create a new notification instance.
     */
    public function __construct(order $order)
    {
      $this->order=@$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {  //notifiable هو الاوبجكت من اليوزر
        ///mail,database,broadcast,vong (sms),slack فالشرح كل واحدة على حدا
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    { ///شانل خاصة لبناء الايميل
        return (new MailMessage)
                    ->subject('new order #'.$this->order->id) //لو ما وضعناها  لارفل رح تستخدم اسم الكلاس ك سبجكت
                    ->greeting('Hello'.$notifiable->name)
                    ->line('A new order  has been created')  //فقرة داخل الرسالة
                    ->action('View order', route('orders.show',$this->order->id))  //زر داخل الرسالة بوديني عمكان اخر

                    ->line('Thank you for using our application!'); /// فقرة ثانية
    }

    public function toDatabase(object $notifiable):DatabaseMessage
    {
        return new DatabaseMessage([
            'body'=>" A new order #{$this->order->id} has been created . ",
            'icon'=> 'fas fa-envelope',
            'link'=>route('orders.show',$this->order->id),

        ]);
    }
    public function toBroadcast(object $notifiable): BroadcastMessage {}
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
