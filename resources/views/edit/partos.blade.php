<x-app-layout>


    @section('corpo')

    <div class="corpo">
        <div class="search">

            <H3>Gerir parto</H3>

            <div class="form">


                <form action="" method="get" class="formSearch">
                    <div>
                        <a href="{{route('parto.index')}}">Listar</a>
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
                <form action="{{route('parto.update',$parto->id)}}" method="post">
                    @csrf
                    @method('put')

                    <div class="group-input">


                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="">Estado</label><br>
                                    <input type="text" name="estado" id="" class="formc" value="{{$parto->estado}}" required placeholder="Informe o estado da paciente">
                                </div>
                                <div>
                                    <label for="">Tipo</label><br>
                                    <input type="text" name="tipo" id="" class="formc" value="{{$parto->tipo}}" placeholder="Informe o tipo de parto">
                                </div>
                                <div>
                                    <label for="">Paciente</label><br>
                                    <input type="text" name="pacienteID" id="" class="formc" value="{{App\Models\pacientes::find($parto->pacienteID)->nome}}" required placeholder="9xx xxx xxx">
                                </div>

                            </div>

                            <div class="col">
                               
                               
                                <div>
                                    <label for="">OBS</label><br>
                                    <textarea name="obs" id="" cols="30" rows="10" class="formt">{{$parto->obs}}</textarea>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apagando os dados de parto nº {{$parto->id}}...</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">

                    <form action="{{route('parto.destroy',$parto->id)}}" method="POST" class="form-control">
                        @csrf
                        @method('delete')
                        <p style="font-size: 20pt; text-align: center;">Desejas apagar os dados de parto nº {{$parto->id}} do paciente {{App\Models\pacientes::find($parto->pacienteID)->nome}}?</p>
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

