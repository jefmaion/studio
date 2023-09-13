<div class="row">


    

    <div class="col-3 form-group">
        <label>Data de Vencimento</label>
        <x-form.input type="date" name="date" value="{{ old('date', (!empty($account->date) ? $account->date->format('Y-m-d') :  date('Y-m-d'))) }}" />
    </div>
{{-- 
    <div class="col-4 form-group">
        <label>Data de Pagamento</label>
        <x-form.input type="date" name="pay_date" value="{{ old('pay_date', $account->pay_date) }}" />
    </div> --}}

   

    {{-- <div class="col-4 form-group">
        <label>Tipo</label>
        <x-form.select name="type" :options="[['R', 'Receitas'], ['D', 'Despesas']]"
            value="{{ old('type',  $account->type) }}" />
    </div> --}}

    

    <div class="col-3 form-group">
        <label>Valor</label>
        <x-form.input name="value" class="money"
            value="{{ old('value', currency($account->value)) }}" />
    </div>

    <div class="col-3 form-group">
        <label>Pagamento</label>
        <x-form.select name="payment_method_id" :options="$payments"
            value="{{ old('payment_method_id', $account->payment_method_id) }}" />
    </div>

    <div class="col-3 form-group">
        <label>Tipo</label>
        <x-form.select name="status" :options="[[0, 'Aberto'], [1, 'Pago']]"
            value="{{ old('status',  $account->status) }}" />
    </div>

    <div class="col-12 form-group">
        <label>Descrição</label>
        <x-form.input name="description" value="{{ old('description',  $account->description) }}" />
    </div>

    

    <div class="col-12 form-group">
        <label>Observações</label>
        <x-form.text-area name="comments" rows="5">{{ old('comments', $account->comments) }}
        </x-form.text-area>
    </div>



</div>

@section('scripts')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
@stop