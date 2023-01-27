@extends('admin.layout.master')
@section('title', 'List Member')
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
                                           <form action="{{ route('all.memberbystatus.list.notice') }}" method="POST" id="statusType">
                                            @csrf
                                            <select required="" class="form-control" name="loanstats" id="SearchType">
                                                <option value="">
                                                    @if (!empty($selected_type))
                                                        @if ($selected_type == '0' || $selected_type == '1')
                                                            Pending
                                                        @elseif ($selected_type == '3'||$selected_type == '2')
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
                                                <option value="1">Pending</option>
                                                <option value="2">Approved</option>
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
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Print</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->form_id }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_image }}"
                                                style="width: 78px;height: 78px;">
                                        </td>
                                        <td>{{ $data->name }}</td>

                                        <td>
                                            <a href="{{ route('noticeadmin.member.view', base64_encode($data->id)) }}"
                                                class="btn btn-info">View&nbsp;
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @if($data->status == "1" && empty($data->re_submit_status))
                                                <a href="{{ route('noticeadmin.member.edit', base64_encode($data->id)) }}"
                                                    class="btn btn-primary">Edit&nbsp;<i class="fa-solid fa-pen"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('print.loanprofile', base64_encode($data->id)) }}"
                                                onclick="return confirm('Are you Sure?')">
                                                <button class="btn btn-secondary"
                                                    type="button">Print&nbsp;<i class="fa-solid fa-print"></i>
                                                </button>
                                        </td>
                                        <td>


                                            @if ($data->loan_close_reason == '1')
                                                <button class="btn btn-danger">Close</button>
                                            @else
                                            @if ($data->re_submit_status == '1')
                                                    <button class="btn btn-danger">Rejected</button>
                                                @else
                                                    @if ($data->status == '0' || $data->status == '1')
                                                        <button class="btn btn-danger">Pending</button>
                                                    @elseif($data->status == "2" || $data->status == "3")
                                                        <button class="btn btn-success">Approve&nbsp;
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    @else

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"
        integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#btn-print').printPage();
        });

        $('#SearchType').change(function() {
            document.getElementById('statusType').submit();

        });

    </script>


@endsection
