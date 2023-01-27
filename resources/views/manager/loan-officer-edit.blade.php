@extends('manager.layout.master')
@section('title', 'Edit Loan Officer')

@section('content')


    <main class="app-content">
        <h3>Edit Loan Officer</h3>
        <hr />
        <div class="row">

            <div class="col-md-12">
                <div class="tile">
                    <!---Success Message--->

                    <!---Error Message--->


                    <div class="tile-body">
                        <form method="post">
                            @csrf
                            <div class="form-group col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" id="category" type="text" placeholder="Name"
                                    value="{{ $data->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">User Name</label>
                                <input class="form-control" name="email" id="category" type="text" placeholder="Email"
                                    value="{{ $data->email }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Mobile No</label>
                                <input class="form-control" name="phone" type="text" placeholder="Mobile No"
                                    value="{{ $data->phone }}">
                                @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Password</label>
                                <input class="form-control" name="password" id="category" type="password"
                                    placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <input type="hidden" class="form-control" name="is_admin" value="3">

                            <div class="form-group col-md-4 align-self-end">

                                <button type="submit" class="btn btn-danger"
                                    style="background:#009688;border:none;">Update&nbsp;<i
                                        class="fa-solid fa-pen"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function manager_role() {
            if ($("#managerRole").prop('checked') == false) {
                $('#branch').hide();
                //do something
            } else {
                $('#branch').show();
            }
        }
    </script>




@endsection
