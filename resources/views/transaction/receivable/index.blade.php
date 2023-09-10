@extends('template.main')

@section('content')

{{-- <x-page-title>
    <x-slot name="title">Cadastro de Alunos </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Alunos</x-breadcrumb-item>
    </x-slot>
</x-page-title> --}}

<x-card style="primary" title="Contas a Receber">



    <div class="row align-items-center">
        <div class="col">
            <a class="btn btn-success " href="{{ route('student.create') }}" role="button">
                <i class="fas fa-plus-circle    "></i>
                Novo Aluno
            </a>
        </div>
    </div>

    <hr>

    
    <div class="table-responsive">
        <x-table class="datatable dtable-sm" style="width:100%">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Descricao</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            
        </x-table>
    </div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/receivable.js') }}"></script>
@endsection

