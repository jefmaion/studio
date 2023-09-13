<div class="modal fade" id="modal-absense-{{ $class->id }}" role="dialog" data-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header p-3">
            <h5 class="modal-title">
                Cancelar Aula
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

                    <div class="col">
                        <div class="row">

                            <input type="hidden" name="status" value="{{ $data['status'] }}">
                            <input type="hidden" name="finished" value="1">

                            <div class="col-12 form-group">
                                <label>Comentários</label>
                                <x-form.text-area name="absense_comments" rows="4">
                                </x-form.text-area>
                            </div>
                        </div>


                    </div>
                </div>


            </div>




            <div class="modal-footer bg-whitesmoke br">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar
                </button>

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Registrar Falta
                </button>

            </div>


    </div>
</div>
</form>

<script>
    $('#form-absense').submit(function (e) { 
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $('#modal-absense-{{ $class->id }}').modal('hide')
                // $('#myEvent').fullCalendar( 'refetchEvents' )
                refreshCalendar();
            },
            error: function(response) {
                $('.is-invalid').removeClass('is-invalid')
                $.each(response.responseJSON.errors, function (name, message) { 
                    $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
                });
            
            }
        });
        
    });

    $('[name="has_replacement"]').change(function (e) { 
        e.preventDefault();
        $('.replacement').attr('disabled', !$(this).prop('checked'))
    });
</script>

</div>