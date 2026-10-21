<?php

namespace App\Http\Controllers;

use App\Models\consultas;
use App\Models\pacientes;
use App\Models\partos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class funcionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('isAdmin', 0)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('perfil'), function ($query) use ($request) {
                $column = match ($request->perfil) {
                    'secretaria' => 'isSecretaria',
                    'responsavel' => 'isResponsavel',
                    'estatistico' => 'isEstatistico',
                    default => null,
                };

                if ($column) {
                    $query->where($column, true);
                }
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('visualizar.funcionarios', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('cadastro.funcionario', compact('pacientec', 'consultac', 'funcionarioc', 'partoc'));
    }

    public function search(Request $request)
    {
        return redirect()->route('funcionario.index', $request->only('search'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($verificar = User::where('email', $request->email)->first()) {
            Alert()->warning($verificar['name'], 'Este email já foi usado.');

            return redirect()->back();
        } else {

            if ($request->tipo == 2) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'genero' => $request->genero,
                    'isSecretaria' => 1,
                    'password' => Hash::make(123456789),
                ]);

                Alert()->info($user['name'], 'Secretario(a)/Registado com sucesso.');

                return redirect()->route('funcionario.index');

            } elseif ($request->tipo == 3) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'genero' => $request->genero,
                    'isResponsavel' => 1,
                    'password' => Hash::make(123456789),
                ]);

                Alert()->info($user['name'], 'Responsavel de sala/Registado com sucesso.');

                return redirect()->route('funcionario.index');

            } elseif ($request->tipo == 4) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'genero' => $request->genero,
                    'isEstatistico' => 1,
                    'password' => Hash::make(123456789),
                ]);

                Alert()->info($user['name'], 'Estatistico/Registado com sucesso.');

                return redirect()->route('funcionario.index');

            } else {
                Alert()->warning('Registar Funcionario', 'Nivel de acesso invalido.');

                return redirect()->back();

            }

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $users = User::find($id);
        $pacientec = pacientes::count();
        $consultac = consultas::count();
        $funcionarioc = User::count();
        $partoc = partos::count();

        return view('edit.funcionario', compact('users', 'pacientec', 'consultac', 'funcionarioc', 'partoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        if ($users = User::find($id)) {

            if ($request->desabilitar) {
                $users->update([
                    'isSecretaria' => 0,
                    'isResponsavel' => 0,
                    'isEstatistico' => 0,
                ]);

                alert()->info($users['name'], 'Utilizador desabilitado.');

                return redirect()->route('funcionario.edit', $id);

            }if ($request->secretario && $request->responsavel && $request->estatistico) {
                $users->update([
                    'name' => $request->name,
                    'genero' => $request->genero,
                    'email' => $request->email,
                    'isSecretaria' => 1,
                    'isResponsavel' => 1,
                    'isEstatistico' => 1,
                ]);

                alert()->info($users['name'], 'Dados actualizados com sucesso.');

                return redirect()->route('funcionario.edit', $id);

            }if ($request->secretario) {
                $users->update([
                    'name' => $request->name,
                    'genero' => $request->genero,
                    'email' => $request->email,
                    'isSecretaria' => 1,
                    'isResponsavel' => 0,
                    'isEstatistico' => 0,
                ]);

                alert()->info($users['name'], 'Dados do secretario actualizados com sucesso.');

                return redirect()->route('funcionario.edit', $id);

            }if ($request->responsavel) {

                $users->update([
                    'name' => $request->name,
                    'genero' => $request->genero,
                    'email' => $request->email,
                    'isSecretaria' => 0,
                    'isResponsavel' => 1,
                    'isEstatistico' => 0,
                ]);

                alert()->info($users['name'], 'Dados do reponsavel actualizados com sucesso.');

                return redirect()->route('funcionario.edit', $id);

            }if ($request->estatistico) {
                $users->update([
                    'name' => $request->name,
                    'genero' => $request->genero,
                    'email' => $request->email,
                    'isSecretaria' => 0,
                    'isResponsavel' => 0,
                    'isEstatistico' => 1,
                ]);

                alert()->info($users['name'], 'Dados do  estatistico com sucesso.');

                return redirect()->route('funcionario.edit', $id);

            } else {
                $users->update([
                    'name' => $request->name,
                    'genero' => $request->genero,
                    'email' => $request->email,
                ]);
                alert()->info($users['name'], 'Dados actualizados com sucesso.');

                return redirect()->route('funcionario.edit', $id);

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
