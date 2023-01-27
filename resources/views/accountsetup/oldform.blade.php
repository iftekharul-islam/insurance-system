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
                                <th>Enter Account Number</th>
                                <th class="text-center">Due Amount</th>
                                <th class="text-center">Loan Close Reason</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <form action="{{ route('loan.setup.sumbit') }}" method="POST">
                                @csrf
                                <input id="loan_id" type="hidden" value="" name="id">

                                <tr>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <input name="form_number" id="form_number" type="text" class="form-control"
                                                placeholder="Enter Form No.">
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="form-group">
                                            <input name="loan_entry_amount" id="" type="text" class="form-control"
                                                placeholder="Enter Due.">
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="form-group">
                                            <textarea name="loan_close_reason" id=""  class="form-control"
                                                placeholder="Enter Close Reason."></textarea>
                                        </div>
                                    </td>


                                    <td class="text-center">

                                        <a id="loanid" onclick="return" href="">
                                            <button class="btn btn-primary" type="button">View</button>
                                        </a>

                                        <a onclick="return confirm('Are you Sure?')">
                                            <button class="btn btn-primary" type="submit">Send Close Request</button>
                                        </a>

                                    </td>



                                </tr>
                            </form>
                        </tbody>

                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5">

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
                    <div class="col-md-5">

                        <div class="div">
                            <label for="">Account Number:</label>
                            <label id="accountnumber"></label>
                        </div>
                        <div class="div">
                            <label for="">Loan Amount:</label>
                            <span id="loanamount"> </span>
                        </div>

                        <div class="div">
                            <label for="">Due Amount:</label>
                            <span id="dueamount"></span>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <img id="userimage" src="" style="width: 78px;height: 78px;">
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
                url: '<?php echo url('/getForminfoforclose'); ?>',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',

                success: function (result) {



                    // console.log(result[1]);

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
                        $('#userimage').attr("src", ``);
                        $('#accountnumber').empty();
                        $('#loanamount').empty();
                        $('#dueamount').empty();
                    } else {


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
                        $('#userimage').attr("src", `${window.location.origin}/uploads/loan_profile/${duce[0].loan_owner_image}`);

                        $('#accountnumber').append(duce[0].form_id);
                        $('#loanamount').append(duce[0].loan_amount);
                        // $('#dueamount').append(duce[0].loan_entry);
                        $('#dueamount').append(duce[0].loan_amount - duce[0].loan_entry);
                        $('#loanid').attr("href", `http://127.0.0.1:8000/loan-setup/details/${duce[0].id}`);


                    }


                }
            });



            $.ajax({
                url: '<?php echo url('/getForminstallmentforclose'); ?>',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',

                success: function (result) {

                    // console.log(result);

                    var rduce = jQuery.parseJSON(result);
                    if (rduce.length === 0) {
                        $('#InstallmentPaidAmount').empty();
                        $('#InstallmentDueAmount').empty();
                        $('#InstallmentDate').empty();
                    } else {

                        $('#InstallmentPaidAmount').append(rduce.recived_amount);
                        $('#InstallmentDueAmount').append(rduce.due_amount);
                        $('#InstallmentDate').append(`${new Date(rduce.created_at).toISOString().split('T')[0]}`);

                    }
                }
            });


        });
    });


</script>

@endsection
