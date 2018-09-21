<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $parametros;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parametros)
    {
        $this->parametros = $parametros;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from('contato@mostrame.com.br');
        $this->subject("Contato via site Mostráme");
        return $this->view('emails.contato')->with("parametros", $this->parametros);
    }
}
