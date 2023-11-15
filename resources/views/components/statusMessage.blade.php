<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

@if(session('success'))
<div id="successAlert" class="alert alert-success">
    {{ session('success') }}
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button> --}}
</div>
<script>
    setTimeout(function() {
        $('#successAlert').fadeOut('slow');
    }, 3000); // 3 seconds

</script>
@endif

@if(session('error'))
<div id="errorAlert" class="alert alert-danger">
    {{ session('error') }}
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button> --}}
</div>
<script>
    setTimeout(function() {
        $('#errorAlert').fadeOut('slow');
    }, 3000); // 3 seconds

</script>
@endif
