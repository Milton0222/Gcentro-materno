<x-app-layout>
@section('cartao')
     <div class="cardu">
          <div class="card1">
            <p class="total">+{{$pacientec}}</p>
            <span>
              <h3>Paciente</h3>

              <a href="{{route('paciente.storeShow')}}">Registar</a>
            </span>


          </div>
          <div class="card1">
            <p class="total">+{{$consultac}}</p>
            <span>
              <h3>Consultas</h3>

              <a href="{{route('consulta.index')}}"><i class='bx bxs-low-vision'></i></a>

            </span>
          </div>
          <div class="card1">
            <p class="total">+{{$funcionarioc}}</p>
            <span>
              <h3>Funcionarios</h3>
              <a href="{{route('funcionario.index')}}"><i class='bx bxs-low-vision'></i></a>

            </span>
          </div>
          <div class="card1">
            <p class="total">+{{$partoc}}</p>
            <span>
              <h3>Partos</h3>
              <a href="{{route('parto.index')}}"><i class='bx bxs-low-vision'></i></a>

            </span>
          </div>


        </div>
     @endsection

  @section('corpo')


  <div class="corpo">
    <div class="search">

      <H3>Registrar paciente</H3>

      <div class="form">


        <form action="" method="get" class="formSearch">
          <div>
            <a  href="{{route('paciente.index')}}">Listar</a>
          </div>
          <div>

            <input type="text" name="search" id="" required>
            <button type="submit" class="btn-search"><i style="font-size:20px;" class="bx bx-search"></i></button>
          </div>

        </form>

      </div>


    </div>


    <div class="table-responsive">
      <table>
        <form action="{{route('paciente.store')}}" method="post">
            @csrf
            @method('post')

          <div class="group-input">

           
            <div class="row">
                 <div class="col">
                 <div>
              <label for="">Nome</label><br>
              <input type="text" name="nome" id="" class="formc" required placeholder="Informe o nome do paciente">
            </div>
            <div>
              <label for="">Morada</label><br>
              <input type="text" name="morada" id="" class="formc" required placeholder="Municipio/Bairro/Rua">
            </div>
            <div>
              <label for="">Contacto</label><br>
              <input type="number" name="contacto" id="" class="formc" required placeholder="9xx xxx xxx">
            </div>

                 </div>
              <div class="col">
                <div>
                  <label for="">Data de nascimento</label><br>
                  <input type="date" name="nascimento" id="" class="formc" required>
                </div>
                <div>
                  <label for="">Genero</label><br>
                  <select name="genero" id class="formc" required>
                    <option value="">Escolher</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                  </select>
                </div>

                <div>
                  <label for="">Tipo pacinte</label><br>
                  <input type="text" name="tipo_paciente" id="" class="formc" required placeholder="Informe o tipo de paciente">
                </div>

              </div>
              <div class="col">
               
                <div>
                  <label for="">Estado</label><br>
                  <input type="text" name="estado" id="" class="formc" placeholder="Informe o estado do paciente">
                </div>
                <div>
                  <label for="">Saude</label><br>
                  <input type="text" name="saude" id="" class="formc" placeholder=".....">
                </div>
                
                <div>
                  <button type="submit">Salvar</button>
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