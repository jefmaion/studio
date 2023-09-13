@include('user.photo', ['user' => $instructor->user])

<div class="card author-box ">
    <div class="card-body">
        <div class="author-box-center">
            <img alt="image" src="{{ avatar($instructor->user->avatar) }}" class="rounded-circle author-box-picture">
            <div class="clearfix"></div>
            <div class="author-box-name">
                <a href="#">{{ $instructor->user->name }}</a>
            </div>
            <div class="author-box-job">
                {{-- Cadastrado em {{ $instructor->created_at->diffForHumans() }} |
                Editado em {{ $instructor->updated_at->diffForHumans() }} --}}
                
                {{ $instructor->profession }}

            </div>
        </div>
        <div class="text-center">
            <div class="author-box-description">


            </div>



            <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.index') }}" role="button">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Voltar
            </a>

            <div class="dropdown d-inline">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs    "></i>
                    Gerenciar
                </button>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <a class="dropdown-item has-icon" href="{{ route('instructor.edit', $instructor) }}"><i
                            class="fas fa-pencil-alt    "></i> Editar</a>

                    <x-delete-button class="dropdown-item has-icon" route="{{ route('instructor.destroy', $instructor) }}"><i
                            class="fas fa-trash-alt"></i>
                        Excluir</x-delete-button>
                    
                        <a class="dropdown-item has-icon pick-photo" href="#" ><i
                            class="fas fa-pencil-alt    "></i> Alterar Foto</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card flex-fill">
    <div class="card-header">
        <h4>Informações</h4>
    </div>
    <div class="card-body">
        <div class="spy-4">


            <p class="m-0">
                <span class="flsoat-left">
                    Endereço
                </span>
            <div class="float-risght text-muted">
                {{ $instructor->user->address }}, {{ $instructor->user->number }} {{ $instructor->user->district }}
            </div>
            </p>

            <p class="m-0">
                <span class="flsoat-left">
                    Telefone
                </span>
            <div class="float-risght text-muted">
                {{ $instructor->user->phone_wpp }} | {{ $instructor->user->phone2 }}
            </div>
            </p>


            @if($instructor->user->email)
            <p class="m-0">
                <span class="flsoat-left">
                    Email
                </span>
            <div class="float-risght text-muted">
                {{ $instructor->user->email }}
            </div>
            </p>
            @endif

            <p class="m-0">
                <span class="flsoat-left">
                    Observações
                </span>
            <div class="float-risght text-muted">
                {{ $instructor->comments }}
            </div>
            </p>

        </div>
    </div>
</div>
