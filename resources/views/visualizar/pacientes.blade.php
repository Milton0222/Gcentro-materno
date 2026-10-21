<x-app-layout>
    @section('corpo')
        <section class="corpo entity-management">
            <div class="management-heading">
                <div>
                    <span class="management-kicker">REGISTO CLÍNICO</span>
                    <h1>Gestão de pacientes</h1>
                    <p>Pesquise e consulte os registos das pacientes do centro.</p>
                </div>
                <button class="button button-primary" type="button" data-bs-toggle="modal" data-bs-target="#patient-create">
                    <i class="bx bx-user-plus" aria-hidden="true"></i> Nova paciente
                </button>
            </div>

            <form class="entity-filters" action="{{ route('paciente.index') }}" method="get">
                <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Nome ou contacto"></label>
                <select name="genero" aria-label="Filtrar por género">
                    <option value="">Todos os géneros</option>
                    <option value="F" @selected(request('genero') === 'F')>Feminino</option>
                    <option value="M" @selected(request('genero') === 'M')>Masculino</option>
                </select>
                <input type="text" name="tipoPaciente" value="{{ request('tipoPaciente') }}" placeholder="Tipo de paciente" aria-label="Filtrar por tipo de paciente">
                <input type="text" name="estado" value="{{ request('estado') }}" placeholder="Estado" aria-label="Filtrar por estado">
                <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
                @if (request()->query())
                    <a class="filter-clear" href="{{ route('paciente.index') }}">Limpar</a>
                @endif
            </form>

            <div class="table-responsive">
                <table>
                    <thead><tr><th>Paciente</th><th>Género</th><th>Contacto</th><th>Data de nascimento</th><th>Tipo</th><th>Estado</th><th>Acção</th></tr></thead>
                    <tbody>
                        @forelse ($pacientes as $paciente)
                            <tr>
                                <td><strong class="table-primary-text">{{ $paciente->nome }}</strong><small class="table-secondary-text">{{ $paciente->morada ?: 'Morada não indicada' }}</small></td>
                                <td>{{ $paciente->genero === 'F' ? 'Feminino' : 'Masculino' }}</td>
                                <td>{{ $paciente->contacto ?: '—' }}</td>
                                <td>{{ $paciente->dataNascimento }}</td>
                                <td>{{ $paciente->tipoPaciente }}</td>
                                <td><span class="status-chip">{{ $paciente->estado ?: 'Sem estado' }}</span></td>
                                <td><a class="table-action" href="{{ route('paciente.edit', $paciente->id) }}" aria-label="Gerir paciente {{ $paciente->nome }}"><i class="bx bx-show" aria-hidden="true"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="7"><div class="table-empty"><i class="bx bx-search-alt" aria-hidden="true"></i><strong>Nenhuma paciente encontrada</strong><span>Ajuste os filtros ou registe uma nova paciente.</span></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="table-summary">A apresentar {{ $pacientes->count() }} {{ $pacientes->count() === 1 ? 'registo' : 'registos' }}.</div>
        </section>

        <div class="modal fade" id="patient-create" tabindex="-1" aria-labelledby="patient-create-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header"><div><span class="modal-kicker">NOVO REGISTO</span><h2 id="patient-create-title">Registar paciente</h2><p>Preencha os dados de identificação.</p></div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button></div>
                    <form action="{{ route('paciente.store') }}" method="post">
                        @csrf
                        <div class="modal-body form-grid">
                            @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                            <label>Nome completo<input name="nome" type="text" value="{{ old('nome') }}" required maxlength="50" autocomplete="name"></label>
                            <label>Contacto<input name="contacto" type="tel" value="{{ old('contacto') }}" autocomplete="tel"></label>
                            <label>Data de nascimento<input name="nascimento" type="date" value="{{ old('nascimento') }}" required></label>
                            <label>Género<select name="genero" required><option value="">Seleccionar</option><option value="F" @selected(old('genero') === 'F')>Feminino</option><option value="M" @selected(old('genero') === 'M')>Masculino</option></select></label>
                            <label>Morada<input name="morada" type="text" value="{{ old('morada') }}" maxlength="50"></label>
                            <label>Tipo de paciente<input name="tipo_paciente" type="text" value="{{ old('tipo_paciente') }}" required></label>
                            <label>Estado<input name="estado" type="text" value="{{ old('estado') }}"></label>
                            <label class="form-grid-full">Informação de saúde<textarea name="saude" rows="3" required>{{ old('saude') }}</textarea></label>
                        </div>
                        <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar paciente</button></div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
