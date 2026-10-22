<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Http\Request;

class pacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pacientes = pacientes::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('nome', 'like', '%'.$search.'%')
                        ->orWhere('contacto', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('genero'), fn ($query) => $query->where('genero', $request->genero))
            ->when($request->filled('tipoPaciente'), fn ($query) => $query->where('tipoPaciente', $request->tipoPaciente))
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->estado))
            ->orderBy('nome')
            ->get();

        return view('visualizar.pacientes', compact('pacientes'));
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

        $paciente = pacientes::create([
            'nome' => $request->nome,
            'contacto' => $request->contacto,
            'genero' => $request->genero,
            'dataNascimento' => $request->nascimento,
            'morada' => $request->morada,
        ]);

        alert()->info($paciente['nome'], 'Registado, com sucesso.');

        return redirect()->route('paciente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        return redirect()->route('paciente.index', $request->only('search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $paciente = pacientes::find($id);

        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('edit.pacientes', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'paciente'));
    }

    public function storeShow()
    {
        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('cadastro.paciente', compact('pacientec', 'consultac', 'funcionarioc', 'partoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        if ($paciente = pacientes::find($id)) {
            $paciente->update([
                'nome' => $request->nome,
                'contacto' => $request->contacto,
                'genero' => $request->genero,
                'dataNascimento' => $request->nascimento,
                'morada' => $request->morada,
                'saude' => $request->saude,
                'tipoPaciente' => $request->tipo_paciente,
                'estado' => $request->estado,
            ]);

            alert()->info($paciente['nome'], 'Dados actualizados, com sucesso.');

            return redirect()->route('paciente.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if ($paciente = pacientes::find($id)) {
            $paciente->delete();
            alert()->info($paciente['nome'], 'Dados apagados, com sucesso.');

            return redirect()->route('paciente.index');

        } else {
            alert()->warning('Apagando...', 'Dados não, encontrado.');

            return redirect()->route('paciente.index');
        }
    }
}
