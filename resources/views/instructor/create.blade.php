@extends('template.main')

@section('content')
<form action="{{ route('instructor.store') }}" method="post" >
    <x-card style="primary" title="Novo Professor">
        @csrf
        @include('instructor.form')
        <x-slot name="footer">
            <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.index') }}" role="button">
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