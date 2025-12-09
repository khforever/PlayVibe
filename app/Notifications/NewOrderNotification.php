<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
        // database = dashboard
        // mail = send mail
        // broadcast = real time via pusher
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id'    => $this->order->id,
            'client_name' => $this->order->user->name,
            'subtotal'    => $this->order->subtotal,
            'created_at'  => now()->toDateTimeString(),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'order_id'    => $this->order->id,
                'client_name' => $this->order->user->name,
                'subtotal'       => $this->order->subtotal,
                'created_at'  => now()->toDateTimeString(),
            ]
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Received')
            ->line('A new order has been placed.');
            // ->action('Open Order', url('orders/'));
    }
}
