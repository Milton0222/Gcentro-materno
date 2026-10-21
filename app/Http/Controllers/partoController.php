<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Http\Request;

class partoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pacientes = pacientes::orderBy('nome')->get();
        $partos = partos::with('paciente', 'criancas')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('tipo', 'like', '%'.$search.'%')
                        ->orWhere('estado', 'like', '%'.$search.'%')
                        ->orWhereHas('paciente', fn ($patientQuery) => $patientQuery->where('nome', 'like', '%'.$search.'%'));
                });
            })
            ->when($request->filled('data'), fn ($query) => $query->whereDate('created_at', $request->data))
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->estado))
            ->latest()
            ->get();

        return view('visualizar.partos', compact('partos', 'pacientes'));
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
    public function store(Request $request, $id)
    {
        //
        if ($paciente = pacientes::find($id)) {
            $verificar = partos::create([
                'tipo' => $request->tipo,
                'estado' => $request->estado,
                'pacienteID' => $id,
                'obs' => $request->obs,
            ]);
            $id = $verificar['id'];
            alert()->info($paciente['nome'], 'Parto registado,  registar a crriança.');

            return redirect()->route('parto.recem', $id);
        }
    }

    /** metodo buscar form store crianca */
    public function recem($id)
    {
        if ($parto = partos::find($id)) {

            $pacientec = pacientes::count();
            $consultac = consultas::count();
            $funcionarioc = User::count();
            $partoc = partos::count();

            return view('cadastro.criancas', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'parto'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $parto = partos::find($id);

        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('edit.partos', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'parto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        if ($parto = partos::find($id)) {
            $parto->update([
                'tipo' => $request->tipo,
                'estado' => $request->estado,
                'obs' => $request->obs,
            ]);

            alert()->info($parto['id'], 'Datos do parto, foram actualizado.');

            return redirect()->route('parto.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if ($parto = partos::find($id)) {
            $parto->delete();

            alert()->info($parto['id'], 'Datos do parto, foram apagados.');

            return redirect()->route('parto.index');
        }
    }
}
