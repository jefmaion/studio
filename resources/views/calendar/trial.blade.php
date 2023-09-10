<div class="modal fade" id="modal-remark" role="dialog" data-backdrop="static" aria-hidden="true">
    <style>
        .select2-container {
            width: 100% !important;
            padding: 0;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header p-3">
                <h5 class="modal-title">
                    <i class="fas fa-user-check"></i> Aula Experimental
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>



            <form id="form-remark" action="{{ route('class.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="class[type]" value="AE">
                        <input type="hidden" name="student[student_id]" id="student_id" value="">

                        <div class="col-12">
                            <strong>Dados do Participante</strong>
                            <hr class="mt-1">
                        </div>

                        <div class="col-4 form-group">
                            <label>Telefone (WhatsApp)</label>
                            <x-form.input type="text" id="phone" class="sp_celphones" name="student[phone_wpp]" value="" />
                        </div>

                        

                        <div class="col-4 form-group">
                            <label>Sexo</label>
                            <x-form.select name="student[gender]" :options="['M' => 'Masculino', 'F' => 'Feminino']" id="gender" />
                        </div>

                        <div class="col-4 form-group">
                            <label>Data de Nascimento</label>
                            <x-form.input type="date" name="student[birth_date]" id="birth_date" value="" />
                        </div>

                        <div class="col-12 form-group">
                            <label>Nome do Aluno</label>
                            <x-form.input name="student[name]" id="name" value="" />
                        </div>




                        <div class="col-12">
                            <strong>Informações da Aula</strong>
                            <hr class="mt-1">
                        </div>

                        <div class="col-3 form-group">
                            <label>Data</label>
                            <x-form.input type="date" name="class[date]" value="{{ $data[0] }}" />
                        </div>

                        <div class="col-3 form-group">
                            <label>Horario</label>

                            <x-form.select name="class[time]" value="{{ $data[1] }}" :options="classTime()" />
                        </div>

                        <div class="col-6 form-group">
                            <label>Modalidade</label>

                            <x-form.select class="select2" name="class[modality_id]" :options="$modalities" />
                        </div>

                        <div class="col-6 form-group">
                            <label>Professor</label>

                            <x-form.select class="select2" name="class[instructor_id]" :options="$instructors" />
                        </div>

                        <div class="col-3 form-group">
                            <label>Valor da Aula</label>
                            <x-form.input name="transaction[value]" class="money" value="" />
                        </div>

                        <div class="col-3 form-group">
                            <label>Forma de Pagamento</label>
                            <x-form.select name="transaction[payment_method_id]" :options="$payments" />
                        </div>






                        <div class="col-12 form-group">
                            <label>Observações</label>
                            <x-form.textarea name="class[comments]" rows="3"></x-form.textarea>
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
                        Marcar Aula
                    </button>

                </div>


            </form>


        </div>
    </div>

    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.config.js') }}"></script>

    <script>
        $(".select2").select2({
            dropdownParent: $("#modal-remark")
        });

        
        $('#phone').focusout(function (e) {
            var phone = $(this).val()

            
            // if (zipcode.length < 9) return

            $.ajax({
                type: "get",
                url: "user/find/" + phone,
                dataType: "json",
                beforeSend: function (e) {
                    $('#name').val('')
                    $('#gender').val('')
                    $('#birth_date').val('')
                    $('#student_id').val('')
                },
                success: function (response) {
                    $('#name').val('')

                    if(!response) {
                        return
                    }

                    $('#name').val(response.name)
                    $('#gender').val(response.gender)
                    $('#birth_date').val(response.birth_date)
                    $('#student_id').val(response.student.id)
                }
            });
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