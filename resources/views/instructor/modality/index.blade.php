@extends('template.main')



@section('content')


<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-3">

        @include('instructor.info')

    </div>
    <div class="col-12 col-md-12 col-lg-9 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4>Modalidades de {{ $instructor->user->name }}</h4>
            </div>

            <div class="card-body">
                
                
                

                <table class="table table-striped datatable w-100">
                    <thead>
                        <tr>
                            <th>Modalidade</th>
                            <th>Recebimento</th>
                            <th>Valor</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instructor->modalities as $modality)
                        <tr>
                            <td scope="row">{{ $modality->name }}</td>
                            <td>{{ $modality->pivot->type }}</td>
                            <td>{{ $modality->pivot->remuneration_value }}</td>
                            <td>

                                <a href="#" data-toggle="modal" data-target="#modal-{{ $modality->pivot->id }}"
                                    role="button">
                                    Excluir
                                </a>


                                <div class="modal fade show" id="modal-{{ $modality->pivot->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            {{-- <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Excluir</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div> --}}
                                            <div class="modal-body text-center p-4 mt-4">

                                                {{-- <i class="fas fa-trash-alt text-danger"
                                                    style="font-size: 4em !important"></i> --}}
                                                <i class="far fa-times-circle  text-danger  "
                                                    style="font-size: 7em !important"></i>

                                                <h3 class="font-weight-light text-danger p-4">Você tem certeza?</h3>

                                                <h5 class="font-weight-light">Deseja realmente excluir esse registro?
                                                </h5>
                                            </div>
                                            <div class="modal-footer text-center bg-whitesmoke br">

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="fas fa-times-circle    "></i>
                                                    Cancelar
                                                </button>

                                                <form
                                                    action="{{ route('instructor.modality.destroy', [$instructor, $modality]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Excluir
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        @endforeach




                    </tbody>
                </table>

                
            </div>

            <div class="card-footer bg-whitesmoke pb-1">
                <form action="{{ route('instructor.modality.store', $instructor) }}" method="post">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

                        <div class="col form-group">
                            <label>Modalidade</label>
                            <x-form.select name="modality_id" :options="$modalities" value="{{ old('modality_id') }}" />
                        </div>

                        <div class="col form-group">
                            <label>Tipo de Remuneração</label>
                            <x-form.select name="remuneration_type"
                                :options="['P' => 'Percentual de aula (%) ',  'F' => 'Valor Fixo']"
                                value="{{ old('remuneration_type') }}" />
                        </div>

                        <div class="col form-group">
                            <label>Valor da Remuneração</label>
                            <x-form.input name="remuneration_value" value="{{ old('remuneration_value') }}" />
                        </div>

                  

                        <div class="col form-group">
                            <label>Calcular na falta?</label>
                            <x-form.select name="calc_on_absense" :options="[1 => 'Sim',0 => 'Não']"  />
                        </div>

                        <div class="col form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-check-circle    "></i>
                                Adicionar
                            </button>
                        </div>

                    </div>

                    </a>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script>
    dataTable('.datatable')
</script>
@endsection