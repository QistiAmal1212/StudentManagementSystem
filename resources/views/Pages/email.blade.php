    @extends('layouts.main')
    @section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <body>

        <div class="row" style="margin-top:40px;">
            <div class="col-5">
                <div style="display:flex; justify-content:flex-end;">
                    <img src="../Images/Mail.svg" alt="Gmail Logo" style="max-width: 400px;height:400px;"></div>
            </div>
            <div class="col-7" style="position:relative; left:-40px;">




                <div class="card mx-auto" style="border-radius: 20px; max-width: 500px;margin-top:20px;">
                    <div class="card-body">




                        <form method="post" action="{{ route('sendEmail') }}">
                            @csrf

                            <input type="hidden" id="subject" name="subject" value="test" required>


                            <label for="recipient">Email</label>
                            <select class="form-select" aria-label="Default select example" id="recipient" name="recipient" required>
                                <option selected>Choose email</option>
                                <option value="qistiamaluddin7@gmail.com">qistiamaluddin7@gmail.com</option>
                                @foreach ($emails as $email)
                                <option value="{{ $email->email }}">{{ $email->email }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="document">document</label>
                            <select class="form-select" aria-label="Default select example" id="document" name="document" required>
                                <option value="0">---</option>
                                @foreach($documents as $document)
                                <option value="{{ $document->documentPath }}">[{{ $document->documentId }}] - {{ $document->title }} </option>
                                @endforeach
                            </select>
                            <br>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable({

                });


                $(".sidebar-item.active").removeClass("active");
                $("#email").addClass("active");

            });

        </script>
    </body>
    </html>
    @endsection
