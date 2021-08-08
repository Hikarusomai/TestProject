<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Support\Facades\Mail;

class EmployeeCreate extends Notification
{
    use Queueable;
    use Notifiable;
    
    private $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)

    {

        $this->details = $details;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database']; 
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $details = $this->details;
        Mail::send(['html' => 'email.newemployee'], ['email'=>$details['body']],
                function ($message) use ($details) {
                $message->to($details['email'])
                // ->from(env('MAIL_FROM_ADDRESS','')) 
                ->subject('New employer Notification - TestProject');
        });
        return true;
        // return (new MailMessage)
        //     // ->cc($this->details['email'])
        //     ->subject('New employer Notification - TestProject')
        //     ->greeting($this->details['greeting'])
        //     ->line($this->details['body']);
        //     // ->line($this->details['thanks']);
 
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)

    {

        return [

            'company_id' => $this->details['id']

        ];

    }

}
