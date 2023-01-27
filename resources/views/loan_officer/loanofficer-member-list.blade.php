@extends('admin.layout.master')
@section('title', 'Mamber List')
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


                        <h1>Member List</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="line-height: 34px;margin-top: 10px;">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="control-label" style="font-weight:bold;">
                                                Search By Type
                                                :&nbsp;<sup style="color:red">*</sup>
                                            </label>

                                        </div>
                                        <div class="col-8">
                                           <form action="{{ route('loacofficer.member.list.bystatus') }}" method="POST" id="statusType">
                                            @csrf
                                            <select required="" class="form-control" name="loanstats" id="SearchType">
                                                <option value="">
                                                    @if (!empty($selected_type))
                                                        @if ($selected_type == '0'|| $selected_type == '1'|| $selected_type == '2')
                                                            Pending
                                                        @elseif ($selected_type == '3')
                                                            Approved
                                                        @elseif($selected_type == '4')
                                                            Rejected
                                                        @else
                                                            --Select Type--
                                                        @endif
                                                    @else
                                                        --Select Type--
                                                    @endif
                                                </option>
                                                <option value="0">Pending</option>
                                                <option value="3">Approved</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Form ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Branch Name</th>
                                    <th>Loan Amount</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->form_id }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/loan_profile/').'/'.$data->loan_owner_image }}"style="width: 78px;height: 78px;">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->loan_owner_branch }}</td>
                                        <td>

                                            @php
                                                $loan_entry = $data->loan_amount - $data->loan_entry;
                                            @endphp
                                            @if ($data->loan_entry)
                                                <p>Loan Amount: <b>{{ $data->loan_amount }}</b> </p>
                                                <p>Loan Entry: <b>{{ $data->loan_entry }}</b></p>
                                                <p>Due Amount: <b>({{ $data->loan_amount + (($data->intrestRate * $data->loan_amount)/100) }} - {{ $data->loan_entry }})</b>
                                                </p>={{ ($data->loan_amount + (($data->intrestRate * $data->loan_amount)/100)) - $data->loan_entry }}
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{ route('loanofficer.member.view.profile', $data->id) }}"
                                                class="btn btn-info">View&nbsp;
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>

                                    @if ($data->loan_close_reason ==  "1")

                               @else
                                    @if($data->status == "0" || $data->re_submit_status == "1")
                                    <a href="{{ route('loacofficer.member.edit', $data->id) }}"
                                        class="btn btn-primary">
                                        Edit&nbsp;
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                @endif
                               @endif


                                        </td>
                                        <td>

                                            @if($data->loan_close_reason == '1')
                                                <button class="btn btn-danger">
                                                    Close&nbsp;
                                                </button>
                                            @else
                                                @if ($data->re_submit_status ==  "1" || $data->status == "4" || ($data->loan_close_reason == "1"))
                                                        <button class="btn btn-danger">
                                                            Rejected&nbsp;
                                                        </button>
                                                    @else
                                                        @if ($data->status == '3')
                                                            <button class="btn btn-success">
                                                                Approve&nbsp;
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger">Pending</button>
                                                        @endif
                                                @endif
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
