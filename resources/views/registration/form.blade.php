<div class="row">
    <div class="col-6">

        <div class="row">

            <div class="col-4 form-group">
                <label>Data da Matrícula</label>
                <x-form.input type="date" name="start"
                    value="{{ old('start', $registration->start->format('Y-m-d')) }}" />
            </div>
        
            <div class="col-8 form-group">
                <label>Modalidade</label>
                <x-form.select name="modality_id" :options="$modalities"
                    value="{{ old('modality_id', $registration->modality_id) }}" />
            </div>
        
            <div class="col-6 form-group">
                <label>Plano</label>
                <x-form.select name="duration" :options="[[1, 'Mensal'], [3, 'Trimestral']]"
                    value="{{ old('duration',  $registration->duration) }}" />
            </div>
        
            <div class="col-3 form-group">
                <label>Aula p/semana</label>
                <x-form.input name="class_per_week"
                    value="{{ old('class_per_week',  $registration->class_per_week) }}" />
            </div>

            <div class="col-3 form-group">
                <label>Vencimento</label>
                <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day) }}" />
            </div>



            <div class="col-4 form-group">
                <label>Valor</label>
                <x-form.input name="value" class="money"
                    value="{{ old('value', $registration->value) }}" />
            </div>

            <div class="col-4 form-group">
                <label>Primeiro Pagamento</label>
                <x-form.select name="first_payment_method_id" :options="$payments"
                    value="{{ old('first_payment_method_id', $registration->first_payment_method_id) }}" />
            </div>

            <div class="col-4 form-group">
                <label>Demais Pagamentos</label>
                <x-form.select name="other_payment_method_id" :options="$payments" value="{{ old('other_payment_method_id', $registration->other_payment_method_id) }}" />
            </div>

            <div class="col-12 form-group">
                <label>Observações</label>
                <x-form.text-area name="comments" rows="5">{{ old('comments', $registration->comments) }}
                </x-form.text-area>
            </div>

        
        
        </div>


    </div>

    <div class="col form-group">
        <label>Aulas</label>
        <table class="table table-striped table-bordersed">
            <thead class="thead-inverse">
                <tr>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Professor</th>
                </tr>
            </thead>
            <tbody>
                @foreach(classWeek() as $i => $w)
                <tr>
                    <th>{{ $w }}</th>
                    
                    <td>
                        <input type="hidden" name="class[{{ $i }}][weekday]" value="{{ $i }}">
                        <x-form.select name="class[{{ $i }}][time]" :options="classTime()"
                            value="{{ old('class.'.$i.'.time', $weekclass['time'][$i] ??  (isset($registration->weekclasses[$i])) ? $registration->weekclasses[$i]->time : '' ) }}" />
                    </td>
                    <td>
                        <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors"
                            value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? (isset($registration->weekclasses[$i]->instructor_id)) ? $registration->weekclasses[$i]->instructor_id : '') }}" />
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <a name="" id="" class="btn btn-light text-dark"
            href="{{ route('student.show', $student) }}" role="button">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            Voltar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check-circle    "></i>
            Salvar
        </button>
    </div>
</div>

{{-- <div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-3 form-group">
                <label>Dia Vencimento</label>
                <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day) }}" />
            </div>



            <div class="col-3 form-group">
                <label>Valor</label>
                <x-form.input name="value" class="money"
                    value="{{ old('value', $registration->value) }}" />
            </div>

            <div class="col-3 form-group">
                <label>Pagto. 1º Mens.</label>
                <x-form.select name="first_payment_method_id" :options="$payments"
                    value="{{ old('first_payment_method_id', $registration->first_payment_method_id) }}" />
            </div>

            <div class="col-3 form-group">
                <label>Demais Mens.</label>
                <x-form.select name="other_payment_method_id" :options="$payments"
                    value="{{ old('other_payment_method_id', $registration->other_payment_method_id) }}" />
            </div>
        </div>

    </div>

    <div class="col form-group">
        <label>Observações</label>
        <x-form.text-area name="comments" rows="2">{{ old('comments', $registration->comments) }}
        </x-form.text-area>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-stripesd table-bordersed">
            <thead class="thead-inverse">
                <tr>
                    <th></th>
                    @foreach(classWeek() as $k => $w)
                    <th class="text-center">{{ $w }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Horário</th>
                    @foreach(classWeek() as $i => $w)
                    <td>
                        <input type="hidden" name="class[{{ $i }}][weekday]" value="{{ $i }}">
                        <x-form.select name="class[{{ $i }}][time]" :options="classTime()"
                            value="{{ old('class.'.$i.'.time', $weekclass['time'][$i] ??  (isset($registration->weekclasses[$i])) ? $registration->weekclasses[$i]->time : '' ) }}" />
                    </td>
                    @endforeach
                </tr>
                <tr>
                    <th>Professor</th>
                    @foreach(classWeek() as $i => $w)
                    <td>
                        <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors"
                            value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? (isset($registration->weekclasses[$i]->instructor_id)) ? $registration->weekclasses[$i]->instructor_id : '') }}" />
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <a name="" id="" class="btn btn-light text-dark"
            href="{{ route('student.show', $student) }}" role="button">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            Voltar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check-circle    "></i>
            Salvar
        </button>
    </div>
</div> --}}

@section('scripts')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
@stop