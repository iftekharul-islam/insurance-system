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
                        <h1>Amount Received Form</h1>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Entry Amount</th>
                                <th>Remarks</th>
                                <th>Submit</th>
                            </tr>
                            </thead>

                            <tbody>
                            <form action="{{ route('loan.amount.entry') }}" method="POST">
                                @csrf
                                <input id="loan_id" type="hidden" value="" name="id">

                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input name="form_number" id="form_number" type="text" class="form-control"
                                                   placeholder="Enter Form No.">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input id="" type="text" class="form-control" name="loan_entry_amount"
                                                   placeholder="Enter Recived Amount">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <input id="" type="text" class="form-control" name="remarks"
                                                   placeholder="Remarks">
                                        </div>
                                    </td>

                                    <td>
                                        <a onclick="return confirm('Are you Sure?')">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </a>
                                    </td>

                                </tr>
                            </form>
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10">

                            <div class="div">
                                <label for="">Name:</label>
                                <label id="nameofuser"></label>
                            </div>
                            <div class="div">
                                <label for="">Father Name:</label>
                                <span id="fathername"> </span>
                            </div>

                            <div class="div">
                                <label for="">Mobile Number:</label>
                                <span id="mobile"></span>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <img id="userimage" src="" style="width: 78px;height: 78px;">

                        </div>
                    </div>


                    <h1 class="my-4">Loan Installment</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Total Installment</th>
                                    <th scope="col">Left Installment</th>
                                    <th scope="col">Installment Paid Amount</th>
                                    <th scope="col">Installment Due Amount</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody id="loaninstallment">
                                <tr>
                                    <td id="TotalInstallment"></td>
                                    <td id="LeftInstallment">
                                        @php

                                            @endphp

                                    </td>
                                    <td id="InstallmentPaidAmount"></td>
                                    <td id="InstallmentDueAmount"></td>
                                    <td id="InstallmentDate"></td>
                                </tr>
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
                    url: '<?php echo url('/getForminfo'); ?>',
                    type: 'post',
                    data: 'did=' + did + '&_token={{ csrf_token() }}',

                    success: function (result) {



                        // console.log(result[1]);

                        var duce = jQuery.parseJSON(result);
                        $('#customer_name').html("Name...");
                        $('#loan_amount').html("Amount...");
                        $('#due_Amount').html("Due Amount...");
                        $("#nameofuser").empty();
                        $("#fathername").empty();
                        $("#mobile").empty();
                        $('#userimage').empty();
                        $('#loan_id').val(0);
                        $('#userimage').attr("src", ``);
                        $('#TotalInstallment').empty();

                        if (duce.length != 0) {
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
                            // $('#remarks').append(duce[0].remarks);
                            $('#TotalInstallment').append(duce[0].loanInstallment);
                            $('#userimage').attr("src", `${window.location.origin}/uploads/loan_profile/${duce[0].loan_owner_image}`);
                        }


                    }
                });



                $.ajax({
                    url: '<?php echo url('/getForminstallment-data'); ?>',
                    type: 'post',
                    data: 'did=' + did + '&_token={{ csrf_token() }}',

                    success: function (rduce) {
                        console.log(rduce)
                        $('#InstallmentPaidAmount').empty();
                        $('#InstallmentDueAmount').empty();
                        $('#InstallmentDate').empty();
                        $('#LeftInstallment').empty();

                        if (rduce.length != 0) {
                            $('#LeftInstallment').append(rduce.remaining);
                            $('#InstallmentPaidAmount').append(rduce.paid);
                            $('#InstallmentDueAmount').append(rduce.due);
                            $('#InstallmentDate').append(rduce.date);

                        }
                    }
                });


            });
        });





        // `<tr><td>
        //     ${element.recived_amount}</td>
        //     <td>${element.due_amount}</td>
        //     <td>${element.remarks?element.remarks:''}</td>
        //     <td>${new Date(element.created_at).toISOString().split('T')[0]}</td>
        //     <td>
        //         <a href='/editloanamount' class='btn btn primary'>
        //                                ${((new Date(element.created_at).toISOString().split('T')[0])==(new Date().toISOString().split('T')[0]))?'Edit':'' }</a></td></tr>`




    </script>

@endsection
