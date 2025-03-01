<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MiCorreo extends Mailable {
    use Queueable, SerializesModels;

    public $url;
    public $subject;

    public function __construct($subject, $url) {
        $this->subject = $subject;
        $this->url = $url;
    }

    public function build() {
        return $this->from(config('mail.from.address'))
                    ->subject($this->subject)
                    ->view('emails.mi_correo', ['url' => $this->url]);
    }
}
