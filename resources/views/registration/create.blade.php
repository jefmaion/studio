@extends('template.main')



@section('content')



<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-3 d-flex flex-column">
        @include('student.info')
    </div>
    <div class="col-12 col-md-12 col-lg-9">

            <div class="card">
                <div class="card-header">
                    <h4>Nova Modalidade</h4>
                </div>
                <form action="{{ route('student.registration.store', $student) }}" method="post">
                    @csrf
                    <div class="card-body">
                        @include('registration.form')
                    </div>
                </form>
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