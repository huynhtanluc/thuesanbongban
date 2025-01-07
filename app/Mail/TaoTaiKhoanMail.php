<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaoTaiKhoanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tille;
    public $view;
    public $data;

    public function __construct($title, $view, $data)
    {
        $this->tille = $title;
        $this->view = $view;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->tille)->view($this->view, ['data' => $this->data]);
    }


}
