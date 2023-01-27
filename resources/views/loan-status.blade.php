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
            <div class="tile" style="border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                <div class="tile-body">
                    <h1>Account Status</h1>
                    <form method="POST" action="{{ route('get.status') }}">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group" style="line-height: 34px;margin-top: 10px;">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="control-label" style="font-weight:bold;">
                                                Requested Account Number
                                                :&nbsp;<sup style="color:red">*</sup>
                                            </label>

                                        </div>
                                        <div class="col-8">
                                            <input name="form_number" id="form_number" type="text" class="form-control"
                                                placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="form-group" style="margin-top: 10px;">
                                    <a href="{{ route('loan.status') }}" class="btn btn-primary">Clear</a>
                                    <button type="submit" class="btn btn-primary" type="submit">Request Send</button>
                                </div>

                            </div>

                        </div>
                    </form>


                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>A/C No.</th>
                                    <th>A/C Name</th>
                                    <th>Requested By</th>
                                    <th>Requested Date</th>

                                    <th>Initial Check</th>
                                    <th>Initial Remark</th>
                                    <th>Initial Check By</th>
                                    <th>Initial Check Date</th>

                                    <th>Varification Check</th>
                                    <th>Varification Remark</th>
                                    <th>Verify By</th>
                                    <th>Verify Date</th>

                                    <th>Final Check</th>
                                    <th>Final Check By</th>
                                    <th>Final Check Date</th>
                                    <th>Final Remark</th>
                                    <th>A/C Present Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @if (!empty($loan_status))
                                    <tr>
                                        <td>
                                            {{ $loan_status->form_id }}
                                        </td>
                                        <td id="customer_name">{{ $loan_status->name }}</td>
                                        <td id="loan_amount">{{ $this_loan_officer }}</td>
                                        <td id="due_Amount">{{ \Carbon\Carbon::parse($loan_status->created_at)->format('d/m/Y')  }}</td>
                                        <td>
                                            @if($loan_status->status == '1' || $loan_status->status == '2' || $loan_status->status == '3')
                                                Complated
                                            @endif
                                        </td>


                                        <th>
                                            {{ $loan_status->manager_rejected_reason }}
                                        </th>


                                        <th>

                                        @if($loan_status->status == '1' || $loan_status->status == '2' || $loan_status->status == '3')
                                                 {{ $this_loan_manager }}
                                            @endif
                                        </th>

                                        <th>
                                            @if (empty($loan_status->manager_aceck_date))

                                            @else
                                                {{ \Carbon\Carbon::parse($loan_status->manager_aceck_date)->format('d/m/Y') }}
                                            @endif
                                        </th>

                                        <th class="text-center">
                                            @if($loan_status->status == '2' || $loan_status->status == '3')
                                                Verifyed
                                            @endif
                                        </th>

                                        <td>
                                            {{ $loan_status->notice_admin_rejected_reason }}
                                        </td>


                                        <th>

                                            @if($loan_status->status == '2' || $loan_status->status == '3')
                                                {{ $notice_admin }}
                                            @endif


                                        </th>

                                        <th>
                                            @if (empty($loan_status->noticeadmin_check_date))

                                            @else
                                                {{ \Carbon\Carbon::parse($loan_status->noticeadmin_check_date)->format('d/m/Y') }}
                                            @endif
                                        </th>
                                        <th>
                                            @if($loan_status->status == '3')
                                                    Approved
                                            @endif
                                        </th>

                                        <th>
                                            @if($loan_status->status == '3')
                                                {{ $super_admin }}
                                            @endif
                                        </th>
                                        <th>
                                            @if (empty($loan_status->admin_check_date))

                                            @else
                                                {{ \Carbon\Carbon::parse($loan_status->admin_check_date)->format('d/m/Y') }}
                                            @endif
                                        </th>
                                        <td>

                                            {{ $loan_status->super_admin_rejected_reason }}

                                        </td>

                                        <td>
                                            @if($loan_status->loan_close_reason == '1')
                                            
                                                Close
                                             @else
                                                 @if ($loan_status->status == '3')
                                                    Active
                                                @else
                                                @endif
                                            @endif
                                            
                                            
                                        </td>

                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="100" class="text-center">
                                            <p>No Data Found</p>
                                        </td>
                                    </tr>
                                @endif


                            </tbody>

                        </table>
                      </div>



                </div>

            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    $(document).ready(function () {
        $('#form_number').keyup(function () {
            let did = $(this).val();
            $.ajax({
                url: '<?php echo url(' / getForminfo '); ?>',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',

                success: function (result) {
                    var duce = jQuery.parseJSON(result);
                    if (duce.length === 0) {
                        $('#customer_name').html("Name...");
                        $('#loan_amount').html("Amount...");
                        $('#due_Amount').html("Due Amount...");
                        $("#nameofuser").empty();
                        $("#fathername").empty();
                        $("#mobile").empty();
                        $('#userimage').empty();
                        $('#loan_id').val(0);
                        $('#userimage').attr("src", ``)
                    } else {
                        // console.log('')
                        $("#nameofuser").empty();
                        $("#fathername").empty();
                        $("#mobile").empty();
                        $('#customer_name').html(duce[0].name);
                        $('#loan_amount').html(duce[0].loan_amount);
                        $('#due_Amount').html(duce[0].loan_amount - duce[0].loan_entry);
                        $('#loan_id').val(duce[0].id);
                        $('#nameofuser').append(duce[0].name);
                        $('#fathername').append(duce[0].fathers_name);
                        $('#mobile').append(duce[0].mobile);
                        $('#remarks').append(duce[0].remarks);
                        $('#userimage').attr("src",
                            `${window.location.origin}/uploads/loan_profile/${duce[0].loan_owner_image}`
                            );
                    }
                }
            });

            $.ajax({
                url: '<?php echo url(' / home / loan - officer / getForminstallment /
                    loan '); ?>',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',

                success: function (result) {
                    var e = jQuery.parseJSON(result);
                    if (e.length === 0) {
                        $("#loaninstallment").empty();
                    } else {
                        $("#loaninstallment").empty();
                        e.forEach(element => {
                            $("#loaninstallment").append(
                                `<tr><td>${element.recived_amount}</td><td>${element.due_amount}</td><td>${element.remarks?element.remarks:''}</td><td>${new Date(element.created_at).toISOString().split('T')[0]}</td><td><a href='/editloanamount' class='btn btn primary'>
                                   ${((new Date(element.created_at).toISOString().split('T')[0])==(new Date().toISOString().split('T')[0]))?'Edit':'' }</a></td></tr>`
                                )
                        });
                    }
                }
            });
        });
    });

</script>

@endsection
