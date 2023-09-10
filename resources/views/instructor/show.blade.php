@extends('template.main')



@section('content')


<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                    <div class="card-body">
                        <div class="author-box-center">
                            <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                            <div class="author-box-name">
                                <a href="#">{{ $instructor->user->name }}</a>
                            </div>
                            <div class="author-box-job">
                                {{-- Cadastrado em {{ $instructor->created_at->diffForHumans() }} |
                                Editado em {{ $instructor->updated_at->diffForHumans() }} --}}
                                <x-badge-status status="{{ $instructor->enabled }}" />
        
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="author-box-description">
                                <p>
        
                                </p>
                                <p>
                                    {{ $instructor->comments }}
                                </p>
                            </div>
        
        
        
                            <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.index') }}"
                                role="button">
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
        
                                    <x-delete-button class="dropdown-item has-icon"
                                        route="{{ route('instructor.destroy', $instructor) }}"><i class="fas fa-trash-alt"></i>
                                        Excluir</x-delete-button>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Dados Pessoais</h4>
                    </div>
                    <div class="card-body">
                        <div class="py-4">
                            <p class="clearfix">
                                <span class="float-left">
                                    Endereço
                                </span>
                                <span class="float-right text-muted">
                                    {{ $instructor->user->address }}, {{ $instructor->user->number }}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Bairro
                                </span>
                                <span class="float-right text-muted">
                                    {{ $instructor->user->district }}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Telefone
                                </span>
                                <span class="float-right text-muted">
                                    {{ $instructor->user->phone_wpp }}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Telefone Recado
                                </span>
                                <span class="float-right text-muted">
                                    {{ $instructor->user->phone2 }}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    E-mail
                                </span>
                                <span class="float-right text-muted">
                                    {{ $instructor->user->email }}
                                </span>
                            </p>
        
                        </div>
                    </div>
                </div>
        
            </div>
            <div class="col-12 col-md-12 col-lg-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4>Ficha do Professor</h4>
                    </div>
                    <div class="padding-20">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                    aria-selected="false">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                    aria-selected="true">Aulas</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="home-tab2">
        
                                <div class="section-title">Modalidades</div>
                                <ul>
                                    @foreach($instructor->modalities as $modality)
                                    <li>{{ $modality->name }}</li>
                                    @endforeach
                                </ul>
                                <p>
                                    <a name="" id="" class="btn btn-light"
                                        href="{{ route('instructor.modality.index', $instructor) }}" role="button">Gerenciar
                                        Modalidades</a>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                <table class="table table-striped datatable table-sm w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Dia</th>
                                            <th>Horário</th>
                                            <th>Modalidade</th>
                                            <th>Tipo</th>
                                            <th>Professor</th>
                                            <th>Situação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instructor->classes as $class)
                                        <tr>
                                            <td scope="row">{{ $class->date }}</td>
                                            <td>{{ $class->time }}</td>
                                            <td>{{ $class->modality->name }}</td>
                                            <td>{{ $class->type }}</td>
                                            <td>
                                                <img alt="image" src="{{ asset('template/assets/img/users/user-3.png') }}" class="rounded-circle mr-2" width="35">
                                                {{ $class->student->user->name }}
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">Agendada</span>
                                            </td>
                                            <td>
                                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script>
    dataTable('.datatable')
</script>
@endsection