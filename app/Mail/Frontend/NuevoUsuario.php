<?php

namespace App\Mail\Frontend;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Auth\User;

class NuevoUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.mail.nuevo_usuario');
    }
}
