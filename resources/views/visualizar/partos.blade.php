<x-app-layout>
    @section('corpo')
    <section class="corpo entity-management">
        <div class="management-heading">
            <div><span class="management-kicker">SALA DE PARTOS</span>
                <h1>Gestão de partos</h1>
                <p>Acompanhe os partos e os bebés associados a cada registo.</p>
            </div>
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#birth-create"><i class="bx bx-plus-medical" aria-hidden="true"></i> Registar parto</button>
        </div>

        <form class="entity-filters" action="{{ route('parto.index') }}" method="get">
            <label class="filter-search"><i class="bx bx-search" aria-hidden="true"></i><input type="search" name="search" value="{{ request('search') }}" placeholder="Paciente, tipo ou estado"></label>
            <input type="date" name="data" value="{{ request('data') }}" aria-label="Filtrar por data do parto">
            <input type="text" name="estado" value="{{ request('estado') }}" placeholder="Estado do parto" aria-label="Filtrar por estado">
            <button class="button button-filter" type="submit"><i class="bx bx-filter-alt" aria-hidden="true"></i> Filtrar</button>
            @if (request()->query())<a class="filter-clear" href="{{ route('parto.index') }}">Limpar</a>@endif
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Tipo de parto</th>
                        <th>Estado</th>
                        <th>Data</th>
                        <th>Bebés</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partos as $parto)
                    <tr>
                        <td><strong class="table-primary-text">{{ $parto->paciente?->nome ?? 'Paciente indisponível' }}</strong><small class="table-secondary-text">{{ $parto->paciente?->contacto ?: 'Sem contacto' }}</small></td>
                        <td>{{ $parto->tipo }}</td>
                        <td><span class="status-chip">{{ $parto->estado }}</span></td>
                        <td>{{ $parto->created_at?->format('d/m/Y') }}</td>
                        <td><span class="count-chip">{{ $parto->criancas->count() }}</span></td>
                        <td><a class="table-action" href="{{ route('parto.edit', $parto->id) }}" aria-label="Gerir parto"><i class="bx bx-show" aria-hidden="true"></i></a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="table-empty"><i class="bx bx-plus-medical" aria-hidden="true"></i><strong>Nenhum parto encontrado</strong><span>Altere os filtros ou registe um novo parto.</span></div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-summary">A apresentar {{ $partos->count() }} {{ $partos->count() === 1 ? 'parto' : 'partos' }}.</div>
    </section>

    <div class="modal fade" id="birth-create" tabindex="-1" aria-labelledby="birth-create-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end">
            <div class="modal-content">
                <div class="modal-header">
                    <div><span class="modal-kicker">NOVO REGISTO</span>
                        <h2 id="birth-create-title">Registar parto</h2>
                        <p>Seleccione a paciente e informe os dados do parto.</p>
                    </div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button>
                </div>
                <form id="birth-create-form" action="{{ route('parto.store', 0) }}" method="post">
                    @csrf
                    <div class="modal-body form-grid">
                        @if ($errors->any())<div class="form-errors">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
                        <label class="form-grid-full">Paciente<select id="birth-patient" required>
                                <option value="">Seleccionar paciente</option>@foreach ($pacientes as $paciente)<option value="{{ $paciente->id }}">{{ $paciente->nome }}{{ $paciente->contacto ? ' · '.$paciente->contacto : '' }}</option>@endforeach
                            </select></label>
                        <label>Tipo de parto
                            <select name="tipo" id="" class="form-control">
                                <option value="{{ old('tipo') }}">--Selecionar--</option>
                                <option value="Normal">Parto Normal</option>
                                <option value="Natural">Parto Natural</option>
                                <option value="Cesariana">Parto Cesariana</option>
                                <option value="Humanizado">Parto Humanizado</option>
                            </select>

                        </label>
                        <label>Estado<input name="estado" type="text" value="{{ old('estado') }}" required placeholder="Informe o estado clínico da paciente"></label>
                        <label class="form-grid-full">Observações<textarea name="obs" rows="4">{{ old('obs') }}</textarea></label>
                    </div>
                    <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar parto</button></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('birth-patient').addEventListener('change', function() {
            document.getElementById('birth-create-form').action = '{{ url(' / parto / store ') }}/' + this.value;
        });
    </script>
    @endsection
</x-app-layout>