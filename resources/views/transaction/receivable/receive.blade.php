@extends('template.main')



@section('content')
<div class="row">
    <div class="col-6">

        <x-card style="primary" title="Contas a Receber - Detalhes">


            <h4>{{ $account->description }} </h4>

            <div>
                <span class="badge badge-secondary"> R$ {{ currency($account->value) }}</span> 
                <span class="badge badge-{{ $account->colorTransaction }}">{{ $account->typeTransaction }}</span> 
                <span class="badge badge-{{ $account->bgColor }}">{{ $account->situation }}</span> 
            </div>

            <hr>

            <form action="{{ route('receivable.update', $account) }}" method="post" id="form-receive">
                @csrf
                @method('put')
                <input type="hidden" name="date" value="{{ $account->date->format('Y-m-d') }}">
                <input type="hidden" name="status" value="1">

                <div class="row">
                    <div class="col-3 form-group">
                        <label>Data de Pagamento</label>
                        <x-form.input type="date" name="pay_date" value="{{ date('Y-m-d') }}" />
                    </div>
    
                    <div class="col-3 form-group">
                        <label>Valor devido</label>
                        <x-form.input name="value" class="money"
                            value="{{ old('value', currency($account->value)) }}" />
                    </div>
    
                    <div class="col-2 form-group">
                        <label>Juros</label>
                        <x-form.input name="fees" class="money"
                            value="{{ old('fees', currency($account->fees)) }}" />
                    </div>
    
                    <div class="col-3 form-group">
                        <label>Valor a Pagar</label>
                        <x-form.input name="amount" class="money"
                            value="{{ old('amount', currency($account->amount)) }}" />
                    </div>
                
                    <div class="col-3 form-group">
                        <label>Pagamento</label>
                        <x-form.select name="payment_method_id" :options="$payments"
                            value="{{ old('payment_method_id', $account->payment_method_id) }}" />
                    </div>
                </div>

            

            <div class="footer bg-whitesmoke">

                <a name="" id="" class="btn btn-light" href="{{ route('receivable.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-money-check    "></i>
                    Receber
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
<script>

    $('[name="pay_date"]').change(function (e) { 
        e.preventDefault();

        date = $(this).val()
        form = $('#form-receive')

        $.ajax({
            type: $(form).attr('method'),
            url: '/account/receivable/fees',
            data: $(form).serialize(),
            dataType: "json",
            success: function (response) {
                $('[name="amount"]').val(response.amount)
                $('[name="fees"]').val(response.fees)
            }
        });
        
    });
</script>
@endsection