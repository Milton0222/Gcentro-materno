<?php

use App\Http\Controllers\consultaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\criancaController;
use App\Http\Controllers\funcionariosController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\partoController;
use App\Http\Controllers\PlaneamentoController;
use App\Models\consultas;
use App\Models\criancas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $pacientec = pacientes::count();
    $consultac = consultas::count();
    $funcionarioc = User::count();
    $partoc = partos::count();



    return view('welcome', compact('pacientec','consultac','partoc'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', function () {

        $genero=[];
        $quantidade=[];

        $criancas = criancas::get();

        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        $sql = "SELECT criancas.genero, COUNT(criancas.genero) as 'qtd'
        FROM criancas
      
        GROUP BY criancas.genero;";

        $generos = DB::select($sql);

        foreach ($generos as $lista) {
            $genero[] = $lista->genero;
            $quantidade[] = $lista->qtd;
        }

        $gnome = implode("','", $genero);
        $gqtd = implode("','", $quantidade);



        return view('dashboard', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'criancas', 'gnome', 'gqtd'));
    })->name('dashboard');



   


    Route::middleware(['secretario'])->group(function(){

         /** Gestao de paciente */
    Route::get('/pacientes', [pacienteController::class, 'index'])->name('paciente.index');
    Route::get('/paciente/cadastro', [pacienteController::class, 'storeShow'])->name('paciente.storeShow');
    Route::post('/paciente/store', [pacienteController::class, 'store'])->name('paciente.store');
    Route::get('/paciente/show', [pacienteController::class, 'show'])->name('paciente.show');
    Route::get('/paciente/edit/{id}', [pacienteController::class, 'edit'])->name('paciente.edit');
   

  

    /**gerir parto */

    Route::get('/partos', [partoController::class, 'index'])->name('parto.index');
    Route::post('/parto/store/{id}', [partoController::class, 'store'])->name('parto.store');
    Route::get('/parto/recem/{id}', [partoController::class, 'recem'])->name('parto.recem');
    Route::get('/parto/edit/{id}', [partoController::class, 'edit'])->name('parto.edit');
    


    /*gerir <crianca>*/
    Route::get('/crianças', [criancaController::class, 'index'])->name('crianca.index');
    Route::post('/criança/store', [criancaController::class, 'store'])->name('crianca.store');
    Route::get('/crianca/show', [criancaController::class, 'show'])->name('crianca.show');
    Route::get('/criança/edit/{id}', [criancaController::class, 'edit'])->name('crianca.edit');

    Route::get('/planeamentos', [PlaneamentoController::class, 'index'])->name('planeamento.index');
    Route::post('/planeamento/store', [PlaneamentoController::class, 'store'])->name('planeamento.store');
    Route::put('/planeamento/update/{planeamento}', [PlaneamentoController::class, 'update'])->name('planeamento.update');

          /** gerir consults */

    Route::get('/consultas', [consultaController::class, 'index'])->name('consulta.index');
    Route::post('/consulta/marcar/{id}', [consultaController::class, 'marcar'])->name('consulta.marcar');
    Route::get('/consulta/show', [consultaController::class, 'show'])->name('consulta.show');
    Route::get('/consulta/edit/{id}', [consultaController::class, 'edit'])->name('consulta.edit');



    });

    Route::middleware(['root'])->group(function () {

        //gerir crinca

        
        Route::put('/criança/update/{id}', [criancaController::class, 'update'])->name('crianca.update');
        Route::delete('/criança/delete/{id}', [criancaController::class, 'destroy'])->name('crianca.destroy');

        //paciente
        
        Route::put('/paciente/update/{id}', [pacienteController::class, 'update'])->name('paciente.update');
        Route::delete('/paciente/destroy/{id}', [pacienteController::class, 'destroy'])->name('paciente.destroy');

        //consulta 
       
        Route::delete('/consulta/delete/{id}', [consultaController::class, 'destroy'])->name('consulta.destroy');
        Route::put('/consulta/update/{id}', [consultaController::class, 'update'])->name('consulta.update');

        //crianca 

        //parto
      
        Route::put('/parto/update/{id}', [partoController::class, 'update'])->name('parto.update');
        Route::delete('/parto/delete/{id}', [partoController::class, 'destroy'])->name('parto.destroy');

        /** gerir funcionarios */

        Route::get('/funcionarios/show', [funcionariosController::class, 'index'])->name('funcionario.index');
        Route::get('/funcionario/create', [funcionariosController::class, 'create'])->name('funcionario.create');
        Route::post('/funcionario/store', [funcionariosController::class, 'store'])->name('funcionario.store');
        Route::get('/funcionario/search', [funcionariosController::class, 'search'])->name('funcionario.search');
        Route::get('/funcionario/edit/{id}', [funcionariosController::class, 'edit'])->name('funcionario.edit');
        Route::put('/funcionario/update/{id}', [funcionariosController::class, 'update'])->name('funcionario.update');
    });


    Route::middleware(['estatistico'])->group(function () {

        /**Relatorios */

        Route::get('/relatorios/emitir', [Controller::class, 'relatorios'])->name('relatorio.ver');
        Route::get('/crainças/genero', [Controller::class, 'dashboard'])->name('crianca.genero');
    });
});
