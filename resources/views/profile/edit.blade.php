@extends('layouts.main')

@section('content')





@include('profile.partials.update-profile-information-form')





@include('profile.partials.update-password-form')





@include('profile.partials.delete-user-form')

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).ready(function() {
        $(".sidebar-item.active").removeClass("active");
        $("#profile").addClass("active");
    });

</script>

@endsection
