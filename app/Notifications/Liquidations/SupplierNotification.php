<?php

namespace App\Notifications\Liquidations;

use App\Class\Util;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupplierNotification extends Notification
{
    use Queueable;

    protected $liquidation;
    protected $supplier;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->liquidation = $data['liquidation'];
        $this->supplier = $data['supplier'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->bcc(env('MAIL_FROM_ADDRESS'))
            ->subject('Liquidación de ventas ' . Util::getMonths()[$this->liquidation->month] . ' ' . $this->liquidation->year)
            ->markdown('mail.liquidation.supplier', ['liquidation' => $this->liquidation, 'supplier' => $this->supplier]);
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
