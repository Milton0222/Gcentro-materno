<x-app-layout>


      @section('corpo')
        
      <div class="corpo">
    <div class="search">

      <H3>Registrar Funcionario</H3>

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
        <form action="{{route('funcionario.store')}}" method="post">
             @csrf

          <div class="group-input">

            <div>
              <label for="">Nome do Funcionario</label><br>
              <input type="text" name="name" id="" class="formc" required placeholder="Informe o nome do funcionario">
            </div>
            <div class="row">

              <div class="col">
                <div>
                  <label for="">Email</label><br>
                  <input type="email" name="email" id="" class="formc" placeholder="exemplo@gmail.com" required>
                </div>
               
                <div>
                  <button type="submit">Salvar</button>
                </div>

              </div>
              <div class="col">
              <div>
                  <label for="">Genero</label><br>
                  <select name="genero" id class="formc" required>
                    <option value="">Escolher</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                  </select>
                </div>
                <div>
                  <label for="">Nivel de acesso</label><br>
                  <select name="tipo" id class="formc" required>
                    <option>Escolher</option>
                    <option value="2">Secretario/a</option>
                    <option value="3">Responsavel de sala</option>
                    <option value="4">Estatistico</option>
                  </select>
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