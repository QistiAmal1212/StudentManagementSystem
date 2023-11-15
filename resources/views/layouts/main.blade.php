<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="Student Management System">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="icon" href="Images/LogoSystem.png" type="image/x-icon">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>SM_SYSTEM</title>

    <link href="../Template/adminkit-3-4-0/static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kenia:wght@400;700&display=swap">


</head>

<body>
    <div class="wrapper">
        {{-- sidebar here --}}
        @include('layouts.sidebar')
        <div class="main">
            {{-- navbar here --}}
            @include('layouts.navbar')

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>
            {{-- footer here --}}
            @include('layouts.footer')

        </div>
    </div>

    <script src="../Template/adminkit-3-4-0/static/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


</body>

</html>
