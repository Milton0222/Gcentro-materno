<x-app-layout>
    @section('corpo')
        <section class="corpo entity-management">
            <div class="management-heading">
                <div><span class="management-kicker">ADMINISTRAÇÃO DO SISTEMA</span><h1>Equipa e utilizadores</h1><p>Consulte os utilizadores e os perfis de acesso do centro.</p></div>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#user-create"><i class="bx bx-user-plus" aria-hidden="true"></i> Novo utilizador</button>
            </div>

            <form class="entity-filters" action="{{ route('funcionario.index') }}" method="get">
                <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Nome ou email"></label>
                <select name="perfil" aria-label="Filtrar por perfil">
                    <option value="">Todos os perfis</option>
                    <option value="secretaria" @selected(request('perfil') === 'secretaria')>Secretaria</option>
                    <option value="responsavel" @selected(request('perfil') === 'responsavel')>Responsável de sala</option>
                    <option value="estatistico" @selected(request('perfil') === 'estatistico')>Estatístico</option>
                </select>
                <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
                @if (request()->query())<a class="filter-clear" href="{{ route('funcionario.index') }}">Limpar</a>@endif
            </form>

            <div class="table-responsive">
                <table>
                    <thead><tr><th>Utilizador</th><th>Género</th><th>Email</th><th>Perfil de acesso</th><th>Estado</th><th>Acção</th></tr></thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td><strong class="table-primary-text">{{ $user->name }}</strong><small class="table-secondary-text">Utilizador #{{ $user->id }}</small></td>
                                <td>{{ $user->genero }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->isResponsavel) Responsável de sala
                                    @elseif ($user->isSecretaria) Secretaria
                                    @elseif ($user->isEstatistico) Estatístico
                                    @else Sem perfil atribuído
                                    @endif
                                </td>
                                <td><span class="status-chip {{ $user->isSecretaria || $user->isResponsavel || $user->isEstatistico ? '' : 'status-chip-muted' }}">{{ $user->isSecretaria || $user->isResponsavel || $user->isEstatistico ? 'Activo' : 'Inactivo' }}</span></td>
                                <td><a class="table-action" href="{{ route('funcionario.edit', $user->id) }}" aria-label="Gerir utilizador {{ $user->name }}"><i class="bx bx-show" aria-hidden="true"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6"><div class="table-empty"><i class="bx bx-user-x" aria-hidden="true"></i><strong>Nenhum utilizador encontrado</strong><span>Altere os filtros ou registe um novo utilizador.</span></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="table-pagination">{{ $users->links() }}</div>
        </section>

        <div class="modal fade" id="user-create" tabindex="-1" aria-labelledby="user-create-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header"><div><span class="modal-kicker">NOVO ACESSO</span><h2 id="user-create-title">Registar utilizador</h2><p>Escolha o perfil de trabalho deste utilizador.</p></div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button></div>
                    <form action="{{ route('funcionario.store') }}" method="post">
                        @csrf
                        <div class="modal-body form-grid">
                            @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                            <label class="form-grid-full">Nome completo<input name="name" type="text" value="{{ old('name') }}" required autocomplete="name"></label>
                            <label class="form-grid-full">Email<input name="email" type="email" value="{{ old('email') }}" required autocomplete="email"></label>
                            <label>Género<select name="genero" required><option value="">Seleccionar</option><option value="Femenino" @selected(old('genero') === 'Femenino')>Feminino</option><option value="Masculino" @selected(old('genero') === 'Masculino')>Masculino</option></select></label>
                            <label>Perfil de acesso<select name="tipo" required><option value="">Seleccionar perfil</option><option value="2" @selected(old('tipo') === '2')>Secretaria</option><option value="3" @selected(old('tipo') === '3')>Responsável de sala</option><option value="4" @selected(old('tipo') === '4')>Estatístico</option></select></label>
                            <p class="form-grid-full form-hint"><i class="bx bx-info-circle" aria-hidden="true"></i> A conta será criada com a palavra-passe inicial definida pelo sistema. Recomenda-se alterá-la no primeiro acesso.</p>
                        </div>
                        <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Criar utilizador</button></div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
