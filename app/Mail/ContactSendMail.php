<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $title;
    private $contents;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->name = $inputs['name'];
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->contents = $inputs['contents'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from($this->email)
                ->subject('TetraCalibersへのお問い合わせ')
                ->view('front.contact.mail')
                ->with([
                    'name' => $this->name,
                    'email' => $this->email,
                    'title' => $this->title,
                    'contents' => $this->contents
                ]);

        return $this->view('view.name');
    }
}
