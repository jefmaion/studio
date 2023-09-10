@extends('template.main')

@section('content')



<x-card style="primary" title="Aulas Cadastradas">



    <div class="row align-items-center">
        <div class="col">
            <a class="btn btn-success " href="{{ route('class.create') }}" role="button">
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
        <x-table id="table-class" style="width:100%">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Modalidade</th>
                    <th>Tipo</th>
                    <th>Aluno</th>
                    <th>Professor</th>
                    <th>Professor</th>
                </tr>
            </thead>
        </x-table>
    </div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/class.js') }}"></script>
@endsection

