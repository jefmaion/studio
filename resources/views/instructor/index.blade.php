@extends('template.main')

@section('content')



<x-card style="primary" title="Cadastro de Professores">



    <div class="row align-items-center">
        <div class="col">
            <a class="btn btn-success " href="{{ route('instructor.create') }}" role="button">
                <i class="fas fa-plus-circle    "></i>
                Novo Professor
            </a>
        </div>
        <div class="col">
            <h5 class="text-right text-muted font-weight-light my-auto">Aluno(s) Cadastrado(s)</h5>
        </div>
    </div>

    <hr>

    <div class="table-responsive">
        <x-table id="table-instructor" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Profissão</th>
                    <th>Telefone</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
        </x-table>
    </div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/instructor.js') }}"></script>
@endsection

