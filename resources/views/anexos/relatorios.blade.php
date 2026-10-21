<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICMC-Relatório de actividade</title>

    <link rel="stylesheet" href="{{asset('/assetes/relatorio.css')}}">
    <link rel="stylesheet" href="{{asset('/assetes/bootstrap/css/bootstrap.css')}}">
</head>
<body>
        <div class="conteiner">
              <div class="rotulo">
                        <img src="{{asset('/assetes/ango.png')}}" onclick="print()">
                        <p>REPÚBLICA DE ANGOLA <br> Ministério da Saúde-Centro Materno da Cambanda</p>
                        <hr>
              </div>
            <h5>Relatório de actividade</h5>
            <div class="relatorio">
                <div class="dados">
                    <h6>Dados relatório</h6>
                     <div class="row">
                          <div class="col">
                               Data: []-[] <br>
                               Tipo: {{$tipor}}<br>
                               Data de Emissão: {{$dataactual}} 

                          </div>
                          <div class="col">
                            Funcionario: {{Auth::user()->name}}<br>
                            Email: {{Auth::user()->email}}<br>
                            Função: @if(Auth::user()->isAdmin)
                            Administrador
                            @elseif(Auth::user()->isResponsavel)
                            Responsavel de sala
                            @elseif(Auth::user()->isSecretaria)
                            Secretario/a
                            @elseif(Auth::user()->isEstatistico)
                            Estatistico
                            @else
                            Indefinido
                            @endif

                          </div>
                          <div class="col">
                            Centro Materno da Cambanda <br>
                            Nif:  <br>
                            Contacto:
                          </div>
                     </div>

                </div>
                <div class="paciente">
                        <h6>Pacientes Registados</h6>
                        <table class="table">
                             <thead>
                                <th>Nome</th><th>Contacto</th><th>Morada</th><th>Idade</th>
                             </thead>
                             <tbody>
                                @php 
                                $contp=0;
                                $contc=0;
                                $contpt=0;
                                @endphp
                                @foreach($pacientes as $listap)
                                   @php 
                                    
                                       $ano1=explode('-',$listap->dataNascimento);
                                       $ano=date('Y');

                                       $idade=$ano-$ano1[0];

                                       $contp+=1;
                                   @endphp
                                <tr>
                                    <td>{{$listap->nome}}</td>
                                    <td>{{$listap->contacto}}</td>
                                    <td>{{$listap->morada}}</td>
                                    <td>{{$idade}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Total=></th>
                                   
                                    <th>{{$contp}}</th>
                            </tr>


                             </tbody>

                        </table>

                </div>
                <div class="consulta">
                    <h6>Consultas</h6>
                    <table class="table">
                             <thead>
                                <th>Paciente</th><th>Contacto</th><th>Data</th><th>Hora</th><th>Médico</th>
                             </thead>
                             <tbody>
                                @foreach($consultas as $lista)
                                   @php 
                                            $contc++;

                                   @endphp
                                <tr>
                                    <td>{{App\Models\pacientes::find($lista->pacienteID)->nome}}</td>
                                    <td>{{App\Models\pacientes::find($lista->pacienteID)->contacto}}</td>
                                    <td>{{$lista->dataConsulta}}</td>
                                    <td>{{$lista->hora}}</td>
                                    <td>{{$lista->doutor}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Total=></th>
                                    <th>{{$contc}}</th>
                                </tr>
                             </tbody>

                        </table>


                </div>
                <div class="parto">
                    <h6>Partos</h6>
                    <table class="table">
                             <thead>
                                <th>Paciente</th><th>Ocorreu</th><th>Tipo</th>
                             </thead>
                             <tbody>
                                @foreach($partos as $listapt)
                                   @php 
                                     $contpt++;

                                   @endphp
                                <tr>
                                    <td>{{App\Models\pacientes::find($listapt->pacienteID)->nome}}</td>
                                    <td>{{$listapt->created_at}}</td>
                                    <td>{{$listapt->tipo}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Total=></th>
                                    <th>{{$contpt}}</th>
                                </tr>
                             </tbody>

                        </table>


                </div>
                <div class="crianca">
                    <h6>Crianças nascidas por genéro</h6>
                    <table class="table">
                          <tr><th>Marculino:</th><td>{{$masculino}}</td></tr>
                          <tr><th>Femenino:</th><td>{{$femenino}}</td></tr>
                    </table>

                </div>
            </div>
        </div>
    

<script src="{{asset('/assetes/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>