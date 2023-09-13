@extends('template.main')



@section('content')


<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-3">
       
        @include('instructor.info')
       
    </div>
    <div class="col-12 col-md-12 col-lg-9 d-flex">
        <form action="{{ route('instructor.modality.store', $instructor) }}" method="post">
            @csrf
            <x-card title="Modalidades Disponíveis">

                <div class="row">

                    <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

                    <div class="col-12 form-group">
                        <label>Modalidade</label>
                        <x-form.select name="modality_id" :options="$modalities" value="{{ old('modality_id') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <label>Tipo de Remuneração</label>
                        <x-form.select name="remuneration_type" :options="['P' => 'Percentual de aula (%) ',  'F' => 'Valor Fixo']" value="{{ old('remuneration_type') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <label>Valor da Remuneração</label>
                        <x-form.input name="remuneration_value" value="{{ old('remuneration_value') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <x-form.switch-button class="mt-4" name="calc_on_absense" value="">Calcular na "Falta sem
                            Justificativa"</x-form.switch-button>
                    </div>

                </div>

                <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.show', $instructor) }}"
                role="button">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Voltar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle    "></i>
                Adicionar
            </button>

            </x-card>
        </form>
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