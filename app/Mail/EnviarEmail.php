<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $titulo;
    public $dados;
    public $tipo;
    public function __construct($titulo, $dados, $tipo)
    {
        $this->titulo = $titulo;
        $this->dados = $dados;
        $this->tipo = $tipo;
    }
    public function build()
    {
        return $this->subject($this->titulo)
                    ->view('emails.'.$this->tipo)
                    ->with(['dados' => $this->dados]);
    }
}
