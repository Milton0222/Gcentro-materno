<x-app-layout>

  @section('corpo')
  <div class="corpo">
    <div class="search">

      <H3>Paciente: {{$paciente->nome}}</H3>

      <div class="btn-group">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#marcar" title="Registar consulta">Consulta</button>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#parto" style="margin-right: 10px;" title="Registar parto">Parto</button>
        <form action="{{route('paciente.destroy',$paciente->id)}}" onsubmit="return confirm(`Desejas apagar o paciente {{$paciente->nome}}`)" method="post"> @csrf @method('put') <button type="submit" class="btn btn-danger" data-bs-toggle="modal"><i class='bx bxs-coffee-togo'></i></button></form>
      </div>
    </div>


    <div class="table-responsive">

      <form action="{{route('paciente.update',$paciente->id)}}" method="post">
        @csrf
        @method('put')

        <div class="form-control">
          <div class="row">
            <div class="col">
              <div>
                <label for="">Nome</label><br>
                <input type="text" name="nome" id="" class="form-control" value="{{$paciente->nome}}" required placeholder="Informe o nome do paciente">
              </div>
              <div>
                <label for="">Morada</label><br>
                <input type="text" name="morada" id="" class="form-control" value="{{$paciente->morada}}" required placeholder="Municipio/Bairro/Rua">
              </div>
            </div>
            <div class="col">
              <div>
                <label for="">Data de nascimento</label><br>
                <input type="date" name="nascimento" id="" value="{{$paciente->dataNascimento}}" class="form-control" required>
              </div>
              <div>
                <label for="">Genero</label><br>
                <select name="genero" id="" class="form-control" required>
                  <option selected value="{{$paciente->genero}}">{{$paciente->genero}}</option>
                  <option value="F">Femenino</option>
                  <option value="M">Masculino</option>
                </select>
              </div>
            </div>
            <div class="col">

              <div>
                <label for="">Estado</label><br>
                <input type="text" name="estado" id="" class="form-control" value="{{$paciente->estado}}" placeholder="Informe o estado do paciente">
              </div>
              <div>
                <label for="">Contacto</label><br>
                <input type="number" name="contacto" id="" class="form-control" value="{{$paciente->contacto}}" required placeholder="9xx xxx xxx">
              </div>

            </div>

          </div>
          <div>
            <label for="">Ultima triagem de saude</label><br>
            <textarea name="saude" class="form-control" rows="3">{{ $paciente->saude }}</textarea></label>
          </div>
        </div>
        <div class="modal-footer"><button class="button button-secondary" style="margin: 10px;" type="button" data-bs-dismiss="modal">Voltar ao painel pacientes</button><button class="button button-primary" type="submit"><i class='bx bxs-edit'></i>Alterar dados</button></div>
      </form>


      <!-- Modal registar consulta -->
      <div class="modal fade" id="marcar" tabindex="-1" aria-labelledby="patient-create-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end">
          <div class="modal-content">
            <div class="modal-header">
              <div>
                <h1> <span class="modal-kicker">Nova Consulta do paciente {{$paciente->nome}}</span></h1>
                <h2 id="patient-create-title">Registar consulta</h2>
                <p>Preencha os dados da triagem médica.</p>
              </div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button>
            </div>

            <form action="{{route('consulta.marcar',$paciente->id)}}" method="POST" class="form-control" style="overflow: auto;">
              @csrf
              <div>
                <label for="">Tipo de consulta Materna</label>
                <select name="tipoConsulta" id="" required class="form-control">
                  <option value="">--Selecionar--</option>
                  <option value="Planeamento Familiar">Planeamento Familiar</option>
                  <option value="Pré Natal">Pré Natal</option>
                  <option value="Obstetrícia">Consulta de Obstetrícia</option>
                  <option value="Pós Parto">Pós Parto</option>
                </select>
              </div>
              <div>
                <label for="">Queixa principal</label><br>
                <textarea name="queixaPrincipal" required placeholder="De forma comum descreve oque apaciente sente." class="form-control"></textarea>
              </div>
              <div class="row">

                <div class="col">
                  <div>
                    <label for="">Pressão arterial</label><br>
                    <input type="text" name="pressaoArterial" required class="form-control" placeholder="Ex.: 120/80 mmHg">
                  </div>
                  <div>
                    <label for="">Frequência cardíaca (bpm)</label><br>
                    <input type="number" name="frequenciaCardiaca" placeholder="Infome a frequeência cardíaca" class="form-control" min="0">
                  </div>
                </div>
                <div class="col">
                  <div>
                    <label for="">Frequência respiratória (rpm)</label><br>
                    <input type="number" name="frequenciaRespiratoria"  placeholder="Infome a frequência respiratória" class="form-control" min="0">
                  </div>
                  <div>
                    <label for="">Temperatura (°C)</label><br>
                    <input type="number" name="temperatura" placeholder="Informe a temperaturaem garus" class="form-control" min="0" step="0.1">
                  </div>
                </div>
                <div class="col">
                  <div>
                    <label for="">Saturação de oxigénio (%)</label><br>
                    <input type="number" name="saturacaoOxigenio" value="1" class="form-control" min="0" max="100" step="0.1">
                  </div>
                  <div>
                    <label for="">Peso (kg)</label><br>
                    <input type="number" name="peso" required placeholder="Informe o peso da paciente" class="form-control" min="0" step="0.01">
                  </div>

                  <div>
                    <label for="">Classificação de risco</label><br>
                    <input type="text" name="classificacaoRisco" placeholder="Informe a classificação de risco" class="form-control">
                  </div>
                </div>

                <div class="col">
                  <div>
                    <label for="">Altura (m)</label><br>
                    <input type="number" name="altura" value="1,70'" class="form-control" min="0" step="0.01">
                  </div>
                  <div>
                    <label for="">Idade gestacional (semanas)</label><br>
                    <input type="number"  name="idadeGestacionalSemanas" class="form-control" min="0" max="45">
                  </div>
                  <div>
                    <label for="">Batimentos fetais (bpm)</label><br>
                    <input type="number"  name="batimentosFetais" class="form-control" min="0">
                  </div>
                </div>

              </div>

              <div>
                <label for="">Observações da triagem</label><br>
                <textarea name="observacoesTriagem" required placeholder="De forma técnica descreve a tragem médica" class="form-control"></textarea>
              </div>

              <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Guardar dados</button></div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Fim Modal -->


    <!-- Modal registar parto -->
    <div class="modal fade" id="parto" tabindex="-1" aria-labelledby="patient-create-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-end">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <h1> <span class="modal-kicker">Novo parto da paciente {{$paciente->nome}}</span></h1>
              <h2 id="patient-create-title">Registar parto</h2>
              <p>Preencha os dados e clicar em salvar.</p>
            </div><button class="modal-close" type="button" data-bs-dismiss="modal" aria-label="Fechar"><i class="bx bx-x" aria-hidden="true"></i></button>
          </div>

          <form action="{{route('parto.store',$paciente->id)}}" method="POST" class="form-control" style="overflow: auto;">
            @csrf

            <div class="group-input">

              <div class="row">
                <div class="col">
                  <div>
                    <label for="">Estado clinico</label><br>
                    <input type="text" name="estado" id="" class="form-control" required placeholder="Informe o quadro clinico da paciente">
                  </div>
                  <div>
                    <label for="">Tipo</label><br>
                    <select name="tipo" id="" class="form-control">
                      <option value="">--Selecionar--</option>
                      <option value="Normal">Parto Normal</option>
                      <option value="Natural">Parto Natural</option>
                      <option value="Cesariana">Parto Cesariana</option>
                      <option value="Humanizado">Parto Humanizado</option>
                    </select>
                  </div>
                  <div>
                    <label for="">OBS</label><br>
                    <textarea name="obs" id="" placeholder="Escreve de forma breve como o parto ocorreu." cols="30" rows="5" class="form-control"></textarea>
                  </div>


                </div>



              </div>

            </div>

            <div class="modal-footer">
              <div class="modal-footer"><button class="button button-secondary" type="button" data-bs-dismiss="modal">Cancelar</button><button class="button button-primary" type="submit">Salvar</button></div>
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




</x-app-layout>