@extends('admin.layout.master')
@section('title', 'List Admin')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .tile {
                overflow-x: scroll;
            }
        }
    </style>

    <main class="app-content">

        <div class="row">

            <div class="col-md-12">
                <div class="tile" style="    border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <!---Success Message--->

                    <!---Error Message--->

                    <div class="tile-body">
                        <form method="post">
                            @csrf
                            <div class="form-group col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" id="category" type="text" placeholder="Name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">User Name</label>
                                <input class="form-control" name="email" id="category" type="text"
                                    placeholder="User Name">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">Mobile No</label>
                                <input class="form-control" name="phone" type="text" placeholder="Mobile No">
                                @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
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

                                <input type="password" id="password" name="password" class="form-control" value="">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <!-- <div class="form-group col-md-12">-->
                            <!--  <span>If Manager Role Click This</span><input id="managerRole"  type="checkbox" onclick="manager_role()" style="margin-left:8px;">-->
                            <!--</div>-->

                            <div class="form-group col-md-12" style="display:none;" id="branch">
                                <label class="control-label">Manager Branch Name</label>
                                <input class="form-control" name="manager_branch" type="text"
                                    placeholder="Manager Branch Name">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Role</label>
                                <select name="is_admin" id="val" onchange="manager()" class="form-control">
                                    <option value="">--Select Role--</option>
                                    <option value="2"> Manager</option>
                                    <option value="3">Loan Officer</option>
                                    <option value="4">Notice Admin</option>

                                </select>
                                @if ($errors->has('is_admin'))
                                    <div class="text-danger">{{ $errors->first('is_admin') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Create">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile" style="    border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Login Info</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            @if ($data->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->is_admin == 1)
                                                Super Admin
                                            @elseif($data->is_admin == 2)
                                                Loan Manager
                                                @if ($data->manager_branch)
                                                    <br>
                                                    <b>(Branch Name: {{ $data->manager_branch }})</b>
                                                @endif
                                            @elseif($data->is_admin == 3)
                                                Loan Officer<br>

                                                <b>(Under: {{ $data->manager_branch }} Branch)</b>
                                            @elseif($data->is_admin == 4)
                                                Notice Admin
                                            @endif
                                        </td>

                                        <td>

                                            <a href="{{ route('user.loginfo', $data->id) }}">
                                                <button class="btn btn-info" type="button">Log Info&nbsp;
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </a>
                                        </td>

                                        <td>

                                            <a href="{{ route('list.admin.edit', $data->id) }}">
                                                <button class="btn btn-info" type="button">Edit&nbsp;
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('list.admin.status', $data->id) }}"
                                                onclick="return confirm('Are you Sure?')">
                                                <button class="btn btn-danger" type="button">Status update&nbsp;
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
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

        function manager() {
            $manager = $('#val').val();
            if ($manager == 2) {
                $('#branch').show();
            } else {
                $('#branch').hide();
                //do something
            }
        }

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
