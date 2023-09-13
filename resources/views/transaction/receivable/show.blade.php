@extends('template.main')



@section('content')
<div class="row">
    <div class="col-6">

        <x-card style="primary" title="Contas a Receber - Detalhes">


            <h4>{{ $account->description }} </h4>
            <div><p> Cadastrado em {{ $account->created_at->diffForHumans() }}</p></div>

            <div>
                <span class="badge badge-secondary"> R$ {{ currency($account->value) }}</span> 
                <span class="badge badge-{{ $account->colorTransaction }}">{{ $account->typeTransaction }}</span> 
                <span class="badge badge-{{ $account->bgColor }}">{{ $account->situation }}</span> 
            </div>

            


            <x-slot name="footer" class="bg-whitesmoke">

                <a name="" id="" class="btn btn-light" href="{{ route('receivable.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                @if(!$account->status)
                <a name="" id="" class="btn btn-success" href="{{ route('receivable.receive', $account) }}" role="button">
                    <i class="fas fa-money-check    "></i>
                    Receber
                </a>
                @endif


                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs    "></i>
                        Mais
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                        <a class="dropdown-item has-icon" href="{{ route('receivable.edit', $account) }}"><i
                                class="fas fa-pencil-alt    "></i> Editar</a>
    
                        @if($account->registration_id ==null)        
                        <x-delete-button class="dropdown-item has-icon" route="{{ route('receivable.destroy', $account) }}"><i
                                class="fas fa-trash-alt"></i>
                            Excluir</x-delete-button>
                        @endif
                    </div>
                </div>
    
                
            </x-slot>

        </x-card>
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