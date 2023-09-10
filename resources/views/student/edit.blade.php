@extends('template.main')



@section('content')
<form action="{{ route('student.update', $student) }}" method="post">
    <x-card style="primary" title="Editar Aluno">
        @csrf
        @method('PUT')
        @include('student.form', ['user' => $student->user])
        <x-slot name="footer">
            <a name="" id="" class="btn btn-light text-dark" href="{{ route('student.index') }}" role="button">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Voltar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle    "></i>
                Salvar
            </button>
        </x-slot>
    </x-card>
</form>
@endsection