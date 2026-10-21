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

      <H3>Gerir paciente</H3>

      <div class="form">


        <form action="" method="get" class="formSearch">
          <div>
            <a href="{{route('paciente.index')}}">Listar</a>
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
        <form action="{{route('paciente.update',$paciente->id)}}" method="post">
          @csrf
          @method('put')

          <div class="group-input">


            <div class="row">
              <div class="col">
                <div>
                  <label for="">Nome</label><br>
                  <input type="text" name="nome" id="" class="formc" value="{{$paciente->nome}}" required placeholder="Informe o nome do paciente">
                </div>
                <div>
                  <label for="">Morada</label><br>
                  <input type="text" name="morada" id="" class="formc" value="{{$paciente->morada}}" required placeholder="Municipio/Bairro/Rua">
                </div>
                <div>
                  <label for="">Contacto</label><br>
                  <input type="number" name="contacto" id="" class="formc" value="{{$paciente->contacto}}" required placeholder="9xx xxx xxx">
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
                    <option selected value="{{$paciente->genero}}">{{$paciente->genero}}</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                  </select>
                </div>

                <div>
                  <label for="">Tipo pacinte</label><br>
                  <input type="text" name="tipo_paciente" id="" class="formc" value="{{$paciente->tipoPaciente}}" required placeholder="Informe o tipo de paciente">
                </div>

              </div>
              <div class="col">

                <div>
                  <label for="">Estado</label><br>
                  <input type="text" name="estado" id="" class="formc" value="{{$paciente->estado}}" placeholder="Informe o estado do paciente">
                </div>
                <div>
                  <label for="">Saude</label><br>
                  <input type="text" name="saude" id="" class="formc" value="{{$paciente->saude}}" placeholder=".....">
                </div>

                <div class="btng">
                  <button type="submit"><i class='bx bxs-edit-alt'></i></button>
                  <button type="button" class="btn-apagar" data-bs-toggle="modal" data-bs-target="#apagar"><i class='bx bxs-coffee-togo'></i></button>

                  <button type="button" class="btn-consulta" data-bs-toggle="modal" data-bs-target="#marcar"><i class='bx bxs-edit'></i></button>
                  <button type="button" class="btn-parto" data-bs-toggle="modal" data-bs-target="#parto">Parto</button>

                </div>

              </div>

            </div>

          </div>

        </form>
      </table>

      <!-- Modal marcar consulta -->
  <div class="modal fade" id="marcar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Marcar consulta do sr(a),{{$paciente->nome}}...</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
    
          <form action="{{route('consulta.marcar',$paciente->id)}}" method="POST" class="form-control">
            @csrf
            @method('post')


            <div class="group-input">


              <div class="row">
                <div class="col">
                  <div>
                    <label for="">Doutor/tecnico</label><br>
                    <input type="text" name="doutor" id="" class="formc" required placeholder="Informe o nome do medico">
                  </div>
                  <div>
                    <label for="">Data da consulta</label><br>
                    <input type="date" name="dataConsulta" id="" class="formc">
                  </div>
                  <div>
                    <label for="">Hora da consulta</label><br>
                    <input type="time" name="hora" id="" class="formc" required placeholder="9xx xxx xxx">
                  </div>
                  <div>
                     <label for="">Tipo da consulta</label>
                     <input type="text" class="formc" name="tipoConsulta" required placeholder="Informe o tipo de consulta">
                  </div>
                  <div>
                    <label for="">Queixa principal</label><br>
                    <textarea name="queixaPrincipal" class="formc"></textarea>
                  </div>
                  <div>
                    <label for="">Pressão arterial</label><br>
                    <input type="text" name="pressaoArterial" class="formc" placeholder="Ex.: 120/80 mmHg">
                  </div>
                  <div>
                    <label for="">Frequência cardíaca (bpm)</label><br>
                    <input type="number" name="frequenciaCardiaca" class="formc" min="0">
                  </div>
                  <div>
                    <label for="">Frequência respiratória (rpm)</label><br>
                    <input type="number" name="frequenciaRespiratoria" class="formc" min="0">
                  </div>
                  <div>
                    <label for="">Temperatura (°C)</label><br>
                    <input type="number" name="temperatura" class="formc" min="0" step="0.1">
                  </div>
                  <div>
                    <label for="">Saturação de oxigénio (%)</label><br>
                    <input type="number" name="saturacaoOxigenio" class="formc" min="0" max="100" step="0.1">
                  </div>
                  <div>
                    <label for="">Peso (kg)</label><br>
                    <input type="number" name="peso" class="formc" min="0" step="0.01">
                  </div>
                  <div>
                    <label for="">Altura (m)</label><br>
                    <input type="number" name="altura" class="formc" min="0" step="0.01">
                  </div>
                  <div>
                    <label for="">Idade gestacional (semanas)</label><br>
                    <input type="number" name="idadeGestacionalSemanas" class="formc" min="0" max="45">
                  </div>
                  <div>
                    <label for="">Batimentos fetais (bpm)</label><br>
                    <input type="number" name="batimentosFetais" class="formc" min="0">
                  </div>
                  <div>
                    <label for="">Classificação de risco</label><br>
                    <input type="text" name="classificacaoRisco" class="formc">
                  </div>
                  <div>
                    <label for="">Observações da triagem</label><br>
                    <textarea name="observacoesTriagem" class="formc"></textarea>
                  </div>

                </div>
               
              

              </div>

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn-apagar">Salvar</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Fim Modal -->


  <!-- Modal registar parto -->
  <div class="modal fade" id="parto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registar parto da paciente {{$paciente->nome}}...</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
    
          <form action="{{route('parto.store',$paciente->id)}}" method="POST" class="form-control">
            @csrf
            @method('post')


            <div class="group-input">


              <div class="row">
                <div class="col">
                  <div>
                    <label for="">Estado</label><br>
                    <input type="text" name="estado" id="" class="formc" required placeholder="Informe o estado da paciente">
                  </div>
                  <div>
                    <label for="">Tipo</label><br>
                    <input type="text" name="tipo" id="" class="formc" placeholder="Informe o tipo de parto">
                  </div>
                  <div>
                    <label for="">OBS</label><br>
                    <textarea name="obs" id="" cols="30" rows="10" class="formt"></textarea>
                  </div>
                 

                </div>
               
              

              </div>

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn-apagar">Salvar</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Fim Modal -->
    </div>

  </div>

  @endsection

  <!-- Modal apagar -->
  <div class="modal fade" id="apagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Apagando os dados de {{$paciente->nome}}...</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">

          <form action="{{route('paciente.destroy',$paciente->id)}}" method="POST" class="form-control">
            @csrf
            @method('delete')
            <p style="font-size: 20pt; text-align: center;">Desejas apagar os dados do paciente {{$paciente->nome}}?</p>
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