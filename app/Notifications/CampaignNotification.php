<?php

namespace App\Notifications;

use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampaignNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Campaign $campaign;
    public Contact $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign, Contact $contact)
    {
        $this->campaign = $campaign;
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(str_replace(['%first_name%', '%last_name%'], [$this->contact->first_name, $this->contact->last_name], $this->campaign->subject))
            ->view('mails.campaign', [
                'campaign' => $this->campaign,
                'contact' => $this->contact
            ]);
    }
}
