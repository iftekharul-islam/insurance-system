@extends('admin.layout.master')
@section('title', 'Officer Profile')
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
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Branch Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Address</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <td>{{ $data->id }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/profile/') . '/' . $data->photo }}"
                                            style="width: 121px;">
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->manager_branch }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->mobile }}</td>
                                    <td>{{ $data->address }}</td>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script></script>









@endsection
