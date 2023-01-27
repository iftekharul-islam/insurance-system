@extends('admin.layout.master')
@section('title', 'Loan Submit')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .tile {
                overflow-x: scroll;
            }
        }
    </style>

    <main class="app-content">

        <hr />
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
                                    <th>Loan Amount</th>
                                    <th>View</th>
                                    <th>Status</th>
                                    <th>Submit</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    @if ($data->status == 2)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>
                                                <img src="{{ asset('public/loan_profile/') . '/' . $data->loan_owner_image }}"
                                                    style="width: 78px;height: 78px;">
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->manager_branch }}</td>
                                            <td>{{ $data->loan_amount }}</td>
                                            <td>
                                                <a href="{{ route('member.profile-view', $data->id) }}"
                                                    class="btn btn-info">View&nbsp;<i class="fa-solid fa-eye"></i></a>
                                            </td>
                                            <td>
                                                @if ($data->status != 2)
                                                    <button class="btn btn-danger">Pending</button>
                                                @else
                                                    <button class="btn btn-success">Approve&nbsp;<i
                                                            class="fa-solid fa-check"></i></button>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->sms == 'send')
                                                    <button class="btn btn-success" disabled="" type="button">
                                                        Submited
                                                    </button>
                                                @else
                                                    <a href="{{ route('send.sms', $data->id) }}"
                                                        onclick="return confirm('Are you Sure?')">
                                                        <button class="btn btn-primary" type="button">Submit</button>
                                                    </a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script>
        var name = '{{ env('SMS_USERNAME') }}';
        alert(name);
    </script> -->


@endsection
