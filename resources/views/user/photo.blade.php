

<form action="{{ route('user.photo', $user->id) }}" enctype="multipart/form-data" method="POST" id="form-photo">
    @csrf
    <input type="file" class="d-none" name="image" id="photo">
</form>

@section('scripts')
@parent
<script>

    $('.pick-photo').click(function (e) { 
        e.preventDefault();
        $('#photo').trigger('click');
    });

    $('#photo').change(function (e) { 
        e.preventDefault();
        $('#form-photo').submit();
    });
</script>
@endsection