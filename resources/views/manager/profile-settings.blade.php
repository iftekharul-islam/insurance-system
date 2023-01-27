@extends('loan_officer.layout.master')
@section('title', 'Profile Settings')
@section('content')


    <main class="app-content">
        <h3>Profile Update</h3>
        <hr />
        <div class="row">

            <div class="col-md-12">
                <div class="tile">
                    <!---Success Message--->

                    <!---Error Message--->
                    <div class="tile-body">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $manager_id = Auth::user()->id;
                            @endphp


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

                                <input class="form-control"
                                    value="@if (!empty(ManagerProfile(Auth::user()->id)->name)){{ ManagerProfile(Auth::user()->id)->name }}@endif"
                                    name="name" id="category" type="text">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Email</label>
                                <input class="form-control" name="email" id="category" type="email"
                                    value="@if (!empty(ManagerProfile(Auth::user()->id)->email)){{ ManagerProfile(Auth::user()->id)->email }}@endif">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Mobile</label>
                                <input class="form-control" name="mobile" id="category" type="number"
                                    value="@if (!empty(ManagerProfile(Auth::user()->id)->mobile)){{ ManagerProfile(Auth::user()->id)->mobile }}@endif">
                                @if ($errors->has('mobile'))
                                    <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Address</label>
                                <input class="form-control" name="address" id="category" type="text"
                                    value="@if (!empty(ManagerProfile(Auth::user()->id)->address)){{ ManagerProfile(Auth::user()->id)->address }}@endif">
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
