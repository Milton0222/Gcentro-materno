<x-app-layout>
    @section('corpo')
        <section class="corpo entity-management">
            <div class="management-heading">
                <div><span class="management-kicker">SAÚDE E ACOMPANHAMENTO</span><h1>Planeamento familiar</h1><p>Consulte e registe os métodos de planeamento associados às pacientes.</p></div>
                <button class="button button-primary" type="button" data-bs-toggle="modal" data-bs-target="#planning-create"><i class="bx bx-plus-circle" aria-hidden="true"></i> Novo registo</button>
            </div>

            <form class="entity-filters" action="{{ route('planeamento.index') }}" method="get">
                <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Paciente ou método"></label>
                <input type="date" name="data" value="{{ request('data') }}" aria-label="Filtrar por data">
                <input type="text" name="metodo" value="{{ request('metodo') }}" placeholder="Método" aria-label="Filtrar por método">
                <select name="estado" aria-label="Filtrar por estado">
                    <option value="">Todos os estados</option>
                    <option value="activo" @selected(request('estado') === 'activo')>Activo</option>
                    <option value="inactivo" @selected(request('estado') === 'inactivo')>Inactivo</option>
                </select>
                <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
                @if (request()->query())<a class="filter-clear" href="{{ route('planeamento.index') }}">Limpar</a>@endif
            </form>

            <div class="table-responsive">
                <table>
                    <thead><tr><th>Paciente</th><th>Método</th><th>Data de início</th><th>Próxima consulta</th><th>Estado</th><th>Observações</th><th>Acção</th></tr></thead>
                    <tbody>
                        @forelse ($planeamentos as $planeamento)
                            <tr>
                                <td><strong class="table-primary-text">{{ $planeamento->paciente?->nome ?? 'Paciente indisponível' }}</strong><small class="table-secondary-text">{{ $planeamento->paciente?->contacto ?: 'Sem contacto' }}</small></td>
                                <td>{{ $planeamento->metodo }}</td>
                                <td>{{ $planeamento->dataPlaneamento?->format('d/m/Y') }}</td>
                                <td>{{ $planeamento->proximaData?->format('d/m/Y') ?: 'Não agendada' }}</td>
                                <td><span class="status-chip {{ $planeamento->estado === 'activo' ? '' : 'status-chip-muted' }}">{{ ucfirst($planeamento->estado) }}</span></td>
                                <td>{{ $planeamento->observacoes ?: '—' }}</td>
                                <td><button class="table-action" type="button" data-bs-toggle="modal" data-bs-target="#planning-edit" data-id="{{ $planeamento->id }}" data-patient="{{ $planeamento->pacienteID }}" data-method="{{ $planeamento->metodo }}" data-status="{{ $planeamento->estado }}" data-start="{{ $planeamento->dataPlaneamento?->format('Y-m-d') }}" data-next="{{ $planeamento->proximaData?->format('Y-m-d') }}" data-notes="{{ $planeamento->observacoes }}" aria-label="Editar registo de planeamento"><i class="bx bx-edit-alt" aria-hidden="true"></i></button></td>
                            </tr>
                        @empty
                            <tr><td colspan="7"><div class="table-empty"><i class="bx bx-heart-circle" aria-hidden="true"></i><strong>Nenhum registo encontrado</strong><span>Altere os filtros ou registe um planeamento familiar.</span></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="table-summary">A apresentar {{ $planeamentos->count() }} {{ $planeamentos->count() === 1 ? 'registo' : 'registos' }}.</div>
        </section>

        <div class="modal fade" id="planning-create" tabindex="-1" aria-labelledby="planning-create-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header"><div><span class="modal-kicker">NOVO REGISTO</span><h2 id="planning-create-title">Planeamento familiar</h2><p>Associe o método à paciente acompanhada.</p></div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button></div>
                    <form action="{{ route('planeamento.store') }}" method="post">
                        @csrf
                        <div class="modal-body form-grid">
                            @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                            <label class="form-grid-full">Paciente<select name="pacienteID" required><option value="">Seleccionar paciente</option>@foreach ($pacientes as $paciente)<option value="{{ $paciente->id }}" @selected(old('pacienteID') == $paciente->id)>{{ $paciente->nome }}{{ $paciente->contacto ? ' · '.$paciente->contacto : '' }}</option>@endforeach</select></label>
                            <label>Método de planeamento<input name="metodo" type="text" value="{{ old('metodo') }}" required placeholder="Método utilizado"></label>
                            <label>Estado<select name="estado" required><option value="activo" @selected(old('estado', 'activo') === 'activo')>Activo</option><option value="inactivo" @selected(old('estado') === 'inactivo')>Inactivo</option></select></label>
                            <label>Data de início<input name="dataPlaneamento" type="date" value="{{ old('dataPlaneamento', now()->format('Y-m-d')) }}" required></label>
                            <label>Próxima consulta<input name="proximaData" type="date" value="{{ old('proximaData') }}"></label>
                            <label class="form-grid-full">Observações<textarea name="observacoes" rows="4">{{ old('observacoes') }}</textarea></label>
                        </div>
                        <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar registo</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="planning-edit" tabindex="-1" aria-labelledby="planning-edit-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header"><div><span class="modal-kicker">ACTUALIZAR REGISTO</span><h2 id="planning-edit-title">Editar planeamento</h2><p>Actualize o método e as datas de acompanhamento.</p></div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button></div>
                    <form id="planning-edit-form" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="planeamentoID" id="planning-edit-id" value="{{ old('planeamentoID') }}">
                        <div class="modal-body form-grid">
                            @if ($errors->planeamentoEdit->any())<div class="form-errors">@foreach ($errors->planeamentoEdit->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                            <label class="form-grid-full">Paciente<select name="pacienteID" id="planning-edit-patient" required><option value="">Seleccionar paciente</option>@foreach ($pacientes as $paciente)<option value="{{ $paciente->id }}" @selected(old('pacienteID') == $paciente->id)>{{ $paciente->nome }}{{ $paciente->contacto ? ' · '.$paciente->contacto : '' }}</option>@endforeach</select></label>
                            <label>Método de planeamento<input id="planning-edit-method" name="metodo" type="text" value="{{ old('metodo') }}" required></label>
                            <label>Estado<select id="planning-edit-status" name="estado" required><option value="activo" @selected(old('estado') === 'activo')>Activo</option><option value="inactivo" @selected(old('estado') === 'inactivo')>Inactivo</option></select></label>
                            <label>Data de início<input id="planning-edit-start" name="dataPlaneamento" type="date" value="{{ old('dataPlaneamento') }}" required></label>
                            <label>Próxima consulta<input id="planning-edit-next" name="proximaData" type="date" value="{{ old('proximaData') }}"></label>
                            <label class="form-grid-full">Observações<textarea id="planning-edit-notes" name="observacoes" rows="4">{{ old('observacoes') }}</textarea></label>
                        </div>
                        <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar alterações</button></div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('planning-edit').addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const form = document.getElementById('planning-edit-form');
                const recordId = button ? button.dataset.id : document.getElementById('planning-edit-id').value;

                if (!recordId) {
                    return;
                }

                form.action = '{{ url('/planeamento/update') }}/' + recordId;
                document.getElementById('planning-edit-id').value = recordId;

                if (button) {
                    document.getElementById('planning-edit-patient').value = button.dataset.patient;
                    document.getElementById('planning-edit-method').value = button.dataset.method;
                    document.getElementById('planning-edit-status').value = button.dataset.status;
                    document.getElementById('planning-edit-start').value = button.dataset.start;
                    document.getElementById('planning-edit-next').value = button.dataset.next;
                    document.getElementById('planning-edit-notes').value = button.dataset.notes;
                }
            });
        </script>
    @endsection
</x-app-layout>
