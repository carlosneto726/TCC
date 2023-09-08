<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function teste(){

        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=filename.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        
        
        echo '<table border="1">';
        //make the column headers what you want in whatever order you want
        echo '<tr><th>Nome</th><th>Tel1</th><th>Cep</th></tr>';
        //loop the query data to the table in same order as the headers
        foreach (DB::select("SELECT nome, tel1, cep FROM tb_cooperativas") as $row){
            echo "<tr><td>".$row->nome."</td><td>".$row->tel1."</td><td>".$row->cep."</td></tr>";
        }
        echo '</table>';
    }

}
