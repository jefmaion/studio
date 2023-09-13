@extends('template.main')



@section('content')
<div class="row">
    <div class="col-6">

        <x-card style="primary" title="Contas a Receber - Detalhes">

            <form action="{{ route('receivable.update', $account) }}" method="post">
                @csrf
                @method('PUT')

                <input type="hidden" name="type" value="R">
                @include('transaction.form')




            <div class="footer bg-whitesmoke">

                <a name="" id="" class="btn btn-light" href="{{ route('receivable.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-money-check    "></i>
                    Salvar
                </button>


                
    
                
            </div>

            </form>

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