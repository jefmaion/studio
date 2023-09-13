<div class="modal fade" id="modal-remark" role="dialog" data-backdrop="static" aria-hidden="true">
    <style>

.select2-container {
    width: 100% !important;
    padding: 0;
}

.is-invalid-select2 {
        border-color: rgb(185, 74, 72) !important;
    }

    </style>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">

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

                <input type="hidden" name="date" value="{{ $data[0] }}" />
                <input type="hidden" name="time" value="{{ $data[1] }}" />

                <div class="modal-body">

                    <h3 class="mb-3">{{ dateExt($data[0]) }} às {{ $data[1] }}</h3>
                    <div class="row">

                        <div class="col-12 form-group">
                            <label>Aula a ser reposta</label>

                            <x-form.select class="select2" name="class_id" :options="$classes" />
                        </div>

                       
                        <div class="col-12 form-group">
                            <label>Professor</label>

                            <x-form.select class="select2" name="instructor_id" :options="$instructors" />
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
                        Agendar Reposição
                    </button>

                </div>


            </form>


        </div>
    </div>


    <script>
        $(".select2").select2({
            dropdownParent: $("#modal-remark")
        });

    //     $(".select2").select2();
    // $('.select2').addClass('w-100');
    // $('.select2.is-invalid, .select2-image.is-invalid').addClass('is-invalid-select2').next().find('.select2-selection').addClass('is-invalid-select2')
    
    // $(".select2 + span").addClass("is-invalid");


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

                    if($('[name="'+name+'"]').hasClass('select2')) {
                        $('[name="'+name+'"]').addClass('is-invalid').next().find('.select2-selection').addClass('is-invalid-select2')
                        $('[name="'+name+'"]').next().next().html(message[0])
                    } else {
                        $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
                    }
                });
            
            }
        });
        
    });
    
    
        
    </script>
</div>


@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection