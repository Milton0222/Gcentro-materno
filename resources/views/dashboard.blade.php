<x-app-layout>
    @php
        $welcomeName = explode(' ', trim(auth()->user()->name))[0];
    @endphp

    @section('cartao')
        <section class="welcome-banner">
            <div class="welcome-banner-copy">
                <span class="eyebrow"><span class="eyebrow-dot"></span> PAINEL DE GESTÃO</span>
                <h1>Bom dia, {{ $welcomeName }} <span aria-hidden="true">👋</span></h1>
                <p>Acompanhe a actividade do Centro Materno da Cambanda num só lugar.</p>
            </div>
            <div class="welcome-banner-art" aria-hidden="true">
                <span class="banner-art-circle"></span>
                <i class="bx bx-plus-medical"></i>
                <i class="bx bx-heart"></i>
            </div>
            <div class="welcome-date"><i class="bx bx-calendar" aria-hidden="true"></i> {{ now()->format('d/m/Y') }}</div>
        </section>

        <section class="overview-grid" aria-label="Resumo do centro">
            <article class="overview-card">
                <div class="overview-card-top"><span class="overview-icon icon-patient"><i class="bx bx-user" aria-hidden="true"></i></span><span class="overview-label">PACIENTES</span></div>
                <div class="overview-card-value">{{ number_format($pacientec, 0, ',', '.') }}</div>
                <div class="overview-card-bottom">
                    <span>Total de pacientes registadas</span>
                    @if (auth()->user()->isSecretaria || auth()->user()->isAdmin)
                        <a href="{{ route('paciente.index') }}" aria-label="Ver pacientes"><i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @endif
                </div>
            </article>
            <article class="overview-card">
                <div class="overview-card-top"><span class="overview-icon icon-consultation"><i class="bx bx-calendar-heart" aria-hidden="true"></i></span><span class="overview-label">CONSULTAS</span></div>
                <div class="overview-card-value">{{ number_format($consultac, 0, ',', '.') }}</div>
                <div class="overview-card-bottom">
                    <span>Consultas registadas</span>
                    @if (auth()->user()->isSecretaria || auth()->user()->isAdmin)
                        <a href="{{ route('consulta.index') }}" aria-label="Ver consultas"><i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @endif
                </div>
            </article>
            <article class="overview-card">
                <div class="overview-card-top"><span class="overview-icon icon-birth"><i class="bx bx-plus-medical" aria-hidden="true"></i></span><span class="overview-label">PARTOS</span></div>
                <div class="overview-card-value">{{ number_format($partoc, 0, ',', '.') }}</div>
                <div class="overview-card-bottom">
                    <span>Partos registados</span>
                    @if (auth()->user()->isSecretaria || auth()->user()->isAdmin)
                        <a href="{{ route('parto.index') }}" aria-label="Ver partos"><i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @endif
                </div>
            </article>
            <article class="overview-card">
                <div class="overview-card-top"><span class="overview-icon icon-team"><i class="bx bx-id-card" aria-hidden="true"></i></span><span class="overview-label">EQUIPA</span></div>
                <div class="overview-card-value">{{ number_format($funcionarioc, 0, ',', '.') }}</div>
                <div class="overview-card-bottom">
                    <span>Utilizadores do sistema</span>
                    @if (auth()->user()->isAdmin)
                        <a href="{{ route('funcionario.index') }}" aria-label="Ver equipa"><i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @endif
                </div>
            </article>
        </section>
    @endsection

    @section('corpo')
        <div class="dashboard-content-grid">
            <section class="dashboard-panel births-panel">
                <div class="panel-heading">
                    <div>
                        <span class="panel-kicker">ACOMPANHAMENTO</span>
                        <h2>Nascimentos recentes</h2>
                    </div>
                    <span class="today-pill"><span></span> Hoje: {{ $newbornsTodayCount }}</span>
                </div>

                @if (auth()->user()->isSecretaria || auth()->user()->isAdmin || auth()->user()->isResponsavel)
                    @if ($newbornsToday->isNotEmpty())
                    <div class="birth-list">
                        @foreach ($newbornsToday as $newborn)
                            <article class="birth-row">
                                <span class="birth-avatar"><i class="bx bx-baby-carriage" aria-hidden="true"></i></span>
                                <div class="birth-details">
                                    <strong>{{ $newborn->nome ?: 'Recém-nascido sem nome' }}</strong>
                                    <span>
                                        @if ($newborn->parto && $newborn->parto->paciente)
                                            Mãe: {{ $newborn->parto->paciente->nome }}
                                        @else
                                            Registo de nascimento
                                        @endif
                                    </span>
                                </div>
                                <div class="birth-meta">
                                    <span>{{ $newborn->genero === 'F' ? 'Feminino' : 'Masculino' }}</span>
                                    <small>{{ $newborn->hora ?: 'Hora não registada' }}</small>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @else
                        <div class="empty-state">
                            <span><i class="bx bx-baby-carriage" aria-hidden="true"></i></span>
                            <strong>Sem nascimentos registados hoje</strong>
                            <p>Quando houver novos registos, serão apresentados aqui.</p>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <span><i class="bx bx-baby-carriage" aria-hidden="true"></i></span>
                        <strong>{{ $newbornsTodayCount }} {{ $newbornsTodayCount === 1 ? 'nascimento registado hoje' : 'nascimentos registados hoje' }}</strong>
                        <p>Os detalhes dos recém-nascidos estão disponíveis para os perfis de atendimento autorizados.</p>
                    </div>
                @endif

                @if (auth()->user()->isSecretaria || auth()->user()->isAdmin)
                    <a class="panel-footer-link" href="{{ route('crianca.index') }}">Ver todos os recém-nascidos <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                @endif
            </section>

            <aside class="dashboard-side-column">
                <section class="dashboard-panel quick-actions-panel">
                    <div class="panel-heading">
                        <div><span class="panel-kicker">ACESSO RÁPIDO</span><h2>O que pretende fazer?</h2></div>
                    </div>
                    <div class="quick-actions-list">
                        @if (auth()->user()->isSecretaria)
                            <a href="{{ route('paciente.storeShow') }}"><span class="quick-action-icon action-green"><i class="bx bx-user-plus" aria-hidden="true"></i></span><span><strong>Registar paciente</strong><small>Adicionar um novo registo</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></a>
                            <a href="{{ route('consulta.index') }}"><span class="quick-action-icon action-blue"><i class="bx bx-calendar-plus" aria-hidden="true"></i></span><span><strong>Gerir consultas</strong><small>Consultar agenda e triagem</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></a>
                            <a href="{{ route('parto.index') }}"><span class="quick-action-icon action-peach"><i class="bx bx-plus-medical" aria-hidden="true"></i></span><span><strong>Acompanhar partos</strong><small>Ver registos de parto</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></a>
                        @elseif (auth()->user()->isAdmin)
                            <a href="{{ route('funcionario.index') }}"><span class="quick-action-icon action-blue"><i class="bx bx-id-card" aria-hidden="true"></i></span><span><strong>Gerir utilizadores</strong><small>Equipa e permissões</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></a>
                        @elseif (auth()->user()->isEstatistico || auth()->user()->isAdmin)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#relatorios"><span class="quick-action-icon action-green"><i class="bx bx-bar-chart-alt-2" aria-hidden="true"></i></span><span><strong>Emitir relatório</strong><small>Consultar indicadores do centro</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></button>
                        @else
                            <a href="{{ route('profile.show') }}"><span class="quick-action-icon action-blue"><i class="bx bx-user-circle" aria-hidden="true"></i></span><span><strong>Ver o meu perfil</strong><small>Consultar os dados da conta</small></span><i class="bx bx-chevron-right quick-chevron" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </section>

                <section class="dashboard-note">
                    <span class="note-heart"><i class="bx bx-heart" aria-hidden="true"></i></span>
                    <div><strong>Cuidado materno e infantil</strong><p>Informação organizada para apoiar o trabalho diário da equipa.</p></div>
                </section>
            </aside>
        </div>
    @endsection
</x-app-layout>
