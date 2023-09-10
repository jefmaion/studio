<div id="context" class="dropdown-menu show">
    <h6 class="dropdown-header">{{ $data->format('d/m/Y \à\s\ H:i') }}</h6>
    <a class="dropdown-item has-icon open-view" href="{{ route('calendar.trial', $data->format('Y-m-d H:i:s')) }}"><i class="fas fa-calendar-plus    "></i> Agendar Aula</a>
    <a class="dropdown-item has-icon open-view" href="{{ route('calendar.remark', $data->format('Y-m-d H:i:s')) }}" id="btn-rsemark"><i class="far fa-file"></i> Agendar Reposição</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item has-icon dismiss" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i> Fechar
        Menu</a>


        <script>
            $('.open-view').click(function (e) { 
                
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: $(this).attr('href'),
                    success: function (response) {
                        showModal(response)
                        $('#context').remove()
                    }
                });
            }); 
        </script>
</div>