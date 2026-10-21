<x-app-layout>
    @section('corpo')
        <section class="corpo entity-management">
            <div class="management-heading">
                <div><span class="management-kicker">SAÚDE INFANTIL</span><h1>Recém-nascidos</h1><p>Consulte e actualize os registos dos bebés nascidos no centro.</p></div>
                <button class="button button-primary" type="button" data-bs-toggle="modal" data-bs-target="#newborn-create"><i class="bx bx-baby-carriage" aria-hidden="true"></i> Registar bebé</button>
            </div>

            <form class="entity-filters" action="{{ route('crianca.index') }}" method="get">
                <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Nome do bebé ou da mãe"></label>
                <input type="date" name="data" value="{{ request('data') }}" aria-label="Filtrar por data de nascimento">
                <select name="genero" aria-label="Filtrar por género">
                    <option value="">Todos os géneros</option><option value="F" @selected(request('genero') === 'F')>Feminino</option><option value="M" @selected(request('genero') === 'M')>Masculino</option>
                </select>
                <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
                @if (request()->query())<a class="filter-clear" href="{{ route('crianca.index') }}">Limpar</a>@endif
            </form>

            <div class="table-responsive">
                <table>
                    <thead><tr><th>Bebé</th><th>Mãe</th><th>Género</th><th>Data e hora</th><th>Peso</th><th>Acção</th></tr></thead>
                    <tbody>
                        @forelse ($criancas as $crianca)
                            <tr>
                                <td><strong class="table-primary-text">{{ $crianca->nome ?: 'Sem nome atribuído' }}</strong><small class="table-secondary-text">Registo #{{ $crianca->id }}</small></td>
                                <td>{{ $crianca->parto?->paciente?->nome ?? 'Paciente indisponível' }}</td>
                                <td>{{ $crianca->genero === 'F' ? 'Feminino' : 'Masculino' }}</td>
                                <td>{{ $crianca->dataParto }}<small class="table-secondary-text">{{ $crianca->hora ?: 'Hora não registada' }}</small></td>
                                <td>{{ $crianca->peso ? number_format($crianca->peso, 2, ',', '.').' kg' : '—' }}</td>
                                <td><a class="table-action" href="{{ route('crianca.edit', $crianca->id) }}" aria-label="Gerir bebé"><i class="bx bx-show" aria-hidden="true"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6"><div class="table-empty"><i class="bx bx-baby-carriage" aria-hidden="true"></i><strong>Nenhum recém-nascido encontrado</strong><span>Altere os filtros ou registe um novo bebé.</span></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="table-summary">A apresentar {{ $criancas->count() }} {{ $criancas->count() === 1 ? 'registo' : 'registos' }}.</div>
        </section>

        <div class="modal fade" id="newborn-create" tabindex="-1" aria-labelledby="newborn-create-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header"><div><span class="modal-kicker">NOVO REGISTO</span><h2 id="newborn-create-title">Registar recém-nascido</h2><p>Ligue o bebé ao parto correspondente.</p></div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button></div>
                    <form action="{{ route('crianca.store') }}" method="post">
                        @csrf
                        <div class="modal-body form-grid">
                            @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                            <label class="form-grid-full">Parto e mãe<select name="partoID" required><option value="">Seleccionar parto</option>@foreach ($partos as $parto)<option value="{{ $parto->id }}" @selected(old('partoID') == $parto->id)>#{{ $parto->id }} · {{ $parto->paciente?->nome ?? 'Paciente' }} · {{ $parto->created_at?->format('d/m/Y') }}</option>@endforeach</select></label>
                            <label>Nome do bebé<input name="nome" type="text" value="{{ old('nome') }}" required maxlength="50"></label>
                            <label>Género<select name="genero" required><option value="">Seleccionar</option><option value="F" @selected(old('genero') === 'F')>Feminino</option><option value="M" @selected(old('genero') === 'M')>Masculino</option></select></label>
                            <label>Data de nascimento<input name="dataParto" type="date" value="{{ old('dataParto') }}" required></label>
                            <label>Hora de nascimento<input name="hora" type="time" value="{{ old('hora') }}" required></label>
                            <label class="form-grid-full">Peso (kg)<input name="peso" type="number" min="0" step="0.01" value="{{ old('peso') }}" required></label>
                        </div>
                        <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar bebé</button></div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
