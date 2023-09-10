<div class="modal fade" id="modal-remark" role="dialog" data-backdrop="static" aria-hidden="true">
    <style>

.select2-container {
    width: 100% !important;
    padding: 0;
}

    </style>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header p-3">
                <h5 class="modal-title">
                    <i class="fas fa-user-check"></i> Reagendar Aula
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>



            <form id="form-remark" action="{{ route('class.remark') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">


                        <div class="col-6 form-group">
                            <label>Data</label>
                            <x-form.input type="date" name="date" value="{{ $data[0] }}" />
                        </div>

                        <div class="col-6 form-group">
                            <label>Horario</label>

                            <x-form.select name="time" value="{{ $data[1] }}" :options="classTime()" />
                        </div>

                        <div class="col-12 form-group">
                            <label>Professor</label>

                            <x-form.select class="select2" name="instructor_id" :options="$instructors" />
                        </div>

                        <div class="col-12 form-group">
                            <label>Aula a ser reposta</label>

                            <x-form.select class="select2" name="class_id" :options="$classes" />
                        </div>

                        
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
        $(".select2").select2({
            dropdownParent: $("#modal-remark")
        });


    
    
    $('#form-remark').submit(function (e) { 
        e.preventDefault();
    
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $('#modal-remark').modal('hide')
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