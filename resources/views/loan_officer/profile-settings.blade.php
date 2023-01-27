@extends('loan_officer.layout.master')
@section('title', 'Profile Settings')
@section('content')


    <main class="app-content">

        <div class="row">

            <div class="col-md-12">
                <div class="tile">
                    <!---Success Message--->

                    <!---Error Message--->

                    <div class="tile-body">
                        <form method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group col-md-12">
                                <label class="control-label">Photo</label>
                                <input onchange="readPhoto(this);" class="form-control" name="photo" id="category"
                                    type="file" placeholder="Enter Password">
                                @if ($errors->has('photo'))
                                    <div class="text-danger">{{ $errors->first('photo') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" id="category" type="text"  value="@if (!empty(Auth::user()->name)){{ Auth::user()->name }}@endif">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Email Address</label>
                                <input class="form-control" name="email" id="category" type="email" value="@if (!empty(OfficerProfile(Auth::user()->id)->email)){{ OfficerProfile(Auth::user()->id)->email }}@endif">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Mobile</label>
                                <input class="form-control" name="mobile" id="category" type="text" value="@if (!empty(OfficerProfile(Auth::user()->id)->mobile)){{ OfficerProfile(Auth::user()->id)->mobile }}@endif">
                                @if ($errors->has('mobile'))
                                    <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Address</label>
                                <input class="form-control" name="address" id="category" type="text" value="@if (!empty(OfficerProfile(Auth::user()->id)->address)){{ OfficerProfile(Auth::user()->id)->address }}@endif">
                                @if ($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary"
                                    value=" Update Profile">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>

    <script type="text/javascript">
        function readPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-src')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
