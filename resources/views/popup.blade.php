<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <style>
        body {
            background: #153148;
        }

        .modalHeader {
            padding: 1.25rem;
            background: #153148;
            border-radius: 1.5rem;
        }

        .modalHeader h1 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #fff;
            padding: .75rem 0;
        }

        .modalHeader p {
            font-size: 1.5rem;
            font-weight: 500;
            color: #fff;
        }

        .innerTitle {
            font-size: 2.2rem;
            font-weight: bold;
            color: #153148;
        }

        .singleInput {
            padding: 1rem 0;
        }

        .singleInput label {
            font-size: 1.4rem;
            font-weight: 500;
            color: #153148;
            margin-bottom: 0.75rem;
        }

        .singleInput input {
            font-size: 1.5rem;
            padding: 0.75rem 1rem;
        }

        .submitBtnDone {
            background: #153148;
            color: #fff;
            padding: 0.75rem 4rem !important;
        }
    </style>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-4 pt-4">
                <div class="modalHeader text-center">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid">
                    <h1 class="modal-title" id="exampleModalLabel">Congratulations!</h1>
                    <p class="modalTxt">
                        You’ve successfully completed The BD Consultants <br> Business Health Check
                    </p>
                </div>
                <div class="modal-body">
                    <h3 class="innerTitle">Where should we send your results?</h3>

                    <form action="{{ route('sendMail') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="singleInput">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="name" id="fname" class="form-control"
                                        placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="singleInput">
                                    <label for="fname">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control"
                                        placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="singleInput">
                                    <label for="email">Email</label>
                                    <input type="mail" name="email" id="email" class="form-control"
                                        placeholder="Email" required>
                                </div>

                                <div class="singleInput text-center">
                                    <input type="submit" value="Done" class="btn submitBtnDone">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
</body>

</html>
