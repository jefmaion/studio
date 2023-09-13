<div class="modal fade " id="modal-class-{{ $class->id }}" role="dialog" data-backdrop="static" aria-hidden="true">

    <style>
        .tab-pane {
            height: 200px;
            overflow: auto
        }
    </style>

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-whitesmoke  p-3 modal-class-{{ $class->id }}">
                <h5 class="modal-title">
                    
                    {{ $class->situation }} - {{ dateExt($class->date) }} às {{ $class->time }}  
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-12 mb-1">
                        @include('calendar.header')
                        
                    </div>

                    <div class="col-12">


                        <ul class="nav nav-tabs nasv-fill" id="myTab" role="tablist">

   
                            <li class="nav-item ">
                                <a class="nav-link active" id="home-tab-{{ $class->id }}" data-toggle="tab" href="#home-{{ $class->id }}" role="tab" aria-controls="home" aria-selected="true">
                                    <i class="fas fa-chart-line    "></i> Evoluções
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" id="info-tab-{{ $class->id }}" data-toggle="tab" href="#info-{{ $class->id }}" role="tab" aria-controls="info" aria-selected="true">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações da Aula
                                </a>
                            </li>
                    

     
                        </ul>
                        <div class="tab-content" id="myTabContent">
           
                            <div class="tab-pane fade active show nicescroll" id="home-{{ $class->id }}" role="tabpanel" aria-labelledby="home-tab-{{ $class->id }}">
                                @if($class->student->evolutions->count())
                                <div class="scroll">
                                    @include('calendar.parts.evolution', ['evolutions' => $class->student->evolutions])
                                </div>
                                @else
                                    <p>{{ $class->student->user->nickname }} não possui nenhuma evolução cadastrada. </p>
                                @endif
                               
                            </div>

                            <div class="tab-pane fadenicescroll" id="info-{{ $class->id }}" role="tabpanel" aria-labelledby="info-tab-{{ $class->id }}">
                                <p></p>
                                <p></p>

                                <ul class="list-unstyled">
                                    <li><strong>Status da aula: </strong><span class="badge badge-pill badge-{{ $class->bgColor }} bg-{{ $class->bgColor }}">{{ $class->situation }}</span></li>
                                    @if(!empty($class->absense_comments))
                                    <li><strong>Motivo: </strong>{{ $class->absense_comments }}</li>
                                    @endif
                                  </ul>
                               
                            </div>
           
                            
             
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer br">
                <hr>

                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar
                </button>

                @if(!$class->finished)

                <a class="btn btn-light tesxt-white open-view"
                    href="{{ route('calendar.edit', [$class, 'action=cancel']) }}">
                    <i class="fas fa-user-times"></i>
                    Cancelar Aula
                </a>

                <a class="btn btn-danger text-white open-view"
                    href="{{ route('calendar.edit', [$class, 'action=absense']) }}">
                    <i class="fas fa-user-times"></i>
                    Registrar Falta
                </a>

                <a class="btn  btn-success open-view" href="{{ route('calendar.edit', [$class, 'action=presence']) }}">
                    <i class="fas fa-user-check    "></i>
                    Registrar Presença
                </a>

                @else

                <a class="btn btn-primary text-white"
                    href="{{ route('class.edit', $class) }}">
                    <i class="fas fa-edit    "></i>
                    Editar Aula
                </a>

                @endif

            </div>

        </div>
    </div>



    <script>
        // $('body').getNiceScroll().remove();
        // $(".scroll").niceScroll();
        // $(".scroll").getNiceScroll().resize();
        

        $('.open-view').click(function (e) { 
            e.preventDefault();
            $('#context').remove()
            $.ajax({
                type: "get",
                url: $(this).attr('href'),
                success: function (response) {
                    showModal(response)
                }
            });
        }); 
    
        $('.reset-class').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: "post",
                url: 'class/'+id+'/reset',
                data: {
                    _method: 'put',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#modelId').modal('hide')
                    refreshCalendar();
                }
            });
        });
    
        // $('#btn-remark').click(function (e) { 
        //     // e.preventDefault();
        //     // setRemark(true, $(this).attr('href'))
        //     // $('#modelId').modal('hide')

        //     $.ajax({
        //         url: 'calendar/remark/',
        //         success: function(doc) {


        //             showModal(doc)

            
        //         }
        //     });
        // });
    
    </script>
</div>