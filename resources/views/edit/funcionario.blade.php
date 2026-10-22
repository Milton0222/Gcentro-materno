<x-app-layout>

      @section('corpo')
        
      <div class="corpo">
    <div class="search">

      <H3>Actualizar dados</H3>

      <div class="form">


        <form action="{{route('funcionario.search')}}" method="get" class="formSearch">
            @csrf
          
          <div>
            <a  href="{{route('funcionario.index')}}">Listar</a>
            
          </div>
          <div>

            <input type="email" name="search" id="" required>
            <button type="submit" class="btn-search"><i style="font-size:20px;" class="bx bx-search"></i></button>
          </div>

        </form>

      </div>


    </div>


    <div class="table-responsive">
      <table>
        <form action="{{route('funcionario.update', $users->id)}}" method="post">
             @csrf
             @method('put')
          <div class="group-input">

            <div>
              <label for="">Nome do Funcionario</label><br>
              <input type="text" name="name" id="" class="formc" required placeholder="Informe o nome do funcionario" value="{{$users->name}}">
            </div>
            <div class="row">

              <div class="col">
                <div>
                  <label for="">Email</label><br>
                  <input type="email" name="email" id="" class="formc" placeholder="exemplo@gmail.com" required value="{{$users->email}}">
                </div>
               
                <div >
                  <button type="submit">Actualizar</button>
               
                </div>

              </div>
              <div class="col">
              <div>
                  <label for="">Genero</label><br>
                  <select name="genero" id class="formc" required>
                    <option selected value="{{$users->genero}}">{{$users->genero}}</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                  </select>
                </div>
                <div class="nivel">
                  <label for="">Nivel de acesso</label><br>
                            @if($users->isAdmin)
                            Administrador/
                            @endif
                            @if($users->isResponsavel)
                            Responsavel de sala/
                            @endif
                            @if($users->isSecretaria)
                            Secretario/a/
                            @endif
                            @if($users->isEstatistico)
                            Estatistico
                            @else
                            Indefinido
                            @endif

                            <div>
                                <label for="">Secretario/a</label>
                                <input type="checkbox" name="secretario" id="" class="">
                                <label for="">Responsavel</label>
                                <input type="checkbox" name="responsavel" id="" class="">
                                <label for="">Estatistico</label>
                                <input type="checkbox" name="estatistico" id="" class="">
                                <label for="">Desabilitar</label>
                                <input type="checkbox" name="desabilitar" id="" class="">
                            </div>
                
                </div>
                 
                </div>
              </div>

            </div>

          </div>

        </form>
      </table>
    </div>

  </div>

      @endsection
</x-app-layout>