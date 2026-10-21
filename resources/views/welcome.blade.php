<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f3fbfa">
    <meta name="description" content="Sistema de gestão de informação clínica do Centro Materno da Cambanda.">

    <title>{{ config('app.name', 'Centro Materno da Cambanda') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetes/landing.css') }}">
</head>
<body>
    <a class="skip-link" href="#conteudo">Saltar para o conteúdo</a>

    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ url('/') }}" aria-label="Centro Materno da Cambanda - página inicial">
                <span class="brand-icon" aria-hidden="true"><i class="bx bx-plus-medical"></i></span>
                <span class="brand-copy">
                    <strong>Centro Materno</strong>
                    <small>da Cambanda</small>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="site-navigation">
                <i class="bx bx-menu" aria-hidden="true"></i>
            </button>

            <nav class="site-navigation" id="site-navigation" aria-label="Navegação principal">
                <a class="nav-link active" href="#inicio">Início</a>
                <a class="nav-link" href="#sobre">Sobre o sistema</a>
                <a class="nav-link" href="#modulos">Módulos</a>
                <a class="nav-link" href="#contactos">Contactos</a>
                @if (Route::has('login'))
                    @auth
                        <a class="button button-primary nav-action" href="{{ url('/dashboard') }}">
                            Aceder ao sistema <i class="bx bx-right-arrow-alt" aria-hidden="true"></i>
                        </a>
                    @else
                        <a class="button button-primary nav-action" href="{{ route('login') }}">
                            Entrar <i class="bx bx-right-arrow-alt" aria-hidden="true"></i>
                        </a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <main id="conteudo">
        <section class="hero section-wrap" id="inicio">
            <div class="hero-content">
                <span class="eyebrow"><span class="eyebrow-dot"></span> Cuidado materno e infantil</span>
                <h1>Mais cuidado.<br><span>Melhor gestão.</span></h1>
                <p class="hero-description">
                    Uma plataforma para organizar a informação e acompanhar cada etapa do cuidado,
                    desde a consulta pré-natal até ao nascimento.
                </p>
                <div class="hero-actions">
                    @if (Route::has('login'))
                        @auth
                            <a class="button button-primary button-large" href="{{ url('/dashboard') }}">
                                Aceder ao sistema <i class="bx bx-right-arrow-alt" aria-hidden="true"></i>
                            </a>
                        @else
                            <a class="button button-primary button-large" href="{{ route('login') }}">
                                Entrar no sistema <i class="bx bx-right-arrow-alt" aria-hidden="true"></i>
                            </a>
                        @endauth
                    @endif
                    <a class="button button-secondary button-large" href="#modulos">
                        Conhecer os módulos <i class="bx bx-down-arrow-alt" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="hero-note">
                    <span class="note-icon"><i class="bx bx-shield-quarter" aria-hidden="true"></i></span>
                    <span>Informação organizada para apoiar o trabalho da equipa de saúde.</span>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-image-frame">
                    <img src="{{ asset('doctor.jpg') }}" alt="Profissional de saúde a acompanhar uma mãe e o seu bebé">
                </div>
                <div class="image-decoration image-decoration-one" aria-hidden="true"></div>
                <div class="image-decoration image-decoration-two" aria-hidden="true"></div>
                <div class="hero-badge">
                    <span class="badge-icon"><i class="bx bx-heart" aria-hidden="true"></i></span>
                    <span><strong>Cuidado em cada etapa</strong><small>Mãe, bebé e família</small></span>
                </div>
                <div class="hero-sticker" aria-hidden="true"><i class="bx bx-plus-medical"></i></div>
            </div>
        </section>

        <section class="stats-section" aria-label="Indicadores do centro">
            <div class="stats-inner">
                <div class="stat-item">
                    <span class="stat-icon stat-green"><i class="bx bx-user" aria-hidden="true"></i></span>
                    <span class="stat-copy"><strong>{{ number_format($pacientec, 0, ',', '.') }}</strong><small>Pacientes registadas</small></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon stat-blue"><i class="bx bx-calendar-heart" aria-hidden="true"></i></span>
                    <span class="stat-copy"><strong>{{ number_format($consultac, 0, ',', '.') }}</strong><small>Consultas registadas</small></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon stat-peach"><i class="bx bx-baby-carriage" aria-hidden="true"></i></span>
                    <span class="stat-copy"><strong>{{ number_format($partoc, 0, ',', '.') }}</strong><small>Partos registados</small></span>
                </div>
            </div>
        </section>

        <section class="intro-section section-wrap" id="sobre">
            <div class="section-heading">
                <span class="eyebrow">Apoio à equipa de saúde</span>
                <h2>Informação certa, no momento certo.</h2>
                <p>
                    O sistema ajuda a manter os dados do centro organizados e acessíveis aos profissionais
                    autorizados, contribuindo para um acompanhamento mais claro e contínuo.
                </p>
            </div>
            <div class="intro-points">
                <article class="intro-point">
                    <span class="point-icon"><i class="bx bx-folder-open" aria-hidden="true"></i></span>
                    <div><h3>Registos organizados</h3><p>Histórico de pacientes e atendimentos reunido num só lugar.</p></div>
                </article>
                <article class="intro-point">
                    <span class="point-icon point-icon-blue"><i class="bx bx-group" aria-hidden="true"></i></span>
                    <div><h3>Trabalho articulado</h3><p>Suporte às rotinas de atendimento, acompanhamento e gestão.</p></div>
                </article>
                <article class="intro-point">
                    <span class="point-icon point-icon-lime"><i class="bx bx-lock-alt" aria-hidden="true"></i></span>
                    <div><h3>Acesso por perfil</h3><p>As funcionalidades são disponibilizadas de acordo com o perfil de acesso.</p></div>
                </article>
            </div>
        </section>

        <section class="modules-section" id="modulos">
            <div class="section-wrap">
                <div class="modules-heading">
                    <div class="section-heading">
                        <span class="eyebrow">O que pode gerir</span>
                        <h2>Módulos do sistema</h2>
                        <p>As principais áreas de informação do Centro Materno da Cambanda.</p>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <a class="text-link" href="{{ url('/dashboard') }}">Ir para o painel <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                        @else
                            <a class="text-link" href="{{ route('login') }}">Entrar para continuar <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                        @endauth
                    @endif
                </div>

                <div class="module-grid">
                    <article class="module-card">
                        <span class="module-icon module-green"><i class="bx bx-user-plus" aria-hidden="true"></i></span>
                        <h3>Pacientes</h3>
                        <p>Registo e consulta dos dados de identificação e do histórico de cada paciente.</p>
                        <span class="module-tag">Acompanhamento</span>
                    </article>
                    <article class="module-card">
                        <span class="module-icon module-blue"><i class="bx bx-calendar-check" aria-hidden="true"></i></span>
                        <h3>Consultas e triagem</h3>
                        <p>Marcação de consultas e registo de informações relevantes para a triagem.</p>
                        <span class="module-tag">Pré-natal</span>
                    </article>
                    <article class="module-card">
                        <span class="module-icon module-lime"><i class="bx bx-heart-circle" aria-hidden="true"></i></span>
                        <h3>Planeamento familiar</h3>
                        <p>Organização dos registos de planeamento familiar associados à paciente.</p>
                        <span class="module-tag">Saúde familiar</span>
                    </article>
                    <article class="module-card">
                        <span class="module-icon module-peach"><i class="bx bx-plus-medical" aria-hidden="true"></i></span>
                        <h3>Partos</h3>
                        <p>Registo do parto e ligação ao histórico de cuidados da paciente.</p>
                        <span class="module-tag">Maternidade</span>
                    </article>
                    <article class="module-card">
                        <span class="module-icon module-purple"><i class="bx bx-child" aria-hidden="true"></i></span>
                        <h3>Recém-nascidos</h3>
                        <p>Registo das crianças nascidas, associadas ao respectivo parto.</p>
                        <span class="module-tag">Saúde infantil</span>
                    </article>
                    <article class="module-card">
                        <span class="module-icon module-teal"><i class="bx bx-bar-chart-alt-2" aria-hidden="true"></i></span>
                        <h3>Relatórios e gestão</h3>
                        <p>Informação de apoio ao acompanhamento do fluxo e à produção de estatísticas.</p>
                        <span class="module-tag">Gestão do centro</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="closing-section section-wrap">
            <div class="closing-card">
                <div>
                    <span class="eyebrow">Centro Materno da Cambanda</span>
                    <h2>Pronto para aceder ao sistema?</h2>
                    <p>Entre com a sua conta de utilizador para continuar para o painel.</p>
                </div>
                @if (Route::has('login'))
                    @auth
                        <a class="button button-white" href="{{ url('/dashboard') }}">Aceder ao painel <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @else
                        <a class="button button-white" href="{{ route('login') }}">Entrar no sistema <i class="bx bx-right-arrow-alt" aria-hidden="true"></i></a>
                    @endauth
                @endif
            </div>
        </section>
    </main>

    <footer class="site-footer" id="contactos">
        <div class="footer-main section-wrap">
            <div class="footer-about">
                <a class="brand footer-brand" href="{{ url('/') }}">
                    <span class="brand-icon" aria-hidden="true"><i class="bx bx-plus-medical"></i></span>
                    <span class="brand-copy"><strong>Centro Materno</strong><small>da Cambanda</small></span>
                </a>
                <p>Sistema de gestão de informação para apoiar o cuidado materno e infantil.</p>
            </div>
            <div class="footer-links">
                <h2>Navegação</h2>
                <a href="#inicio">Início</a>
                <a href="#sobre">Sobre o sistema</a>
                <a href="#modulos">Módulos</a>
            </div>
            <div class="footer-contact">
                <h2>Contactos e localização</h2>
                <p><i class="bx bx-map" aria-hidden="true"></i><span>Cambanda, Angola</span></p>
                <p><i class="bx bx-building-house" aria-hidden="true"></i><span>Centro Materno da Cambanda</span></p>
                <a href="https://www.google.com/maps/search/?api=1&query=Cambanda%2C%20Angola" target="_blank" rel="noopener noreferrer">
                    Ver localização no mapa <i class="bx bx-link-external" aria-hidden="true"></i>
                </a>
                <small>Para informações, contacte a secretaria do centro.</small>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="section-wrap">
                <span>&copy; {{ date('Y') }} Centro Materno da Cambanda</span>
                <a href="#inicio">Voltar ao topo <i class="bx bx-up-arrow-alt" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.site-navigation');

        menuToggle.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
            menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu' : 'Fechar menu');
            navigation.classList.toggle('is-open', !isOpen);
        });

        navigation.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Abrir menu');
                navigation.classList.remove('is-open');
            });
        });
    </script>
</body>
</html>
