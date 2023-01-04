<?php

namespace App\Listeners;

use App\Events\SendMailForgotPasswordEvent;
use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailForgotPasswordListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMailForgotPasswordEvent  $event
     * @return void
     */
    public function handle(SendMailForgotPasswordEvent $event)
    {
        $url = env('APP_URL'). '/password-reset?token=' . $event->token;
        Mail::to('junimhs10@gmail.com')->send(new ForgotPasswordMail($url, $event->name));
    }
}
