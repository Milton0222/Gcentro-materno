<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\criancas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    function relatorios(HttpRequest $request)
    {
        $tipor = "";
        $femenino = 0;
        $masculino = 0;
        $dataactual = date('d-m-Y');

        if ($request->tipo == 1) {
            $tipor = "Geral";
            $criancas = criancas::get();

            foreach ($criancas as $listac) {
                if ($listac->genero == 'F')
                    $femenino += 1;
                else
                    $masculino += 1;
            }


            $pacientes = pacientes::get();
            $partos = partos::get();
            $consultas = consultas::get();
        }
        if ($request->tipo == 2) {
            $tipor = "Diario";
            $sqlc = "SELECT *FROM criancas WHERE day(dataParto)=$request->dia";

            $criancas = DB::select($sqlc);

            foreach ($criancas as $listac) {
                if ($listac->genero == 'F')
                    $femenino += 1;
                else
                    $masculino += 1;
            }


            $sqlp = "SELECT *  FROM partos WHERE day(created_at)=$request->dia";

            $partos = DB::select($sqlp);

            $sqlct = "SELECT * FROM consultas WHERE day(dataConsulta)=$request->dia";

            $consultas = DB::select($sqlct);

            $sqlp = "SELECT * FROM pacientes WHERE day(created_at)=$request->dia";
            $pacientes = DB::select($sqlp);
        }
        if ($request->tipo == 3) {
            $tipor = "Mensal";

            $mess = explode('-', $request->mes);
            $sqlc = "SELECT * FROM criancas WHERE month(dataParto)=$mess[1]";

            $criancas = DB::select($sqlc);

            foreach ($criancas as $listac) {
                if ($listac->genero == 'F')
                    $femenino += 1;
                else
                    $masculino += 1;
            }

            $sqlp = "SELECT * FROM partos WHERE month(created_at)=$mess[1]";

            $partos = DB::select($sqlp);

            $sqlct = "SELECT * FROM consultas WHERE month(dataConsulta)=$mess[1]";

            $consultas = DB::select($sqlct);


            $sqlp = "SELECT * FROM pacientes WHERE month(created_at)=$mess[1]";
            $pacientes = DB::select($sqlp);
        }





        return view('anexos.relatorios', compact('femenino', 'masculino', 'pacientes', 'partos', 'consultas', 'tipor', 'dataactual'));
    }


    function dashboard(HttpRequest $request)
    {

        $genero = [];
        $quantidade = [];

        $mess = explode('-', $request->mes);
        $sqlc = "SELECT * FROM criancas WHERE month(dataParto)=$mess[1]";

        $criancas = DB::select($sqlc);



        $sql = "SELECT criancas.genero, COUNT(criancas.genero) as 'qtd'
                FROM criancas
                WHERE month(created_at)=$mess[1]
                GROUP BY criancas.genero;";

        $generos = DB::select($sql);

        foreach ($generos as $lista) {
            $genero[] = $lista->genero;
            $quantidade[] = $lista->qtd;
        }

        $gnome = implode("','", $genero);
        $gqtd = implode("','", $quantidade);



        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();



        return view('dashboard', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'criancas', 'gnome', 'gqtd'));
    }
}
