@extends('template.main')



@section('content')

@include('user.photo', ['user' => $instructor->user])
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-3">
                @include('instructor.info')
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
                                    aria-selected="false">Modalidades</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                    aria-selected="true">Aulas</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="home-tab2">
        
                                <p>
                                    <a name="" id="" class="btn btn-primary" href="{{ route('instructor.modality.index', $instructor) }}" role="button">Gerenciar Modalidades</a>
                                </p>
                                <table class="table table-striped datatable w-100">
                                    <thead>
                                        <tr>
                                            <th>Modalidade</th>
                                            <th>Recebimento</th>
                                            <th>Valor</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instructor->modalities as $modality)
                                        <tr>
                                            <td scope="row">{{ $modality->name }}</td>
                                            <td>{{ $modality->pivot->type }}</td>
                                            <td>{{ $modality->pivot->remuneration_value }} {{ $modality->pivot->valueSuffix }}</td>
                                            
                                        </tr>
                                        @endforeach
                
                                        
                
                                     
                                    </tbody>
                                </table>
                             
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                <table class="table table-striped datatable table-sm w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Dia</th>
                                            <th>Horário</th>
                                            <th>Modalidade</th>
                                            <th>Tipo</th>
                                            <th>Situação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instructor->classes as $class)
                                        <tr>
                                            <td scope="row">{{ $class->date->format('d/m/Y') }} {{ $class->day }}</td>
                                            <td>{{ $class->time }}</td>
                                            <td>{{ $class->modality->name }}</td>
                                            <td>{{ $class->typeText }}</td>
                                            
                                                <td>
                                                    <img alt="image" src="{{ avatar($class->student->user->avatar) }}" class="rounded-circle mr-2" width="35">
                                                    {{ $class->student->user->ShortName }}
                                                </td>
                                           
                                           
                                            <td>
                                                <span class="badge badge-pill badge-{{  $class->bgColor  }}">{{$class->situation }}</span>
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