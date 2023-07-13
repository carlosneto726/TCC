<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;
    public $tipo;
    public function __construct($dados, $tipo)
    {
        $this->dados = $dados;
        $this->tipo = $tipo;
    }
    public function build()
    {
        return $this->subject('Pedido Email')
                    ->view('emails.'.$this->tipo)
                    ->with(['dados' => $this->dados]);
    }
}
