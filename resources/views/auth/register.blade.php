<x-guest-layout>



<div class="principal">
        <div class="menu">
             <ul>
                 <li><a href="login.html">Entrar</a></li>
                 <li><a href="index.html">Home</a></li>
                 <li><a href="dashboard.html">Dashboard</a></li>
             </ul>

        </div>
        <div class="conteiner">
            <div class="info">
                <h1 class="titulo">CENTRO MATERNO DA <span>CAMBANDA</span> </h1>
                <img src="doctor.jpg" alt="" srcset="">
                <div class="rodape">

                </div>
            </div>
            <x-validation-errors class="mb-4" />
            <div class="menuDireito">
                   
                    <form method="POST" action="{{ route('register') }}" class="formUser">
                        @csrf
                        <div class="inputuser">
                        <div>
                                <label for="">Nome</label><br>
                                <input type="text" name="name" id="" required>
                            </div>
                            <div>
                                <label for="">User Name</label><br>
                                <input type="email" name="email" id="" required>
                            </div>
                            <div class="row">
                                <div>
                                    <label for="">Password</label><br>
                                    <input type="password" name="password" id="" required>

                                </div>
                                <div>
                                    <label for="">Confirmar Password</label><br>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password">

                                </div>
                              
                            </div>
                        </div>
                        <div class="btn-entrar">
                            <div><button type="reset" class="limpar">Limpar</button></div>
                            <div><button type="submit" class="salvar">Salvar</button></div>
                        </div>
                        <div class="rotulo">
                            <a href="login.html">Já tem uma conta?</a>
                        </div>

                    </form>
            </div>
        </div>

        
</div>



</x-guest-layout>
