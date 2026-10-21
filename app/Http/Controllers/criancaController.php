<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\criancas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Http\Request;

class criancaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partos = partos::with('paciente')->latest()->get();
        $criancas = criancas::with('parto.paciente')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('nome', 'like', '%'.$search.'%')
                        ->orWhereHas('parto.paciente', fn ($patientQuery) => $patientQuery->where('nome', 'like', '%'.$search.'%'));
                });
            })
            ->when($request->filled('data'), fn ($query) => $query->whereDate('dataParto', $request->data))
            ->when($request->filled('genero'), fn ($query) => $query->where('genero', $request->genero))
            ->latest('dataParto')
            ->get();

        return view('visualizar.criancas', compact('criancas', 'partos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($parto = partos::find($request->input('partoID', $request->pacienteID))) {
            $Tnome = criancas::create([
                'nome' => $request->nome, 'dataParto' => $request->dataParto, 'peso' => $request->peso, 'hora' => $request->hora, 'genero' => $request->genero, 'partoID' => $parto->id,
            ]);

            alert()->info($Tnome['nome'], 'Criança, registada.');

            return redirect()->route('crianca.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        return redirect()->route('crianca.index', $request->only('search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $crianca = criancas::find($id);

        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('edit.crianca', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'crianca'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        if ($criancas = criancas::find($id)) {
            $criancas->update([
                'nome' => $request->nome, 'dataParto' => $request->dataParto, 'peso' => $request->peso, 'hora' => $request->hora, 'genero' => $request->genero,
            ]);

            alert()->info($criancas['nome'], 'Dados da Criança, actualizado.');

            return redirect()->route('crianca.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if ($criancas = criancas::find($id)) {
            $criancas->delete();

            alert()->info($criancas['nome'], 'Criança, apagada com sucesso.');

            return redirect()->route('crianca.index');
        }
    }
}
