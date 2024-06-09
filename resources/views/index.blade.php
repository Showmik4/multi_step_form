<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multi-step Form in Laravel 9</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        html {
            font-size: 10px;
        }

        .form-section {
            display: none;
        }

        .form-section.current {
            display: inline;
        }

        .parsley-errors-list {
            color: red;
        }

        body {
            background: #153148;
        }

        * {
            color: #fff;
        }

        .container {
            max-width: 90rem;
        }

        .introFirstPage {
            padding-top: 2rem;
            padding-bottom: 3rem;
        }

        .introFirstPage .content h3 {
            font-size: 4.3rem;
            font-weight: 600;
        }

        .introFirstPage .content p {
            font-size: 2.2rem;
            font-weight: normal;
            padding: 2rem 0;
        }

        .estimate {
            padding: 0.25rem 1.56rem !important;
            padding-left: 0.75rem !important;
            border-radius: 4rem;
            background: #fff;
            color: #000;
            display: inline-block;
        }

        .estimate img {
            margin-top: -0.5rem;
        }

        .continueBtn {
            font-size: 2rem;
            font-weight: 600;
            color: #fff;
            background: #23B584;
            padding: 1.5rem 2rem;
            border-radius: 1.5rem;
        }

        .backBtn {
            height: 5.5rem;
            width: 6.5rem;
            border: 0.4rem solid #23B584;
            border-radius: 1rem;
        }

        .logoAndProgress {
            padding: 4rem 0;
        }

        .progressTrack {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 1rem;
            color: #fff;
        }

        .logoAndProgress .progress-bar {
            background: #23B584;
        }

        .progressCtrl {
            padding-left: 7rem;
        }

        .progressCtrl .progress {
            border-radius: 1rem;
        }

        .options .single input[type="radio"] {
            height: 2.752rem;
            width: 2.75rem;
        }

        .options .markTxt {
            font-size: 1.75rem;
            font-weight: 500;
            margin-top: 1rem;
            margin-left: -1rem;
        }

        .options .single {
            position: relative;
            margin-left: 1.25rem;
            display: flex;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        /* Style the radio button */
        .single input[type="radio"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid white;
            border-radius: 50%;
            background-color: transparent;
            cursor: pointer;
            position: relative;
        }

        /* Style the radio button when checked */
        .single input[type="radio"]:checked {
            background-color: #23B584;
            border-color: #23B584;
        }

        /* Optional: add a dot inside the radio button when checked */
        .single input[type="radio"]:checked::after {
            content: '';
            display: block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .startTitle h4 {
            font-size: 2.8rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 1rem 0;
            padding-bottom: 2rem;
        }

        .startTitle h3 {
            font-size: 1.8rem;
            font-weight: 700;
            padding: 1rem 0;
            padding-bottom: 1rem;
        }

        .questionTitle {
            font-size: 1.8rem;
            font-weight: normal;

        }

        .instraction p {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .instraction p img {}

        .singleQuestion {
            margin-bottom: 3rem;
        }

        .modalHeader {
            padding: 2.25rem;
            background: #153148;
            border-radius: 2rem;
        }

        .modalHeader h1 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #fff;
            padding: 1.25rem 0;
        }

        .modalHeader p {
            font-size: 2.1rem;
            font-weight: 500;
            color: #fff;
        }

        .innerTitle {
            font-size: 2.8rem;
            font-weight: bold;
            color: #153148;
        }

        .singleInput {
            padding: 1rem 0;
        }

        .singleInput label {
            font-size: 1.8rem;
            font-weight: 500;
            color: #153148;
            margin-bottom: 0.75rem;
        }

        .singleInput input {
            font-size: 1.8rem;
            padding: 0.75rem 1rem;
        }

        .submitBtnDone {
            background: #153148;
            color: #fff;
            padding: 0.75rem 4rem !important;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .modal-content {
            border-radius: 1.5rem;
        }

        .submitBtnDone:hover {
            color: #fff;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col-md-9 ">
                <div class="nav nav-fill my-3" style="visibility: hidden; height: 0; width: 0; overflow: hidden;">
                    <label class="nav-link shadow-sm step0    border ml-2 ">Step One</label>
                    <label class="nav-link shadow-sm step1   border ml-2 ">Step Two</label>
                    <label class="nav-link shadow-sm step2   border ml-2 ">Step Three</label>
                    <label class="nav-link shadow-sm step2   border ml-2 ">Step Four</label>
                    <label class="nav-link shadow-sm step2   border ml-2 ">Step Four</label>
                    <label class="nav-link shadow-sm step2   border ml-2 ">Step Four</label>
                    <label class="nav-link shadow-sm step2   border ml-2 ">Step Four</label>
                </div>

                <form action="{{route('submit_form')}}" method="post" class="employee-form">
                    @csrf
                    <div class="form-section">
                        <div class="introFirstPage">
                            <div class="logo py-5">
                                <img src="{{ asset('public/logo.png')}}" alt="logo" class="img-fluid">
                            </div>

                            <div class="content">
                                <h3>We’ll be asking a few questions about your business to assess your business health.
                                </h3>

                                <p class="py-5">
                                    This check is short and sweet, and confidential. Results will be emailed to you at
                                    completion.
                                </p>
                                <p class="estimate align-items-center">
                                    <img src="{{ asset('public/clock.png') }}" alt="cloeck" class="img-fluid">
                                    Estimated time to completion 10 minutes
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------ Business Prfile Page 1-------- --}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        3%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 3%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>BUSINESS PROFILE</h4>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. Do you expect your annual revenue/turnover to increase in the next 12 months?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks1" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks1">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.What industry/sector does your business primarily operate in? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">6</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="7" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">7</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="8" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">8</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="9" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">9</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="10" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">10</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="11" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">11</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="12" name="marks2" id="" class="form-check-input">
                                        <span class="markTxt d-block">12</span>
                                    </div>
                                    <input type="hidden" value="12" name="total_marks2">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- --------- Business Profile Page2-------------------------------- --}}
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        11%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 11%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>BUSINESS PROFILE</h4>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4.Do you expect your annual revenue/turnover to increase in the next 12 months?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks3" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks3">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5.Rate your business’s current strategy to acquire new customers or clients? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>

                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks4" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks4">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6.Rate your business’s current method of retention? (retaining current customers or
                                    clients) 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks5">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7.Rate your business’s current processes and/or systems? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks6" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks6">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8.
                                    Rate your business’s current cashflow and/or working capital management?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks7" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks7">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9.Rate your business’s current relationship with finance management, budgeting and
                                    forecast modelling? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks8" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks8">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10.Rate your business’s current staff and team productivity?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks9" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks9">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11.If you were unable to work for 3 months due to a health-related reason, would the
                                    business maintain full operation?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks10" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks10">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        19%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 11%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--- ----------------- Strategy Page 1 ------------------------------- --}}

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>STRATEGY</h4>
                            </div>
                            <div class="startTitle">
                                <h3>Mission, Vission, Values</h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. How clear well-understood is your company's mission and vision?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks11" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks11">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.Has your business defined its values?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks12" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks12">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3. How through is your understanding of your target market and it's need?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks13" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks13">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. How specific and measurable are your strategic goals and objectives?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks14" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks14">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5. How aware of your business's competitive advantages in the market?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks15" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks15">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6. How Confident are you in your business strategic plan?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks16" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks16">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7. How effectively do you identify,asses,mitigate risk in your strategic planning?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks17" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks17">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8. How clear are the key performace indicators (KPIs) in measuring strategic
                                    performace ?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks18" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks18">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- --------------------- Strategy Page 2 ---------------------------- --}}
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        26%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 26%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>STRATEGY</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Adaptability to Market Changes</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks19" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks19">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks20" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks20">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks21" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks21">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    12. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks22" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks22" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks22" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks22" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks22" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks22">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    13. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks23" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks23">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    14. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks24" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks24">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    15. As a business owner, we must always plan to exit. Accordingly, would you prefer
                                    to sell, pass on or close the business?
                                </p>
                                <div class="options py-4 justify-content-between ps-5">
                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="1" name="marks25" id="" class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Sell</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="2" name="marks25" id="" class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Pass on</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="3" name="marks25" id="" class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Close</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="4" name="marks25" id="" class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Others</span>
                                        </div>
                                    </div>
                                    <input type="hidden" value="4" name="total_marks5">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------ Customer Page 1------------ --}}
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        34%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 34%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>CUSTOMERS</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Satisfaction</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1.
                                    How satisfied are your customers with your products/services?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks26" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks26">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.
                                    How likely are your customers to recommend your business to others?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marmarks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks27" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks27">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3.
                                    How would you rate the overall quality of your customer experience, from initial
                                    interaction to completion/sale?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks28" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks28">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Feedback</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4.
                                    How effective are your feedback collection methods?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks29" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks29">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5.
                                    How well do you respond to customer feedback and complaints?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks30" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks30">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Loyality</h3>
                            </div>


                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6.
                                    How loyal do you perceive your customer base to be?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks31" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks31">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Repeat Business</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7. What amount of your revenue comes from repeat customers?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks32" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks32">
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Lifetime Value (CLV)</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8.
                                    How effectively do you calculate and track customer lifetime value? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks33" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks33">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------ Customer Page 2--------------------- --}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        42%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 42%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>CUSTOMERS</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Communication Channels</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9.
                                    How effective are your communication channels with customers?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks34" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks34">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Competition Benchmarking</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10.How does your customer experience compare to that of competitors?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks35" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks35">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11.
                                    Have you identified your business’s current key competitors and defined your
                                    competitive advantage against each of them? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks36" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks5">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    12.
                                    Does your business follow clear brand guidelines across the entire business? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks37" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks37">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    13.
                                    How often does your business externally benchmark and internally recalculate prices?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks38" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks38">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Retention Strategies</h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    14.
                                    How effective are your strategies for retaining existing customers?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks39" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks39">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    15.Do you know how many new customers you need to attract and convert every month to
                                    reach your targeted revenue goals?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks40" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks40">
                                </div>
                            </div>


                            <div class="startTitle">
                                <h3>Customer Referral Program</h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    16.
                                    Do you have a customer referral program? If so, how successful is your referral
                                    program in generating new customers?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks41" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks41">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ---------------------- Customer Page 3 ---------------------- --}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        49%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 49%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>CUSTOMERS</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Service Performance</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    17.
                                    How would you rate the performance of your customer service team?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks42" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks42">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Success Metrics</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    18.
                                    How effective are your metrics in measuring customer success and satisfaction?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks43" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks43">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3> Customer Engagement</h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    19.How engaged are your customers with your brand?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks44" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks44">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    20.
                                    Are your advertising, marketing, PR and communications targets fully aligned with
                                    your strategic plan goals and measures of success?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks45" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks45">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    21.
                                    How effective is your current Organise Search (SEO) for generating sales leads?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks46" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks46">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    22.
                                    How effective are your social media, media relations and digital advertising (paid
                                    search/display ads) at generating sales leads?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks47" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks47">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3> Google or Trustpilot</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    23.What is your Google Business or Trust Pilot rating?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks48" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks48">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- --------------------------- Culture & People Page 1--------------------}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        56%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width:56%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Culture & People</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Roles</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1.Does your business have a defined and documented onboarding program for new team
                                    members?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks49" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks49">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.How clear are the roles and responsibilities of each team member within the
                                    business?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks50" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks50">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Clear Organisational Values</h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3.How well-defined and understood are your company's values by employees?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks51" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks51">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="startTitle">
                                <h3>Communication Effectiveness</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4.How effective is communication within your organisation?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks52" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks52">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Recognition and Rewards</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6.How effectively do you recognise and reward employee contributions?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks53" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks53">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7.How frequently do you review the productivity and capacity level of the people
                                    working in your business?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks54" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks54">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ---------------------------- Culture & people page 2------------------------ --}}
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        60%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>CULTURE & PEOPLE</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Employee Morale</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8.How would you rate the overall morale of your employees?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks55" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks55">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Trust in Leadership</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9.How much trust do employees have in the leadership of your organisation?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks56" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks56">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10.
                                    How often do the business leaders carry out a ‘1 on 1’ catch up with team members?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks57" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks57">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Employee Satisfaction</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11.
                                    How satisfied are employees with the overall work environment?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks58" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks58">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>


                    {{-- ------------------------- - Operations Page 1 -----------------}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        68%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 68%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Operations</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Efficiency of process</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1.How efficient are your business processes in delivering products/services?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks59" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks59">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.If the business doubled overnight, would you have the operational capacity to
                                    manage the growth?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks60" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks60">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Quality Control Measures</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3.How effective are your quality control measures in ensuring product/service
                                    quality?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks61" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks61">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Inventory Management</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4.How well-managed is your inventory?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks62" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks62">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks63" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks63">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="startTitle">
                                <h3>Supply Chain Resilience</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5.How resilient is your supply chain to disruptions and delays?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks64" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks64">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6.Does your business have formal terms with your business-critical suppliers?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks65" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks65">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Production Capacity Utilization</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7.Has your business defined its recurring processes? (purchasing, inventory,
                                    production, sales method etc)
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks66" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks66">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Technology Integration</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8.How well-integrated is technology in your operations to improve efficiency?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks67" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks67">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- ------------------ Operations page 2------------------------ --}}


                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        74%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 74%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Operations</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Health and Safety Compliance</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9. How compliant are your operations with health and safety regulations?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks68" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks68">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Service Efficiency </h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10. How efficient is your customer service in addressing inquiries and issues?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks69" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks69">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="startTitle">
                                <h3>Cost Management </h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11.How effectively do you manage operational costs to optimise profitability?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks70" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks70">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    12.
                                    How many competitive quotes does your business seek from potential suppliers or when
                                    making high-level purchases?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks71" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks71">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Flexibility and adaptability </h3>
                            </div>
                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    13. How adaptable are your operations to changing market conditions and demands?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks72" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks72">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    14.How frequently do you review production/service constraints or bottlenecks? 
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks73" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks73">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- --------------------- Finance Page 1------------------------ --}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        83%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 83%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Finances</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Financial Stability</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. How stable is your business financially
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks74" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks74">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2.Does your business prepare financial budgets or forecasts?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks75" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks75">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Profitability</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3. How profitable is your business currently?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks76" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks76">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Cash Flow Management</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. How effectively do you manage your cash flow?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks77" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks77">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5. How frequently do you review forecast vs actual financial performance?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks78" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks78">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Revenue Growth</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6. How would you rate your revenue growth trajectory?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks79" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks79">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Cost Control</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7. How well do you control your expenses?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks80" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks80">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>



                            <div class="startTitle">
                                <h3>Financial Planning</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8. How effectively do you plan your finances for the future?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks81" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks81">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>


                            <div class="startTitle">
                                <h3>Return On Investment</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9. How satisfied are you with the return on investment from your business
                                    activities?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks82" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks82">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------ Finance Page 2---------------------- --}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        89%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 89%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Finances</h4>
                            </div>

                            <div class="startTitle">
                                <h3>Financial Transparency</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10. How transparent are your financial record and reporting?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks83" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks83">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Tax Compliance</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11. How compliance are you with tax regulations?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks84" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks84">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Profit Margin </h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    12. How satisfied are you with your business profit mirgin?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks85" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks85" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks85" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks85" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks5" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks85" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks85">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    13. What is your business average gross margin?(The % of sales revenue after
                                    deducting direct costs)
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks86" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks86">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    14. Does your business calculate the volume of sales required to "break even"?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks87" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks87">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    15. How satisfied are you with your business accountant?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks88" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks88">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ----------------------------- Structure & System Page ---------------------}}

                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid"
                                    style="width: 10rem;">
                                <div class="progressCtrl align-items-center w-100 d-flex">
                                    <p class="progressTrack px-4">
                                        100%
                                    </p>
                                    <div class="progress w-100" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>Structure & System </h4>
                            </div>

                            <div class="startTitle">
                                <h3>Organizational Structure Clarity</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. How clear and well-defined is your Organizational structure
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks89" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks89">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Organizational Structure Clarity</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    2. Workflow efficiency
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks90" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks90">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>System integration</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    3.How well integrated are your systems and processes accross departments
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks91" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks91">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Decision making process</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. How effective is your decision making process within your organisation
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks92" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks92">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Training and development programs</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    5. How effective are your traning and development programs in preparing employees
                                    for their roles?

                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks93" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks93">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Performance management systems</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    6. How effective are your performace management systems in providing feedback and
                                    evaluating employee performance?

                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks94" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks94">
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('public/left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('public/right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Standard operating proceduress(SOPs)</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    7. How well-established and followed are your standard operating procedures?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks95" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks95">
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Customer Relationship Management(CRM) Systems</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    8. How effective is your CRM system managing and nurturing customer relationships?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks96" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks96">
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Regulatory compliance Systems</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    9. How effectively do your business ensure compliance with regulations and company
                                    standards?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks97" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks97">
                                </div>
                            </div>


                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    10.Do you have a WHS(workplace health and safety ) policy and/or procedure?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks98" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks98">
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>IT Infrastructure Reliability</h3>
                            </div>


                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    11.How reliable is your IT infrastructure in supporting daily operations ?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="0" name="marks99" id="" class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                    <input type="hidden" value="5" name="total_marks99">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="modal-content px-4 pt-4">
                            <div class="modalHeader text-center">
                                <img src="{{ asset('public/logo.png') }}" alt="logo" class="img-fluid">
                                <h1 class="modal-title" id="exampleModalLabel">Congratulations!</h1>
                                <p class="modalTxt">
                                    You’ve successfully completed The BD Consultants <br> Business Health Check
                                </p>
                            </div>
                            <div class="modal-body">
                                <h3 class="innerTitle">Where should we send your results?</h3>

                                {{-- <form action="{{ route('store') }}" method="POST"> --}}
                                    {{-- @csrf --}}
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="singleInput">
                                                <label for="fname">First Name</label>
                                                <input type="text" name="first_name" id="fname" class="form-control"
                                                    placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="singleInput">
                                                <label for="fname">Last Name</label>
                                                <input type="text" name="last_name" id="lname" class="form-control"
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
                                                {{-- <input type="submit" value="Done" class="btn submitBtnDone"> --}}

                                                <button type="submit" class="btn submitBtnDone">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{--
                                </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="form-navigation mt-3">
                        <div class="d-flex align-items-center justify-content-between mt-5">
                            <button type="button" class="previous backBtn btn">
                                <img src="{{ asset('public/arrow-left.png') }}" alt="arrowLeft" class="img-fluid">
                            </button>
                            <button type="button" class="next continueBtn btn">Continue</button>
                            {{-- <button type="submit" class="btn continueBtn float-right">Submit</button> --}}
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <script>
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);

                const step = document.querySelector('.step' + index);
                if (step) {
                    step.style.backgroundColor = "#17a2b8";
                    step.style.color = "white";
                }
            }

            function curIndex() {
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function() {
                navigateTo(curIndex() - 1);
            });

            $('.form-navigation .next').click(function() {
                $('.employee-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    navigateTo(curIndex() + 1);
                });

            });

            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
            });
            navigateTo(0);
        });
    </script>

    <script src="{{url('/public/assets/js/toastr.min.js')}}"></script>
    <script>
        @if(session('message'))
        toastr.info('{{session('message')}}')
        @endif
        @if(session('warning'))
        toastr.warning('{{session('warning')}}')
        @endif
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif
        @if(session('danger'))
        toastr.error('{{session('danger')}}')
        @endif

        //Jquery On ecnyer event bonding
        (function($) {
            $.fn.onEnter = function(func) {
                this.bind('keypress', function(e) {
                    if (e.keyCode === 13) func.apply(this, [e]);
                });
                return this;
            };
            })(jQuery);
    </script>



</body>

</html>