<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('home');
    }

    public function carrinho(){
        return view('carrinho');
    }

    public function pesquisa(){
        $pesquisa = request("pesquisa");
        return view('pesquisa', compact('pesquisa'));
    }

    public function login(){
        return view('login_cadastro.login');
    }

    public function cadastro(){
        return view('login_cadastro.cadastro');
    }

    public function cadastro_usuario(){
        return view('login_cadastro.cadastro_usuario');
    }
    
    public function cadastro_cooperativa(){
        return view('login_cadastro.cadastro_cooperativa');
    }
}
