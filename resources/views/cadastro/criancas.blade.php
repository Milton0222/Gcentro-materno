<x-app-layout>
    
  @section('corpo')


  <div class="corpo">
    <div class="search">

      <H3>Registrar criança</H3>

      <div class="form">


        <form action="{{route('crianca.show')}}" method="get" class="formSearch">
          <div>
            <a href="{{route('crianca.index')}}">Listar</a>
          </div>
          <div>

            <input type="date" name="search" id="" required>
            <button type="submit" class="btn-search"><i style="font-size:20px;" class="bx bx-search"></i></button>
          </div>

        </form>

      </div>


    </div>


    <div class="table-responsive">
      <table>
        <form action="{{route('crianca.store')}}" method="post">
          @csrf
          @method('post')

          <div class="group-input">


            <div class="row">
              <div class="col">
                <div>
                  <label for="">Nome</label><br>
                  <input type="text" name="nome" id="" class="formc" required placeholder="Informe o nome da criança">
                </div>
                <div>
                  <label for="">Mãe</label><br>
                  <select name="pacienteID" id="" class="formc">
                    <option value="{{$parto->id}}">{{App\Models\pacientes::find($parto->pacienteID)->nome}}</option>
                  </select>
                </div>
                <div>
                  <label for="">Peso</label><br>
                  <input type="number" name="peso" id="" class="formc" required placeholder="Informe o peso do recem nascido">
                </div>
                <div>
                  <label for="">Hora do parto</label><br>
                  <input type="time" name="hora" id="" class="formc" required placeholder="Informe a hora de nascimento">
                </div>

              </div>
              <div class="col">
                <div>
                  <label for="">Data de nascimento</label><br>
                  <input type="date" name="dataParto" id="" class="formc" required>
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