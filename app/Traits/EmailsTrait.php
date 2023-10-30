<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Mail\EnviarEmail;
use Illuminate\Support\Facades\Mail;

trait EmailsTrait {
    public function enviarEmail($email, $titulo, $dados, $tipo){       
        Mail::to($email)->send(new EnviarEmail($titulo, $dados, $tipo));
    }
}
