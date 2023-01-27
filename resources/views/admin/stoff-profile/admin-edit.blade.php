@extends('admin.layout.master')
@section('title', 'Edit Admin')
@section('content')



    <main class="app-content">
        <h3>Add Admin</h3>
        <hr />
        <div class="row">

            <div class="col-md-12">
                <div class="tile">
                    <!---Success Message--->
                    <span>{{ $errors }}</span>
                    <!---Error Message--->


                    <div class="tile-body">
                        <form method="post">
                            @csrf
                            <div class="form-group col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control" value="{{ $data->name }}" name="name" id="category"
                                    type="text" placeholder="Name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">User Name</label>
                                <input class="form-control" value="{{ $data->email }}" name="email" id="category"
                                    type="text" placeholder="Emil">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <style>
                                .toggle-password {
                                    float: right;
                                    cursor: pointer;
                                    margin-right: 10px;
                                    margin-top: -25px;
                                }
                            </style>

                            <div class="form-group col-md-12">
                                <label class="control-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>

                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">Phone Number</label>
                                <input type="text" name="phone" id="phone"  value="{{ $data->phone }}" class="form-control">

                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            @if( $data->manager_branch)
                                <div class="form-group col-md-12">
                                    <label class="control-label">Branch manager</label>
                                    <input type="text" name="phone" id="phone"  value="{{ $data->manager_branch }}" class="form-control">

                                    @if ($errors->has('password'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group col-md-12">
                                <label class="control-label">Role</label>
                                <select name="is_admin" class="form-control">
                                    @if ($data->is_admin == 1)
                                        <option value="1">Super Admin</option>
                                    @elseif($data->is_admin == 2)
                                        <option value="2">Loan Manager</option>
                                    @elseif($data->is_admin == 3)
                                        <option value="3">Loan Officer</option>
                                    @elseif($data->is_admin == 4)
                                        <option value="4">Notice Admin</option>
                                    @endif
                                    <option value="2">Loan Manager</option>
                                    <option value="3">Loan Officer</option>
                                    <option value="4">Notice Admin</option>

                                </select>
                                @if ($errors->has('is_admin'))
                                    <div class="text-danger">{{ $errors->first('is_admin') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 align-self-end">

                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value=" Update">
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
