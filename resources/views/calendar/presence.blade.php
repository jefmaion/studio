<div class="modal fade" id="modal-presence-{{ $class->id }}" role="dialog" data-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header p-3">
            <h5 class="modal-title">
                <i class="fas fa-user-check"></i> Registrar Presença
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
            </button>
        </div>



        <form id="form-absense" action="{{ route('class.update', $class) }}" method="post">
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @include('calendar.header')
                    </div>

                    <input type="hidden" name="status" value="{{ $data['status'] }}">
                    <input type="hidden" name="finished" value="1">

                    <div class="col-12 form-group">
                        <label>Evolução da Aula</label>
                        <x-form.text-area name="evolution" rows="5">{{ $class->evolution }}</x-form.text-area>
                    </div>

                    @if($class->student->evolutions->count())
                    <div class="col-12 form-group" >
                        <strong>Últimas Evoluções</strong>
                        <hr>
                        <div id="scr" class="nicescroll" style="height:150px;overflow-x:auto">
                            @include('calendar.parts.evolution', ['evolutions' => $class->student->evolutions])
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>

            <div class="modal-footer bg-whitesmoke br">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar
                </button>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle    "></i>
                    Registrar Presença
                </button>

            </div>


        </form>


    </div>
</div>


<script>
    $(".select2").select2();


$('#form-absense').submit(function (e) { 
    e.preventDefault();

    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            $('#modal-presence-{{ $class->id }}').modal('hide')
            refreshCalendar()
        },
        error: function(response) {
            $('.is-invalid').removeClass('is-invalid')
            $.each(response.responseJSON.errors, function (name, message) { 
                $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
            });
        
        }
    });
    
});


    
</script>
</div>


@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection