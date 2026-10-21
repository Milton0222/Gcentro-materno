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

            <H3>Gerir criança</H3>

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
                <form action="{{route('crianca.update',$crianca->id)}}" method="post">
                    @csrf
                    @method('put')

                    <div class="group-input">


                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="">Nome</label><br>
                                    <input type="text" name="nome" id="" class="formc" value="{{$crianca->nome}}" required placeholder="Informe o nome da criança">
                                </div>
                                <div>
                                    <label for="">Mãe</label><br>
                                    <select name="pacienteID" id="" class="formc">
                                        <option value="" selected>{{App\Models\pacientes::find(App\Models\partos::find($crianca->partoID)->pacienteID)->nome}}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="">Peso</label><br>
                                    <input type="number" name="peso" id="" class="formc" value="{{$crianca->peso}}" required placeholder="Informe o peso do recem nascido">
                                </div>
                                <div>
                                    <label for="">Hora do parto</label><br>
                                    <input type="time" name="hora" id="" class="formc" value="{{$crianca->hora}}" required placeholder="Informe a hora de nascimento">
                                </div>

                            </div>

                            <div class="col">

                                <div>
                                    <label for="">Data de nascimento</label><br>
                                    <input type="date" name="dataParto" id="" value="{{$crianca->dataParto}}" class="formc" required>
                                </div>
                                <div>
                                    <label for="">Genero</label><br>
                                    <select name="genero" id class="formc" required>
                                        <option selected value="{{$crianca->genero}}">{{$crianca->genero}}</option>
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                </div>


                                <div class="btng">
                                    <button type="submit"><i class='bx bxs-edit-alt'></i></button>
                                    <button type="button" class="btn-apagar" data-bs-toggle="modal" data-bs-target="#apagar"><i class='bx bxs-coffee-togo'></i></button>

                                    <!-- <button type="button" class="btn-consulta" data-bs-toggle="modal" data-bs-target="#marcar"><i class='bx bxs-edit'></i></button>-->

                                </div>

                            </div>

                        </div>

                    </div>

                </form>
            </table>
        </div>

    </div>



    @endsection




    <!-- Modal apagar -->
    <div class="modal fade" id="apagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apagando os dados de {{$crianca->nome}}...</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">

                    <form action="{{route('crianca.destroy',$crianca->id)}}" method="POST" class="form-control">
                        @csrf
                        @method('delete')
                        <p style="font-size: 20pt; text-align: center;">Desejas apagar os dados de {{$crianca->nome}}?</p>
                        <div class="modal-footer">
                            <button type="submit" class="btn-apagar">Sim</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Fim Modal -->

</x-app-layout>