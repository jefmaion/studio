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
                    <i class="fas fa-info-circle  drag-area  "></i>
                    Aula em {{ $class->date->format('d/m/Y') }} às {{ date('H\hi', strtotime($class->time)) }} - {{
                    $class->situation }}
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

                            @if(count($class->pendencies()) > 0)
                            <li class="nav-item ">
                                <a class="nav-link active" id="home-tab-{{ $class->id }}" data-toggle="tab" href="#home-{{ $class->id }}" role="tab" aria-controls="home" aria-selected="true">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Pendências
                                </a>
                            </li>
                            @endif

                            @if($class->student->evolutions->count())
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-{{ $class->id }}" data-toggle="tab" href="#contact-{{ $class->id }}" role="tab" aria-controls="contact" aria-selected="false">
                                    <i class="fas fa-chart-line    "></i> Evoluçoes
                                </a>
                            </li>
                            @endif

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @if(count($class->pendencies()) > 0)
                            <div class="tab-pane fade active show nicescroll" id="home-{{ $class->id }}" role="tabpanel" aria-labelledby="home-tab-{{ $class->id }}">
                                {{-- Pendecias --}}
                                
                                    @foreach( $class->pendencies() as $pendecy)
                                        <span class="badge badge-pill badge-primary">{{ $pendecy }}</span> 
                                    @endforeach
                                
                            </div>
                            @endif
                            
                            @if($class->student->evolutions->count() > 0)
                            <div class="tab-pane fade" id="contact-{{ $class->id }}" role="tabpanel"
                                aria-labelledby="contact-tab-{{ $class->id }}">
                                <div class="scroll">
                                    @include('calendar.parts.evolution', ['evolutions' => $class->student->evolutions])
                                </div>
                            </div>
                            @endif
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