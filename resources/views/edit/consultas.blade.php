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

      <H3>Gerir consulta</H3>

      <div class="form">


        <form action="{{route('consulta.show')}}" method="get" class="formSearch">
          <div>
            <a href="{{route('consulta.index')}}">Listar</a>
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
        <form action="{{route('consulta.update',$consulta->id)}}" method="post">
          @csrf
          @method('put')

          <div class="group-input">


            <div class="row">
              <div class="col">
                <div>
                  <label for="">Paciente</label><br>
                  <input type="text" name="nome" id="" class="formc" value="{{App\Models\pacientes::find($consulta->pacienteID)->nome}}" required >
                </div>
                <div>
                    <label for="">Doutor/tecnico</label><br>
                    <input type="text" name="doutor" id="" class="formc" value="{{$consulta->doutor}}" required placeholder="Informe o nome do medico">
                  </div>
                  <div>
                    <label for="">Data da consulta</label><br>
                    <input type="date" name="dataConsulta" id="" value="{{$consulta->dataConsulta}}" class="formc">
                  </div>

              </div>
             
              <div class="col">
              <div>
                    <label for="">Hora da consulta</label><br>
                    <input type="time" name="hora" id="" class="formc" value="{{$consulta->hora}}" required placeholder="9xx xxx xxx">
                  </div>
                  <div>
                     <label for="">Tipo da consulta</label>
                     <input type="text" class="formc" name="tipoConsulta" value="{{$consulta->tipoConsulta}}" required placeholder="Informe o tipo de consulta">
                  </div>
                  <div>
                    <label for="">Queixa principal</label><br>
                    <textarea name="queixaPrincipal" class="formc">{{$consulta->queixaPrincipal}}</textarea>
                  </div>
                  <div>
                    <label for="">Pressão arterial</label><br>
                    <input type="text" name="pressaoArterial" class="formc" value="{{$consulta->pressaoArterial}}" placeholder="Ex.: 120/80 mmHg">
                  </div>
                  <div>
                    <label for="">Frequência cardíaca (bpm)</label><br>
                    <input type="number" name="frequenciaCardiaca" class="formc" min="0" value="{{$consulta->frequenciaCardiaca}}">
                  </div>
                  <div>
                    <label for="">Frequência respiratória (rpm)</label><br>
                    <input type="number" name="frequenciaRespiratoria" class="formc" min="0" value="{{$consulta->frequenciaRespiratoria}}">
                  </div>
                  <div>
                    <label for="">Temperatura (°C)</label><br>
                    <input type="number" name="temperatura" class="formc" min="0" step="0.1" value="{{$consulta->temperatura}}">
                  </div>
                  <div>
                    <label for="">Saturação de oxigénio (%)</label><br>
                    <input type="number" name="saturacaoOxigenio" class="formc" min="0" max="100" step="0.1" value="{{$consulta->saturacaoOxigenio}}">
                  </div>
                  <div>
                    <label for="">Peso (kg)</label><br>
                    <input type="number" name="peso" class="formc" min="0" step="0.01" value="{{$consulta->peso}}">
                  </div>
                  <div>
                    <label for="">Altura (m)</label><br>
                    <input type="number" name="altura" class="formc" min="0" step="0.01" value="{{$consulta->altura}}">
                  </div>
                  <div>
                    <label for="">Idade gestacional (semanas)</label><br>
                    <input type="number" name="idadeGestacionalSemanas" class="formc" min="0" max="45" value="{{$consulta->idadeGestacionalSemanas}}">
                  </div>
                  <div>
                    <label for="">Batimentos fetais (bpm)</label><br>
                    <input type="number" name="batimentosFetais" class="formc" min="0" value="{{$consulta->batimentosFetais}}">
                  </div>
                  <div>
                    <label for="">Classificação de risco</label><br>
                    <input type="text" name="classificacaoRisco" class="formc" value="{{$consulta->classificacaoRisco}}">
                  </div>
                  <div>
                    <label for="">Observações da triagem</label><br>
                    <textarea name="observacoesTriagem" class="formc">{{$consulta->observacoesTriagem}}</textarea>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Apagando os dados da consulta nº {{$consulta->id}}...</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">

          <form action="{{route('consulta.destroy',$consulta->id)}}" method="POST" class="form-control">
            @csrf
            @method('delete')
            <p style="font-size: 20pt; text-align: center;">Desejas apagar os dados da consulta nº {{$consulta->id}} do paciente {{App\Models\pacientes::find($consulta->pacienteID)->nome}}?</p>
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