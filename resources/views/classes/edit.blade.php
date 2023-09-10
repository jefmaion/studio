@extends('template.main')

@section('content')


<form action="{{ route('class.update', $class) }}" method="post">
    @method('put')
    @csrf
<div class="row">
    <div class="col-12">

        <x-card style="primary" title="Editar Aula">

            <div class="row">
                <div class="col form-group">
                    <label>Data</label>
                    <x-form.input type="date" name="date" value="{{ $class->date->format('Y-m-d') }}" />
                </div>
        
                <div class="col form-group">
                    <label>Horario</label>
        
                    <x-form.select name="time" value="{{ $class->time }}" :options="classTime()" />
                </div>
        
                <div class="col form-group">
                    <label>Modalidade</label>
        
                    <x-form.select class="select2" name="modality_id" value="{{ $class->modality_id }}" :options="$modalities" />
                </div>

                <div class="col form-group">
                    <label>Tipo</label>
                    <x-form.select class="select2" name="type" value="{{ $class->type }}" :options="classTypes()" />

                </div>

                <div class="col form-group">
                    <label>Status</label>
                    <x-form.select class="select2" name="status" value="{{ $class->status }}" :options="classStatus()" />
                </div>
            </div>


            <div class="row">
        
                
        
                <div class="col-6 form-group">
                    <label>Professor</label>
                    <x-form.select class="select2" name="instructor_id" value="{{ $class->instructor_id }}" :options="$instructors" />
                </div>
        
                <div class="col-6 form-group">
                    <label>Aluno</label>
                    <x-form.select class="select2" name="student_id" value="{{ $class->student_id }}" :options="$students" />
                </div>
        
                
        
                <div class="col-12 form-group">
                    <label>Evolução da Aula</label>
                    <x-form.textarea name="evolution" rows="5">{{ $class->evolution }}</x-form.textarea>
                </div>

                <div class="col-12 form-group">
                    <label>Comentários da Falta</label>
                    <x-form.textarea name="absense_comments" rows="5">{{ $class->absense_comments }}</x-form.textarea>
                </div>
        
                <div class="col-12 form-group">
                    
                    <div class="mt-4">
                        <x-form.switch-button class="" name="finished" value="{{ $class->finished }}">Aula Finalizada</x-form.switch-button>
                    </div>
                </div>
            
            </div>


            <x-slot name="footer">
                <a name="" id="" class="btn btn-light text-dark" href="{{ route('class.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle    "></i>
                    Salvar
                </button>
            </x-slot>

        </x-card>

    </div>
</div>

</form>

@endsection

