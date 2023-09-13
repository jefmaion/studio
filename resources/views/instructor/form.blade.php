

<p class="m-0"><strong>Dados Pessoais</strong></p class="m-0">
<hr class="m-0 mb-2">
@include('user.form')

<p class="m-0"><strong>Informações Profissionais</strong></p class="m-0">
<hr class="m-0 mb-2">
<div class="row">

    <div class="col form-group">
        <label>Profissão</label>
        <x-form.input name="profession" value="{{ old('profession', $instructor->profession ?? '') }}" />
    </div>

    <div class="col form-group">
        <label>Doc. Conselho Regional (CREF/CREFITO)</label>
        <x-form.input name="profession_register" value="{{ old('profession_register', $instructor->profession_register ?? '') }}" />
    </div>


    <div class="col-12 form-group">
        <label>Observações</label>
        <x-form.text-area name="comments" value="">{{ old('comments', $instructor->comments ?? '') }}</x-form.text-area>

        <div class="mt-4">
            <x-form.switch-button class="mt-4" name="enabled" value="{{ old('enabled', $instructor->enabled ?? '') }}">Ativo</x-form.switch-button>
        </div>
    </div>
</div>