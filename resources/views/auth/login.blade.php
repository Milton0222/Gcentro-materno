<x-guest-layout>

    <div class="principal">
        <div class="menu" style="margin-top: 20px;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            </ul>

        </div>
        <div class="conteiner">
            <div class="info">
          
                <img src="doctor.jpg" alt="" srcset="">
                <div class="rodape">
                <x-validation-errors class="mb-4" />
                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

                </div>
            </div>
            <div class="menuDireito">
           
            <h1 class="titulo">CENTRO MATERNO DA <span>CAMBANDA</span> </h1>
                <form method="POST" action="{{ route('login') }}" class="formUser">
                    @csrf
               
                    <div class="inputuser">
                        <div>
                            <label for="">User Name</label><br>
                            <input type="email" name="email" id="" :value="old('email')" required autofocus autocomplete="username" required>
                        </div>
                        <div>
                            <label for="">Password</label><br>
                            <input type="password" name="password" id="" required name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="btn-entrar">
                        <div><button type="reset" class="limpar">Limpar</button></div>
                        <div><button type="submit" class="salvar">Entrar</button></div>
                    </div>
                    <div class="rotulo">
                        <a href="">Esqueceu password?</a>
                    </div>

                </form>
            </div>
        </div>


       
</x-guest-layout>