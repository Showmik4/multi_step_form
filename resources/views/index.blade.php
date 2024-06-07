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
                </div>

                <form action="/post" method="post" class="employee-form">
                    @csrf
                    <div class="form-section">
                        <div class="introFirstPage">
                            <div class="logo py-5">
                                <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid">
                            </div>

                            <div class="content">
                                <h3>We’ll be asking a few questions about your business to assess your business health.
                                </h3>

                                <p class="py-5">
                                    This check is short and sweet, and confidential. Results will be emailed to you at
                                    completion.
                                </p>
                                <p class="estimate align-items-center">
                                    <img src="{{ asset('clock.png') }}" alt="cloeck" class="img-fluid">
                                    Estimated time to completion 10 minutes
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid"
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
                                    4. Do you expect your annual revenue/turnover to increase in the next 12 months?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. How long has your business been operating for?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid"
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

                        <div class="questonBox">
                            <div class="startTitle">
                                <h4>STRATEGY</h4>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. Do you expect your annual revenue/turnover to increase in the next 12 months?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Unlikely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Absolutely
                                        </span>
                                        <img src="{{ asset('right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Adaptability to Market Changes</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    1. How long has your business been operating for?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Less than 1 <br> year
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            More than 5 <br> years
                                        </span>
                                        <img src="{{ asset('right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-section">
                        <div class="logoAndProgress">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid"
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

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    4. How frequently do you review progress against your business’s strategic plan or
                                    financial forecast modelling?
                                </p>
                                <div class="options d-flex align-items-center py-4 justify-content-between ps-5">
                                    <div class="single">
                                        <input type="radio" value="1" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">1</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="2" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">2</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="3" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">3</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="4" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">4</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="5" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">5</span>
                                    </div>
                                    <div class="single">
                                        <input type="radio" value="6" name="q-1" id=""
                                            class="form-check-input">
                                        <span class="markTxt d-block">N/A</span>
                                    </div>
                                </div>
                                <div class="instraction d-flex align-items-center justify-content-between">
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('left.png') }}" alt="left" class="img-fluid">
                                        <span class="text-center">
                                            Rarely
                                        </span>
                                    </p>

                                    <p class="d-flex align-items-center">
                                        <span class="text-center">
                                            Regularly
                                        </span>
                                        <img src="{{ asset('right.png') }}" alt="left" class="img-fluid">
                                    </p>
                                </div>
                            </div>

                            <div class="startTitle">
                                <h3>Adaptability to Market Changes</h3>
                            </div>

                            <div class="singleQuestion">
                                <p class="questionTitle">
                                    15. As a business owner, we must always plan to exit. Accordingly, would you prefer
                                    to sell, pass on or close the business?
                                </p>
                                <div class="options py-4 justify-content-between ps-5">
                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="1" name="q-1" id=""
                                                class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Sell</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="1" name="q-1" id=""
                                                class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Pass on</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="1" name="q-1" id=""
                                                class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Close</span>
                                        </div>
                                    </div>

                                    <div class="single align-items-start mb-3">
                                        <div class="d-flex">
                                            <input type="radio" value="1" name="q-1" id=""
                                                class="form-check-input">
                                            <span class="markTxt mt-0 ml-4">Others</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-navigation mt-3">
                        <div class="d-flex align-items-center justify-content-between mt-5">
                            <button type="button" class="previous backBtn btn">
                                <img src="{{ asset('arrow-left.png') }}" alt="arrowLeft" class="img-fluid">
                            </button>
                            <button type="button" class="next continueBtn btn">Continue</button>
                            <button type="submit" class="btn continueBtn float-right">Submit</button>
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



</body>

</html>
