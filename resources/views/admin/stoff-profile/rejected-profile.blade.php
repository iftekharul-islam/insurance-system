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
                                    <th>Email</th>
                                    <th>Loan Amount</th>
                                    <th>Manager Name</th>
                                    <th>Manager Branch Name</th>
                                    <th>Rejected Reason</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img src="{{ asset('public/loan_profile/') . '/' . $data->loan_owner_image }}"
                                                style="width: 121px;">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->loan_amount }}</td>
                                        <td>{{ $data->manager_name }}</td>
                                        <td>{{ $data->manager_branch }}</td>
                                        <td>{{ $data->rejected_reason }}</td>
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
    <script></script>

@endsection
