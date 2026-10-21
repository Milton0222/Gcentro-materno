<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f4faf8">

    <title>{{ isset($title) ? $title.' · ' : '' }}{{ config('app.name', 'Centro Materno da Cambanda') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetes/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assetes/admin.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="admin-body">
    @include('sweetalert::alert')
    <x-banner />

    @php
        $currentUser = auth()->user();
        $isSecretary = (bool) $currentUser->isSecretaria;
        $isAdmin = (bool) $currentUser->isAdmin;
        $isStatistician = (bool) $currentUser->isEstatistico;
        $isRoomManager = (bool) $currentUser->isResponsavel;
        $roleLabels = [];
        if ($isAdmin) $roleLabels[] = 'Administrador';
        if ($isSecretary) $roleLabels[] = 'Secretaria';
        if ($isStatistician) $roleLabels[] = 'Estatístico';
        if ($isRoomManager) $roleLabels[] = 'Responsável de sala';
        $roleLabel = implode(' · ', $roleLabels) ?: 'Utilizador';
        $pageTitle = match (true) {
            request()->routeIs('dashboard') => 'Painel geral',
            request()->routeIs('paciente.*') => 'Gestão de pacientes',
            request()->routeIs('consulta.*') => 'Consultas e triagem',
            request()->routeIs('parto.*') => 'Gestão de partos',
            request()->routeIs('crianca.*') => 'Recém-nascidos',
            request()->routeIs('planeamento.*') => 'Planeamento familiar',
            request()->routeIs('funcionario.*') => 'Equipa e acessos',
            request()->routeIs('relatorio.*') => 'Relatórios',
            request()->routeIs('profile.*') => 'Perfil do utilizador',
            default => 'Gestão do centro',
        };
    @endphp

    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>
        <aside class="admin-sidebar" id="admin-sidebar" aria-label="Menu principal">
            <div class="sidebar-brand-row">
                <a class="admin-brand" href="{{ route('dashboard') }}">
                    <span class="admin-brand-icon"><i class="bx bx-plus-medical" aria-hidden="true"></i></span>
                    <span><strong>Centro Materno</strong><small>da Cambanda</small></span>
                </a>
                <button class="sidebar-close" type="button" aria-label="Fechar menu" data-sidebar-close>
                    <i class="bx bx-x" aria-hidden="true"></i>
                </button>
            </div>

            <div class="sidebar-context">
                <span class="context-label">ESPAÇO DE TRABALHO</span>
                <span class="context-name"><i class="bx bx-clinic" aria-hidden="true"></i> Gestão do centro</span>
            </div>

            <nav class="sidebar-navigation">
                <span class="nav-section-label">MENU PRINCIPAL</span>
                <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bx bx-grid-alt" aria-hidden="true"></i><span>Painel geral</span>
                </a>

                @if ($isSecretary || $isAdmin)
                    <div class="sidebar-group {{ request()->routeIs('paciente.*') ? 'is-expanded' : '' }}">
                        <button class="sidebar-group-toggle" type="button" aria-expanded="{{ request()->routeIs('paciente.*') ? 'true' : 'false' }}">
                            <i class="bx bx-user" aria-hidden="true"></i><span>Pacientes</span><i class="bx bx-chevron-down group-chevron" aria-hidden="true"></i>
                        </button>
                        <div class="sidebar-submenu">
                            <a class="{{ request()->routeIs('paciente.index', 'paciente.show') ? 'is-current' : '' }}" href="{{ route('paciente.index') }}">Lista de pacientes</a>
                            <a href="{{ route('paciente.storeShow') }}">Registar paciente</a>
                        </div>
                    </div>

                    <div class="sidebar-group {{ request()->routeIs('consulta.*') ? 'is-expanded' : '' }}">
                        <button class="sidebar-group-toggle" type="button" aria-expanded="{{ request()->routeIs('consulta.*') ? 'true' : 'false' }}">
                            <i class="bx bx-calendar-heart" aria-hidden="true"></i><span>Consultas e triagem</span><i class="bx bx-chevron-down group-chevron" aria-hidden="true"></i>
                        </button>
                        <div class="sidebar-submenu">
                            <a class="{{ request()->routeIs('consulta.index', 'consulta.show') ? 'is-current' : '' }}" href="{{ route('consulta.index') }}">Consultas</a>
                        </div>
                    </div>

                    <div class="sidebar-group {{ request()->routeIs('parto.*', 'crianca.*') ? 'is-expanded' : '' }}">
                        <button class="sidebar-group-toggle" type="button" aria-expanded="{{ request()->routeIs('parto.*', 'crianca.*') ? 'true' : 'false' }}">
                            <i class="bx bx-plus-medical" aria-hidden="true"></i><span>Partos e bebés</span><i class="bx bx-chevron-down group-chevron" aria-hidden="true"></i>
                        </button>
                        <div class="sidebar-submenu">
                            <a class="{{ request()->routeIs('parto.*') ? 'is-current' : '' }}" href="{{ route('parto.index') }}">Partos</a>
                            <a class="{{ request()->routeIs('crianca.*') ? 'is-current' : '' }}" href="{{ route('crianca.index') }}">Recém-nascidos</a>
                        </div>
                    </div>

                    <div class="sidebar-group {{ request()->routeIs('planeamento.*') ? 'is-expanded' : '' }}">
                        <button class="sidebar-group-toggle" type="button" aria-expanded="{{ request()->routeIs('planeamento.*') ? 'true' : 'false' }}">
                            <i class="bx bx-heart-circle" aria-hidden="true"></i><span>Planeamento familiar</span><i class="bx bx-chevron-down group-chevron" aria-hidden="true"></i>
                        </button>
                        <div class="sidebar-submenu">
                            <a class="{{ request()->routeIs('planeamento.index') ? 'is-current' : '' }}" href="{{ route('planeamento.index') }}">Registos de planeamento</a>
                        </div>
                    </div>
                @endif

                @if (($isStatistician || $isAdmin) && Route::has('relatorio.ver'))
                    <button class="sidebar-link sidebar-report-trigger" type="button" data-bs-toggle="modal" data-bs-target="#relatorios">
                        <i class="bx bx-bar-chart-alt-2" aria-hidden="true"></i><span>Relatórios</span>
                    </button>
                @endif

                @if ($isAdmin)
                    <div class="sidebar-group {{ request()->routeIs('funcionario.*') ? 'is-expanded' : '' }}">
                        <button class="sidebar-group-toggle" type="button" aria-expanded="{{ request()->routeIs('funcionario.*') ? 'true' : 'false' }}">
                            <i class="bx bx-id-card" aria-hidden="true"></i><span>Equipa e acessos</span><i class="bx bx-chevron-down group-chevron" aria-hidden="true"></i>
                        </button>
                        <div class="sidebar-submenu">
                            <a class="{{ request()->routeIs('funcionario.index', 'funcionario.search') ? 'is-current' : '' }}" href="{{ route('funcionario.index') }}">Utilizadores</a>
                            <a href="{{ route('funcionario.create') }}">Adicionar utilizador</a>
                        </div>
                    </div>
                @endif
            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-help">
                    <span class="help-icon"><i class="bx bx-heart" aria-hidden="true"></i></span>
                    <strong>Cuidado que acompanha</strong>
                    <small>Centro Materno da Cambanda</small>
                </div>
                <a class="sidebar-home" href="{{ url('/') }}"><i class="bx bx-arrow-back" aria-hidden="true"></i> Voltar à página inicial</a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="topbar">
                <div class="topbar-leading">
                    <button class="mobile-menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="admin-sidebar">
                        <i class="bx bx-menu" aria-hidden="true"></i>
                    </button>
                    <div class="breadcrumb">
                        <span>Centro Materno</span><i class="bx bx-chevron-right" aria-hidden="true"></i><strong>{{ $title ?? $pageTitle }}</strong>
                    </div>
                </div>

                <div class="topbar-actions">
                    @if ($isSecretary || $isAdmin)
                        <form class="topbar-search" action="{{ route('paciente.show') }}" method="get" role="search">
                            <i class="bx bx-search" aria-hidden="true"></i>
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Pesquisar paciente..." aria-label="Pesquisar paciente" required>
                            <button type="submit">Pesquisar</button>
                        </form>
                    @endif

                    @if ($isSecretary || $isAdmin || $isRoomManager)
                    <div class="notification-wrap">
                        <button class="notification-button" type="button" aria-label="Notificações de nascimentos" aria-expanded="false" aria-controls="birth-notifications">
                            <i class="bx bx-bell" aria-hidden="true"></i>
                            @if ($newbornsTodayCount > 0)
                                <span class="notification-count">{{ $newbornsTodayCount > 9 ? '9+' : $newbornsTodayCount }}</span>
                            @endif
                        </button>
                        <div class="notification-panel" id="birth-notifications" hidden>
                            <div class="notification-heading">
                                <span><strong>Nascimentos de hoje</strong><small>{{ $newbornsTodayCount }} {{ $newbornsTodayCount === 1 ? 'novo bebé' : 'novos bebés' }}</small></span>
                                <i class="bx bx-baby-carriage" aria-hidden="true"></i>
                            </div>
                            @forelse ($newbornsToday as $newborn)
                                <div class="notification-item">
                                    <span class="notification-baby-icon"><i class="bx bx-happy-heart-eyes" aria-hidden="true"></i></span>
                                    <span><strong>{{ $newborn->nome ?: 'Recém-nascido sem nome' }}</strong><small>
                                        @if ($newborn->parto && $newborn->parto->paciente)
                                            Mãe: {{ $newborn->parto->paciente->nome }}
                                        @else
                                            Registo de nascimento
                                        @endif
                                        {{ $newborn->hora ? ' · '.$newborn->hora : '' }}
                                    </small></span>
                                </div>
                            @empty
                                <p class="notification-empty">Ainda não há nascimentos registados hoje.</p>
                            @endforelse
                            @if (($isSecretary || $isAdmin) && Route::has('crianca.index'))
                                <a class="notification-footer" href="{{ route('crianca.index') }}">Ver todos os recém-nascidos <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <span class="topbar-divider"></span>
                    <a class="user-profile" href="{{ Route::has('profile.show') ? route('profile.show') : '#' }}">
                        <img src="{{ $currentUser->profile_photo_url }}" alt="" class="user-avatar">
                        <span class="user-copy"><strong>{{ $currentUser->name }}</strong><small>{{ $roleLabel }}</small></span>
                        <i class="bx bx-chevron-down user-chevron" aria-hidden="true"></i>
                    </a>
                    <form class="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" aria-label="Terminar sessão" title="Terminar sessão"><i class="bx bx-log-out" aria-hidden="true"></i></button>
                    </form>
                </div>
            </header>

            <main class="workspace">
                @if (isset($header))
                    <div class="workspace-heading">{{ $header }}</div>
                @endif

                @yield('cartao')
                @yield('corpo')

                @if (trim((string) $slot) !== '')
                    <section class="workspace-slot">{{ $slot }}</section>
                @endif
            </main>

            <footer class="workspace-footer">
                <span>&copy; {{ date('Y') }} Centro Materno da Cambanda</span>
                <span>Sistema de gestão de informação materno-infantil</span>
            </footer>
        </div>
    </div>

    @if (($isStatistician || $isAdmin) && Route::has('relatorio.ver'))
        <div class="modal fade" id="relatorios" tabindex="-1" aria-labelledby="report-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content report-modal">
                    <div class="modal-header">
                        <div><span class="modal-kicker">CENTRO MATERNO</span><h2 id="report-modal-title">Emitir relatório</h2></div>
                        <button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button>
                    </div>
                    <form action="{{ route('relatorio.ver') }}" method="get">
                        @csrf
                        <div class="modal-body">
                            <label for="report-type">Período do relatório</label>
                            <select name="tipo" id="report-type" class="form-control" required onchange="validar(this.value)">
                                <option value="">Seleccione o período</option>
                                <option value="1">Geral</option>
                                <option value="2">Diário</option>
                                <option value="3">Mensal</option>
                            </select>
                            <div class="report-period-fields">
                                <div id="mes"><label for="report-month">Mês</label><input id="report-month" type="month" name="mes" class="form-control"></div>
                                <div id="diario"><label for="report-day">Dia do mês</label><input id="report-day" type="number" name="dia" min="1" max="31" class="form-control"></div>
                                <div id="periodico"><label for="report-start">Intervalo de datas</label><input id="report-start" type="date" name="data1" class="form-control"><input type="date" name="data2" aria-label="Data final" class="form-control"></div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="button button-primary">Gerar relatório <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></button></div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @stack('modals')
    @livewireScripts
    <script src="{{ asset('assetes/bootstrap/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assetes/validar.js') }}"></script>
    <script>
        const sidebar = document.querySelector('.admin-sidebar');
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const topbarSearch = document.querySelector('.topbar-search');

        if (topbarSearch) {
            topbarSearch.addEventListener('click', (event) => {
                if (window.matchMedia('(max-width: 760px)').matches && !topbarSearch.matches(':focus-within')) {
                    event.preventDefault();
                    topbarSearch.querySelector('input').focus();
                }
            });
        }

        mobileMenuToggle.addEventListener('click', () => {
            const isOpen = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
            mobileMenuToggle.setAttribute('aria-expanded', String(!isOpen));
            sidebar.classList.toggle('is-open', !isOpen);
            document.body.classList.toggle('sidebar-open', !isOpen);
        });

        document.querySelectorAll('[data-sidebar-close]').forEach((button) => {
            button.addEventListener('click', () => {
                sidebar.classList.remove('is-open');
                document.body.classList.remove('sidebar-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            });
        });

        document.querySelectorAll('.sidebar-group-toggle').forEach((button) => {
            button.addEventListener('click', () => {
                const group = button.closest('.sidebar-group');
                const isOpen = group.classList.toggle('is-expanded');
                button.setAttribute('aria-expanded', String(isOpen));
            });
        });

        const notificationButton = document.querySelector('.notification-button');
        const notificationPanel = document.querySelector('.notification-panel');

        if (notificationButton && notificationPanel) {
            notificationButton.addEventListener('click', (event) => {
                event.stopPropagation();
                const isOpen = notificationButton.getAttribute('aria-expanded') === 'true';
                notificationButton.setAttribute('aria-expanded', String(!isOpen));
                notificationPanel.hidden = isOpen;
            });

            document.addEventListener('click', (event) => {
                if (!event.target.closest('.notification-wrap')) {
                    notificationButton.setAttribute('aria-expanded', 'false');
                    notificationPanel.hidden = true;
                }
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                sidebar.classList.remove('is-open');
                document.body.classList.remove('sidebar-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                if (notificationButton && notificationPanel) {
                    notificationButton.setAttribute('aria-expanded', 'false');
                    notificationPanel.hidden = true;
                }
            }
        });

        document.querySelectorAll('.modal').forEach((modal) => {
            if (modal.querySelector('.form-errors')) {
                bootstrap.Modal.getOrCreateInstance(modal).show();
            }
        });
        </script>
</body>
</html>
