<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class consultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pacientes = pacientes::orderBy('nome')->get();
        $consultas = consultas::with('paciente')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('tipoConsulta', 'like', '%'.$search.'%')
                        ->orWhere('classificacaoRisco', 'like', '%'.$search.'%')
                        ->orWhereHas('paciente', fn ($patientQuery) => $patientQuery
                            ->where('nome', 'like', '%'.$search.'%')
                            ->orWhere('contacto', 'like', '%'.$search.'%'));
                });
            })
            ->when($request->filled('data'), fn ($query) => $query->whereDate('dataConsulta', $request->data))
            ->when($request->filled('tipoConsulta'), fn ($query) => $query->where('tipoConsulta', $request->tipoConsulta))
            ->when($request->filled('classificacaoRisco'), fn ($query) => $query->where('classificacaoRisco', $request->classificacaoRisco))
            ->latest('dataConsulta')
            ->get();

        return view('visualizar.consultas', compact('consultas', 'pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function marcar(Request $request, $id)
    {
        //
          if($id==0)
               $id=$request->paciente_id;
            
        if ($paciente = pacientes::find($id)) {
             // dd($request->all(), date('H:i'));
            consultas::create([
                'pacienteID' => $id,
                'dataConsulta' => date('Y-m-d'),
                'hora' => date('h:i'),
                'doutor' => Auth::user()->name,
                'tipoConsulta' => $request->tipoConsulta,
                'valor' => 0,
                ...$request->only([
                    'queixaPrincipal',
                    'pressaoArterial',
                    'frequenciaCardiaca',
                    'frequenciaRespiratoria',
                    'temperatura',
                    'saturacaoOxigenio',
                    'peso',
                    'altura',
                    'idadeGestacionalSemanas',
                    'batimentosFetais',
                    'classificacaoRisco',
                    'observacoesTriagem',
                ]),
            ]);

            alert()->info($paciente['nome'], 'Consulta registada. consultar no painel consulta.');

            return redirect()->route('consulta.index');
        } else {

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //

        return redirect()->route('consulta.index', $request->only('search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $consulta = consultas::find($id);
        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('edit.consultas', compact('pacientec', 'consultac', 'funcionarioc', 'partoc', 'consulta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        if ($consulta = consultas::find($id)) {
            $consulta->update([
                'dataConsulta' => $request->dataConsulta,
                'hora' => $request->hora,
                'doutor' => $request->doutor,
                'tipoConsulta' => $request->tipoConsulta,
            ]);
            $consulta->update($request->only([
                'queixaPrincipal',
                'pressaoArterial',
                'frequenciaCardiaca',
                'frequenciaRespiratoria',
                'temperatura',
                'saturacaoOxigenio',
                'peso',
                'altura',
                'idadeGestacionalSemanas',
                'batimentosFetais',
                'classificacaoRisco',
                'observacoesTriagem',
            ]));
            alert()->info($consulta['id'], 'Dados desta consulta, foram actualizados.');

            return redirect()->route('consulta.index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if ($consulta = consultas::find($id)) {
            $consulta->delete();
            alert()->info($consulta['id'], 'Dados desta consulta, foram eliminados.');

            return redirect()->route('consulta.index');
        } else {
            return redirect()->back();
        }
    }
}
