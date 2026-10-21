<x-guest-layout>
      

      @section('auth')
         <div>
             <x-validation-errors class="mb-4" />
                    <!-- Form Header -->
                    <div class="form-header">
                        <div class="badge-tag">
                            <i class='bx bx-lock-alt'></i>
                            Acesso Restrito
                        </div>
                        <h1 class="form-title">Acessar o Sistema</h1>
                        <p class="form-subtitle">Introduza as suas credenciais para aceder ao painel.</p>
                    </div>

                    <!-- Alert message container -->
                    <div id="alertBox" class="alert-box">
                        <i id="alertIcon" class='bx bx-error-circle'></i>
                        <span id="alertText">Mensagem de aviso</span>
                    </div>

                    <!-- Login Form -->
                    <form id="loginForm1" class="login-form" action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Email Input -->
                        <div class="input-group">
                            <label for="email" class="input-label">Email ou Utilizador</label>
                            <div class="input-wrapper">
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="custom-input" 
                                    placeholder="utilizador@maternocambanda.ao"
                                    required
                                >
                                <i class='bx bx-envelope input-icon-left'></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="input-group">
                            <div class="input-label-row">
                                <label for="password" class="input-label">Palavra-passe</label>
                                <a href="#" id="forgotPasswordLink" class="forgot-link">Esqueceu a senha?</a>
                            </div>
                            <div class="input-wrapper">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="custom-input" 
                                    placeholder="••••••••••••"
                                    required
                                >
                                <i class='bx bx-key input-icon-left'></i>
                                <button type="button" id="togglePasswordBtn" class="toggle-password-btn" aria-label="Alternar visibilidade da palavra-passe">
                                    <i class='bx bx-hide' id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Options Row -->
                        <div class="checkbox-group">
                            <label class="checkbox-container">
                                <input type="checkbox" id="remember" class="custom-checkbox">
                                <span>Lembrar-me neste computador</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="btnSubmit" class="btn-submit">
                            <span id="btnText">Entrar no Sistema</span>
                            <i class='bx bx-log-in-circle' id="btnIcon"></i>
                        </button>
                    </form>
                </div>

                <!-- Form Footer -->
                <footer class="form-footer">
                    <span>SGI Cambanda</span>
                    <a href="#" class="support-link" id="supportLink">
                        <i class='bx bx-support'></i>
                        Suporte Técnico
                    </a>
                </footer>

      @endsection

       
</x-guest-layout>