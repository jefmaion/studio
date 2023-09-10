@extends('template.main')

@section('content')


<x-card style="primary" id="card-main" class="">

    <x-slot name="title">Calendário</x-slot>


    <button type="button" class="btn btn-lg bg-orange remark-alert d-none mb-3" onclick="setRemark(false)">
        <h5 class="m-0">Cancelar Reagendamento</h5>
    </button>
    {{-- <div class="row">
        <div class="col form-group">
            <label>Instrutor</label>
            <x-form.select class="item-calendar select2" name="_instructor_id" :options="$instructors" value="" />
        </div>
        <div class="col form-group">
            <label>Aluno</label>
            <x-form.select class="item-calendar select2" name="_student_id" :options="$students" />
        </div>
        <div class="col form-group">
            <label>Modalidade</label>
            <x-form.select class="item-calendar select2" name="_modality_id" :options="$modalities" />
        </div>
        <div class="col form-group">
            <label>Tipo de Aula</label>
            <x-form.select class="item-calendar select2" name="_type"
                :options="['AN' => 'Aula Normal', 'RP' => 'Reposição', 'AE' => 'Aula Experimental']" />
        </div>
        <div class="col form-group">
            <label>Status Aula</label>
            <x-form.select class="item-calendar select2" name="_status"
                :options="[0 => 'Agendada', 1 => 'Realizada', 2 => 'Falta Com Aviso', 3 => 'Falta']" />
        </div>
    </div> --}}
    <div id="calendar-class"></div>
</x-card>
<div id="modals">

</div>
@endsection

@section('body')


@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/bundles/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale/pt-br.js"></script>
<script src="{{ asset('template/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/assets/bundles/summernote/summernote-bs4.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script>
    var calendar = null
        var remark = false
        var remarkUrl = null

        $(document).ready(function () {

            calendar = $('#calendar-class').fullCalendar({...config.fullcalendar,...{
                    events: {
                        url: 'calendar/',
                        data: function() {
                            obj = {}
                            $('.item-calendar').each(function (index, element) {
                                name = $(this).attr('name');
                                obj[name] = $('[name="'+name+'"]').val()
                            });
                            return obj
                        }
                    },

                    eventDrop: function(info,  delta, revertFunc) {

                       
        
                        start = moment(new Date(info.raw.start)).format('YYYY-MM-DD')

                        if(info.raw.type != 'AE') {
                            if(start !== info.start.format('YYYY-MM-DD')) {
                            return    revertFunc();
                        }
                        }
                        




                        $.ajax({
                            type: "post",
                            url: 'class/'+info.id,
                            data: {
                                _method: 'put',
                                _token: '{{ csrf_token() }}',
                                date: info.start.format('YYYY-MM-DD'),
                                time: info.start.format('HH:mm:ss')   
                            },
                            success: function (response) {
                                refreshCalendar();
                            }
                        });

                    },

                    eventRender: function(event, element) {
                        element.find(".fc-title").html(event.title);
                    },
                    eventClick:  function(event, jsEvent, view) {
                        $('#context').remove()
                        if(!remark) {
                            showClass(event.id)
                        }
                    },
                    dayClick: function(date, jsEvent, view) {
                        $.ajax({
                            url: 'calendar/context/' + date.format(),
                            success: function(doc) {



                                $('#context').remove()

                                $('body').append(doc);


                                $('#context .dismiss').click(function (e) { 
                                    $('#context').remove()
                                });
     

                                $('#context').css('top',  (jsEvent.clientY) +  'px');
                                $('#context').css('left',  (jsEvent.clientX) +  'px');

                                
                            }
                        });
                    },
                    
                }
            });

            $('.item-calendar').change(function (e) { 
                refreshCalendar();
            });
                    
        });
            
        function refreshCalendar() {
            calendar.fullCalendar('refetchEvents');
        }
            
        function showClass(id) {
            $.ajax({
                type: "get",
                url: "calendar/" + id,
                success: function (response) {
                    showModal(response)
                }
            });
        }

        function showModal(content) {

            $('#modals .modal').modal('hide')

           id = $(content).attr('id');

           $('#modals').append(content);

            $('#' + id).modal('show')

            $('#' + id).on('hidden.bs.modal', function () {
                $(this).remove();
            });

        }

       

        function setRemark(status, url) {
            remark    = status
            remarkUrl = url
            classes   = 'border border-warning fc-border-yellow'

            $('#card-main').removeClass(classes);
            $('.remark-alert').addClass('d-none')

            if(status) {
                $('#card-main').addClass(classes);
                $('.remark-alert').removeClass('d-none')
            }
        }
</script>
@endsection