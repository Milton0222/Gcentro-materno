<x-app-layout>
    @section('corpo')
    <section class="corpo entity-management">
        <div class="management-heading">
            <div><span class="management-kicker">ATENDIMENTO PRÉ-NATAL</span>
                <h1>Consultas e triagem</h1>
                <p>Consulte os atendimentos e acompanhe os dados de triagem.</p>
            </div>
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#consultation-create"><i class="bx bx-calendar-plus" aria-hidden="true"></i> Registar consulta</button>
        </div>

        <form class="entity-filters" action="{{ route('consulta.index') }}" method="get">
            <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Paciente, tipo ou risco"></label>
            <input type="date" name="data" value="{{ request('data') }}" aria-label="Filtrar por data">
            <input type="text" name="tipoConsulta" value="{{ request('tipoConsulta') }}" placeholder="Tipo de consulta" aria-label="Filtrar por tipo">
            <input type="text" name="classificacaoRisco" value="{{ request('classificacaoRisco') }}" placeholder="Classificação de risco" aria-label="Filtrar por risco">
            <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
            @if (request()->query())<a class="filter-clear" href="{{ route('consulta.index') }}">Limpar</a>@endif
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Consulta</th>
                        <th>Data e hora</th>
                        <th>Profissional</th>
                        <th>Risco</th>
                        <th>Triagem</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consultas as $consulta)
                    <tr>
                        <td><strong class="table-primary-text">{{ $consulta->paciente?->nome ?? 'Paciente indisponível' }}</strong><small class="table-secondary-text">{{ $consulta->paciente?->contacto ?: 'Sem contacto' }}</small></td>
                        <td>{{ $consulta->tipoConsulta }}</td>
                        <td>{{ $consulta->dataConsulta }}<small class="table-secondary-text">{{ $consulta->hora }}</small></td>
                        <td>{{ $consulta->doutor }}</td>
                        <td><span class="status-chip {{ strtolower($consulta->classificacaoRisco ?? '') === 'alto' ? 'status-chip-alert' : '' }}">{{ $consulta->classificacaoRisco ?: 'Não classificado' }}</span></td>
                        <td>{{ $consulta->pressaoArterial ?: '—' }}</td>
                        <td><a class="table-action" href="{{ route('consulta.edit', $consulta->id) }}" aria-label="Gerir consulta"><i class="bx bx-show" aria-hidden="true"></i></a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="table-empty"><i class="bx bx-calendar-x" aria-hidden="true"></i><strong>Nenhuma consulta encontrada</strong><span>Altere os filtros ou marque uma consulta.</span></div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-summary">A apresentar {{ $consultas->count() }} {{ $consultas->count() === 1 ? 'consulta' : 'consultas' }}.</div>
    </section>

    <div class="modal fade" id="consultation-create" tabindex="-1" aria-labelledby="consultation-create-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end modal-dialog-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <div><span class="modal-kicker">NOVO ATENDIMENTO</span>
                        <h2 id="consultation-create-title">Marcar consulta e fazer triagem</h2>
                        <p>Associe o atendimento a uma paciente registada.</p>
                    </div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button>
                </div>
                <form id="consultation-create-form" action="{{ route('consulta.marcar', 0) }}" method="post">
                    @csrf
                      
                    <div class="modal-body form-grid">
                        @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                        <label class="form-grid-full">Paciente<select id="consultation-patient" name="paciente_id" required>
                                <option value="">Seleccionar paciente</option>@foreach ($pacientes as $paciente)<option value="{{ $paciente->id }}">{{ $paciente->nome }}{{ $paciente->contacto ? ' · '.$paciente->contacto : '' }}</option>@endforeach
                            </select></label>
                        <label>Data da consulta<input name="dataConsulta" type="date" value="{{ old('dataConsulta') }}" required></label>
                        <label>Hora<input name="hora" type="time" value="{{ old('hora') }}" required></label>
                        <label>Tipo de consulta Materna
                            <div>
                               
                                <select name="tipoConsulta" id="" required class="form-control">
                                    <option value="{{ old('tipoConsulta') }}">--Selecionar--</option>
                                    <option value="Planeamento Familiar">Planeamento Familiar</option>
                                    <option value="Pré Natal">Pré Natal</option>
                                    <option value="Obstetrícia">Consulta de Obstetrícia</option>
                                    <option value="Pós Parto">Pós Parto</option>
                                </select>
                            </div>

                        </label>
                        <label>Profissional de saúde<input name="doutor"  type="text" value="{{ old('doutor') }}" required></label>
                        <label>Queixa principal<input name="queixaPrincipal" type="text" value="{{ old('queixaPrincipal') }}"></label>
                        <label>Pressão arterial<input name="pressaoArterial" type="text" value="{{ old('pressaoArterial') }}" placeholder="120/80"></label>
                        <label>Frequência cardíaca (bpm)<input name="frequenciaCardiaca" type="number" min="0" value="{{ old('frequenciaCardiaca') }}"></label>
                        <label>Frequência respiratória (rpm)<input name="frequenciaRespiratoria" type="number" min="0" value="{{ old('frequenciaRespiratoria') }}"></label>
                        <label>Temperatura (°C)<input name="temperatura" type="number" min="0" step="0.1" value="{{ old('temperatura') }}"></label>
                        <label>Saturação de oxigénio (%)<input name="saturacaoOxigenio" type="number" min="0" max="100" step="0.1" value="{{ old('saturacaoOxigenio') }}"></label>
                        <label>Peso (kg)<input name="peso" type="number" min="0" step="0.01" value="{{ old('peso') }}"></label>
                        <label>Altura (m)<input name="altura" type="number" min="0" step="0.01" value="{{ old('altura') }}"></label>
                        <label>Idade gestacional (semanas)<input name="idadeGestacionalSemanas" type="number" min="0" max="45" value="{{ old('idadeGestacionalSemanas') }}"></label>
                        <label>Batimentos fetais (bpm)<input name="batimentosFetais" type="number" min="0" value="{{ old('batimentosFetais') }}"></label>
                        <label>Classificação de risco<input name="classificacaoRisco" type="text" value="{{ old('classificacaoRisco') }}" placeholder="Baixo, moderado, alto"></label>
                        <label class="form-grid-full">Observações da triagem<textarea name="observacoesTriagem" rows="3">{{ old('observacoesTriagem') }}</textarea></label>
                    </div>
                    <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar consulta</button></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('consultation-patient').addEventListener('change', function() {
            document.getElementById('consultation-create-form').action = '{{ url(' / consulta / marcar ') }}/' + this.value;
        });
    </script>
    @endsection
</x-app-layout>