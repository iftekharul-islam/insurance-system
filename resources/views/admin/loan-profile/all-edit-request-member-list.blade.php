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

                <div class="tile" style="border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <h3 class="tile-title">All Edit Request</h3>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Edit Reson</th>
                                    <th>Loan Amount</th>
                                    <th>View</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img
                                                src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_image }}"style="width: 78px;height: 78px;">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->edit_reason }}</td>
                                        <td>
                                            {{ $data->loan_amount }}
                                        </td>

                                        <td>
                                            <a href="{{ route('member.edit.request.view', $data->id) }}"
                                                class="btn btn-info">View&nbsp;
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>

                                        <td>
                                            @if ($data->status == 2)
                                                <button class="btn btn-success">
                                                    Approve&nbsp;
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            @elseif($data->status == 3)
                                                <button class="btn btn-danger">
                                                    Rejected&nbsp;
                                                </button>
                                            @else
                                                <button class="btn btn-danger">Pending</button>
                                            @endif
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
    <script></script>




@endsection
