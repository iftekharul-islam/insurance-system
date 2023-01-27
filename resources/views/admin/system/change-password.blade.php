@extends('admin.layout.master')
@section('title', 'Change Password')
@section('content')

    <main class="app-content">

        <div class="row">

            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Change Password</h3>

                    <div class="tile-body">
                        <form class="row" method="post">
                            @csrf

                            <style>
                                .toggle-password {
                                    float: right;
                                    cursor: pointer;
                                    margin-right: 10px;
                                    margin-top: -25px;
                                }
                            </style>

                            <div class="form-group col-md-12">
                                <label class="control-label">New Password</label>
                                <input type="password" name="password" id="newpassword"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="New Password"
                                    autocomplete="off" value="{{ old('password') }}">
                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirmpassword"
                                    placeholder="Confirm Password" autocomplete="off"
                                    class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('confirm_password') }}">

                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <input type="Submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
            $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

@endsection
