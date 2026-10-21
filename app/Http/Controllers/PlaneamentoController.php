<?php

namespace App\Http\Controllers;

use App\Models\pacientes;
use App\Models\Planeamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaneamentoController extends Controller
{
    public function index(Request $request)
    {
        $pacientes = pacientes::orderBy('nome')->get();
        $planeamentos = Planeamento::with('paciente')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('metodo', 'like', '%'.$search.'%')
                        ->orWhereHas('paciente', fn ($patientQuery) => $patientQuery->where('nome', 'like', '%'.$search.'%'));
                });
            })
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->estado))
            ->when($request->filled('metodo'), fn ($query) => $query->where('metodo', $request->metodo))
            ->when($request->filled('data'), fn ($query) => $query->whereDate('dataPlaneamento', $request->data))
            ->latest('dataPlaneamento')
            ->get();

        return view('visualizar.planeamentos', compact('pacientes', 'planeamentos'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePlaneamento($request);

        Planeamento::create($validated);
        alert()->success('Planeamento familiar', 'Registo criado com sucesso.');

        return redirect()->route('planeamento.index');
    }

    public function update(Request $request, Planeamento $planeamento)
    {
        $request->merge(['planeamentoID' => $planeamento->id]);
        $validated = $this->validatePlaneamento($request, 'planeamentoEdit');
        $planeamento->update($validated);

        alert()->success('Planeamento familiar', 'Registo actualizado com sucesso.');

        return redirect()->route('planeamento.index');
    }

    private function validatePlaneamento(Request $request, string $errorBag = 'default'): array
    {
        return Validator::make($request->all(), [
            'pacienteID' => ['required', 'exists:pacientes,id'],
            'dataPlaneamento' => ['required', 'date'],
            'metodo' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'proximaData' => ['nullable', 'date', 'after_or_equal:dataPlaneamento'],
            'observacoes' => ['nullable', 'string'],
        ])->validateWithBag($errorBag);
    }
}
