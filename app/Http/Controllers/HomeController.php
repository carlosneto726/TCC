<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class HomeController extends Controller
{
    public function index(){
        $produtos = DB::select("SELECT * FROM tb_produtos WHERE quantidade > 100 AND status = 1 ORDER BY likes DESC");
        return view('home.home', compact('produtos'));
    }
}
