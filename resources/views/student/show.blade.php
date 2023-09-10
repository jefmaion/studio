@extends('template.main')



@section('content')

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-3">
        @include('student.info')
    </div>
    <div class="col-12 col-md-12 col-lg-9 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4>Ficha do Aluno</h4>
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
                    <li class="nav-item">
                        <a class="nav-link" id="installments-tab2" data-toggle="tab" href="#installments" role="tab"
                            aria-selected="true">Mensalidades</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <p>
                            <a name="" id="" class="btn btn-success"
                                href="{{ route('student.registration.create', $student) }}" role="button">Nova
                                Modalidade</a>
                        </p>
                        <hr>
                        @if($student->registrations->count() > 0)
                        <table class="table table-striped datatable table-sm w-100">
                            <thead>
                                <tr>
                                    <th>Mês</th>
                                    <th>Modalidade</th>
                                    <th>Período</th>
                                    <th>Status</th>

                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($student->registrations as $registration)
                                <tr>
                                    <td scope="row">{{ $registration->description }}</td>
                                    <td>{{ $registration->modality->name }}</td>
                                    <td>{{ $registration->start->format('d/m/Y') }} até {{
                                        $registration->end->format('d/m/Y') }}</td>

                                    <td>
                                        <span class="badge badge-pill badge-light">{{ $registration->position }}</span>
                                    </td>
                                    <td>

                                        <div class="dropdown d-inline">
                                            <i class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                            </i>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item has-icon" href="#" data-toggle="modal"
                                                    data-target="#modelId{{ $registration->id }}"><i
                                                        class="far fa-heart"></i> Cancelar Matrícula</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ route('student.registration.edit', [$student, $registration]) }}"><i
                                                        class="far fa-file"></i> Renovar</a>
                                                <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i>
                                                    Something else here</a>
                                            </div>

                                        </div>
                                        <div class="modal fade" id="modelId{{ $registration->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('student.registration.destroy', [$student, $registration]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header bg-whitesmoke  p-3">
                                                            <h5 class="modal-title">
                                                                Cancelar Matrícula
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span>×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Deseja realmente cancelar essa matrícula?</p>

                                                            <x-form.textarea name="comments" rows="5"
                                                                placeholder="Motivo do cancelamento" value="">
                                                            </x-form.textarea>

                                                            <x-form.switch-button class="mt-2" name="remove_class">
                                                                Excluir aulas não realizadas</x-form.switch-button>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"><i
                                                                    class="fa fa-chevron-circle-left"
                                                                    aria-hidden="true"></i> Fechar</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-check-circle    "></i>
                                                                Confirmar Cancelamento
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                        @else
                        <p>O aluno não está matriculado em nenhuma modalidade</p>
                        @endif



                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">

                        @if(!$student->classes->count())
                        <p>Não existe aulas cadastradas para esse aluno.</p>
                        @else

                        <table class="table table-striped datatable table-sm w-100 text-nowrap">
                            <thead>
                                <tr>
                                    <th>Dia</th>
                                    <th>Horário</th>
                                    <th>Modalidade</th>
                                    <th>Tipo</th>
                                    <th>Professor</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->classes as $class)
                                <tr>
                                    <td scope="row">{{ $class->date->format('d/m/Y') }}</td>
                                    <td>{{ $class->time }}</td>
                                    <td>{{ $class->modality->name }}</td>
                                    <td>{{ $class->typeText }}</td>
                                    <td>
                                        <img alt="image" src="{{ asset('template/assets/img/users/user-3.png') }}"
                                            class="rounded-circle mr-2" width="35">
                                        {{ $class->instructor->user->name }}
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-{{  $class->bgColor  }}">{{
                                            $class->situation }}</span>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="installments" role="tabpanel" aria-labelledby="installments-tab2">

                        @if(!$student->installments->count())
                        <p>Não existe aulas cadsastradas para esse aluno.</p>
                        @else

                        <table class="table table-striped datatable table-sm w-100 text-nowrap">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Modalidade</th>
                                    <th>Modalidade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->installments as $installment)
                                <tr>
                                    <td scope="row">{{ $installment->date->format('d/m/Y') }}</td>
                                    <td>{{ currency($installment->amount) }}</td>
                                    <td>{{ $installment->method->name }}</td>
                                    <td>{{ $class->situation }}</td>
                                    <td><a name="" id="" class="btn btn-primary" href="#" role="button">Recebeer</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script>
    dataTable('.datatable')
</script>
@endsection