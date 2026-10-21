<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SGI Cambanda - Login | Centro Materno Infantil da Cambanda') }}</title>

        <!-- Boxicons CSS Library -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/assetes/style.css')}}">
       
    </head>
    <body>
         <!-- Header / Navigation bar -->
    <header class="site-header">
        <div class="header-container">
            <!-- Brand Logo -->
            <a href="/" class="brand-logo" title="Centro Materno Infantil da Cambanda">
                <div class="brand-icon">
                    <i class='bx bx-plus-medical'></i>
                </div>
                <div>
                    <div class="brand-text-title">SGI Cambanda</div>
                    <div class="brand-text-subtitle">Centro Materno Infantil</div>
                </div>
            </a>

            <!-- Back to Landing Page link -->
            <a href="/" class="btn-back-landing" id="btnBackLanding">
                <i class='bx bx-left-arrow-alt'></i>
                <span>Voltar ao Início</span>
            </a>
        </div>
    </header>

        <!-- Main Container -->
    <main class="main-wrapper">
        <div class="login-card-container">
                 <!-- LEFT COLUMN: LOGIN FORM -->
            <section class="form-column">
                    @yield('auth')

            </section>
            <!-- RIGHT COLUMN: EXPLANATORY PANEL -->
            <section class="info-column">
                <!-- Info Top Badge -->
                <div class="info-header">
                    <div class="security-badge">
                        <i class='bx bx-shield-quarter'></i>
                        Dados Encriptados & Seguros
                    </div>
                    <i class='bx bx-first-aid' style="font-size: 1.5rem; opacity: 0.8;"></i>
                </div>

                <!-- Info Body -->
                <div class="info-body">
                    <h2 class="info-title">Gestão Clínica de Saúde Materno-Infantil</h2>
                    <p class="info-description">
                        Plataforma centralizada para o registo, acompanhamento e otimização dos cuidados de saúde prestados às mães e crianças do Centro Materno Infantil da Cambanda.
                    </p>

                    <!-- Modules list -->
                    <div class="modules-list">
                        
                        <!-- Module 1: Pre-Natal -->
                        <div class="module-item">
                            <div class="module-icon-box">
                                <i class='bx bx-female'></i>
                            </div>
                            <div>
                                <div class="module-text-title">Acompanhamento Pré-Natal</div>
                                <div class="module-text-desc">Gestão de consultas, exames e fichas de acompanhamento gestacional.</div>
                            </div>
                        </div>

                        <!-- Module 2: Pediatric -->
                        <div class="module-item">
                            <div class="module-icon-box">
                                <i class='bx bx-child'></i>
                            </div>
                            <div>
                                <div class="module-text-title">Módulo Pediátrico & Vacinação</div>
                                <div class="module-text-desc">Controlo de crescimento e calendário vacinal para recém-nascidos.</div>
                            </div>
                        </div>

                        <!-- Module 3: Medical Record -->
                        <div class="module-item">
                            <div class="module-icon-box">
                                <i class='bx bx-file-find'></i>
                            </div>
                            <div>
                                <div class="module-text-title">Registo Materno Digital</div>
                                <div class="module-text-desc">Acesso rápido ao histórico clínico unificado dos pacientes.</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Info Footer -->
                <div class="info-footer">
                    <div class="info-footer-status">
                        <span class="status-dot"></span>
                        <span>Servidor Ativo</span>
                    </div>
                    <span>&copy; 2026 Centro Materno da Cambanda</span>
                </div>
            </section>
            {{ $slot }}
        </div>

    </main>

    
    </body>
</html>
