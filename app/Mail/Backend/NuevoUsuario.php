<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevoUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.mail.nueva_usuarios');
    }
}
