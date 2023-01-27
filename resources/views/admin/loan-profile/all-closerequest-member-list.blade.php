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
                    <div class="tile-body">

                        <h1>Close Requested List</h1>



                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Form ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Branch Name</th>
                                    <th>Loan Amount</th>
                                    <th>View</th>
                                    <th>Print</th>
                                    {{-- <th>Edit</th> --}}
                                    <th>Delete</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->form_id }}</td>
                                        <td>
                                            <img
                                                src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_image }}"style="width: 78px;height: 78px;">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->loan_owner_branch }}</td>
                                        <td>
                                            {{ $data->loan_amount }}
                                            @php
                                                $loan_entry = $data->loan_amount - $data->loan_entry;
                                            @endphp
                                            @if ($data->loan_entry)
                                                <p>Loan Amount: <b>{{ $data->loan_amount }}</b> </p>
                                                <p>Loan Entry: <b>{{ $data->loan_entry }}</b></p>
                                                <p>Due Amount: <b>({{ $data->loan_amount }} - {{ $data->loan_entry }})</b>
                                                </p>={{ $data->loan_amount - $data->loan_entry }}
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{ route('member.view.profile.byadmin', $data->id) }}"
                                                class="btn btn-info">View&nbsp;
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('print.loanprofile', $data->id) }}"
                                                onclick="return confirm('Are you Sure?')">
                                                <button class="btn btn-secondary"
                                                    type="button">Print&nbsp;
                                                    <i class="fa-solid fa-print"></i>
                                                </button>
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('member.edit.byadmin', $data->id) }}"
                                                class="btn btn-primary">
                                                Edit&nbsp;
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td> --}}

                                        <td>
                                            <a href="{{ route('member.delete.byAdmin', $data->id) }}"
                                                onclick="return confirm('Are you Sure?')">
                                                <button class="btn btn-danger" type="button">Delete&nbsp;
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </a>
                                        </td>

                                        <td>

                                        @if ($data->loan_close_reason == '1')
                                            <button class="btn btn-danger">
                                                Closed &nbsp;
                                            </button>
                                        @else
                                            <a href="{{ route('close.request.member.post', $data->id) }}">
                                                <button class="btn btn-success">
                                                    Close Now&nbsp;
                                                </button>
                                            </a>

                                            {{-- @if ($data->re_submit_status == '1')
                                            <button class="btn btn-danger">
                                                Rejected&nbsp;
                                            </button>
                                            @else
                                            @if ($data->status == '3')
                                                <button class="btn btn-success">
                                                    Approved&nbsp;
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            @elseif($data->status == '1' || $data->status == '2' || $data->status == '0')
                                                <button class="btn btn-danger">Pending</button>
                                            @else

                                            @endif
                                            @endif --}}
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
    <script>
        $('#SearchType').change(function() {
            document.getElementById('statusType').submit();

        });
    </script>
@endsection
