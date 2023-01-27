<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>
<style>
    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    @media (min-width: 1025px) {
        .h-custom-2 {
            height: 100%;
        }
    }

    @media only screen and (max-width: 600px) {
        #logo {
            margin-top: -60px !important;
            margin-left: 16px !important;
            margin-bottom: 10px !important;
        }
    }

    #guide {
        margin-top: 250px;
        margin-left: 16px;
    }

    #instruc {
        width: 70%;
        height: 173px;
        background-color: #e7eb12fc;
        margin-left: 152px;
        padding: 12px;
        border-radius: 9px;
    }

    .img {
        background-image: url('https://media.istockphoto.com/photos/blurry-chemical-background-picture-id1022148436?b=1&k=20&m=1022148436&s=170667a&w=0&h=mVHqiw3xUNcWJmdXgycpylm76sCmuiWbwW48IxC5WPU=');
        width: 100%;
        height: 100vh;
        object-position: left;
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
    }

    #help {
        color: #fff;
    }

    #guide security {
        font-size: 11px;
        border: 1px solid;
        padding: 3px;
    }

    #guide h4 {
        font-size: 17px;
    }

    .sup {
        background: #fbfbfb52;
        padding: 1px;
        border-radius: 4px;
    }

</style>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row" style="overflow: hidden;">
                <div class="col-sm-4 text-black">



                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST" action="{{ route('login') }}">
                            @csrf
                            <img id="logo" src="uploads/logo/{{ settings()->home_logo }}" alt=""
                                style="width: 188px; margin-top: 85px; border-radius: 77px; margin-left: 72px;">
                            <br>
                            <br>
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>



                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif


                            <div class="form-outline mb-4" style="margin-top: 6px;">
                                <input type="text" name="email" id="form2Example18"
                                    class="form-control form-control-lg" />
                                <label class="form-label" for="form2Example18">User Name</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example28"
                                    class="form-control form-control-lg" value="" />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit"><i
                                        class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</button>
                            </div>

                            <br>
                            <br>
                            <br>
                            <p style="font-size: 11px; font-weight: 600;">
                                &copy;Copyright @php
                                    echo date("Y")
                                @endphp Design & Developed
                                By <a target="_blank" href="https://www.facebook.com/suzaul.sumon">
                                    Milky Way It Solution
                                </a>
                            </p>

                        </form>



                    </div>

                </div>

                <div class="col-sm-8 px-0 img d-none d-sm-block">

                    <div id="guide">

                        <div class="row" style="margin-top: 25px">
                            <div class="col-12">
                                <h4 style="margin-left:150px;" class="text-white"><i class="fa-solid fa-play security"
                                        style="border: 1px solid; padding:2px;font-size:12px;"></i>&nbsp;Security
                                    Guidelines
                                </h4>

                            </div>
                        </div>


                        <div class="row" style="margin-top: 25px">
                            <div class="col-12">
                                <div id="instruc">
                                    <p>1. Never Disclose Your Password/login id or other security information</p>
                                    <p>2. Never accept the option "save passowrd for this site"</p>
                                    <p>3. It is Suggested not to use your social media password for this system</p>
                                    <p>4. Your System id will be blocked right after 5 unsuccessfull login attempt</p>
                                </div>
                            </div>
                        </div>





                        <div class="row" style="margin-top: 25px">
                            <div class="col-12">

                                <div id="help" class="container">

                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fa-solid fa-play security"
                                                    style="border: 1px solid; padding:2px;font-size:12px;"></i>
                                                &nbsp;Need Help?
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3" style="margin-bottom: 10px">
                                            <div class="sup">
                                                <h5 style="margin-top: 4px;margin-left: 14px;font-size:16px;">
                                                    <i style="color:#e4e912;" class="fa-solid fa-phone"></i>
                                                    &nbsp;
                                                    09638654171
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="col-lg-5" style="margin-bottom: 10px;padding-left:0;">
                                            <div class="sup">
                                                <h5 style="margin-top: 4px;margin-left: 14px;font-size:16px;">
                                                    <i style="color:#e4e912;" class="fa-solid fa-envelope"> </i>
                                                    &nbsp;
                                                    {{ settings()->email }}
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" style="padding-left:0;">
                                            <div class="sup">
                                                <h5 style="margin-top: 4px;margin-left: 14px;font-size:16px;">
                                                    <i style="color:#e4e912;" class="fa-solid fa-globe"></i>
                                                    &nbsp;{{ route('login') }}
                                                </h5>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                </div>


            </div>
        </div>
    </section>
</body>

</html>
