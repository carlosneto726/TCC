<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestsController extends Controller
{
    public function teste(){
        echo Str::uuid();
    }
}


