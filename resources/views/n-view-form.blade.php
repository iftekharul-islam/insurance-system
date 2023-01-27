@extends('admin.layout.master')
@section('title', 'Member Profile')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .tile {
                overflow-x: scroll;
            }
        }

        .tile {
            border-top: 3px solid #009688;
            border-radius: 13px 13px 0px 0px;
        }

        h4 {
            background: #ffe1e1;
            padding: 4px;
            font-size: 17px;
        }
    </style>
    <main class="app-content">


        <div class="row">
            <div class="col-md-12">
                <div class="tile">


                    @if ($data->rejected_reason)
                        <!---Success Message--->
                        <div class="alert alert-danger">
                            <li>{{ $data->rejected_reason }}</li>
                        </div>
                        <!---Error Message--->
                    @endif


                    <div class="tile-body">
                        <h4>Loan Customer Information :</h4>
                        <table class="table table-hover table-bordered">

                            <thead>
                                <tr>
                                    <th>Name of loan customer</th>
                                    <th>{{ $data->name }}</th>
                                    <th>Customer photo</th>
                                    <td>
                                        <img src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_image }}"
                                            style="width: 67px;">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone Number </th>
                                    <td>{{ $data->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>ID Card Number </th>
                                    <th>{{ $data->loan_owner_card_no }}</th>
                                    <th>ID Card Photo</th>
                                    <td>
                                        <img src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_id_card }}"
                                            style="    width: 70px;height: 60px;">
                                        <img src="{{ asset('uploads/loan_profile/') . '/' . $data->loan_owner_id_bk_img }}"
                                            style="    width: 70px;height: 60px;">

                                    </td>
                                </tr>
                                <tr>
                                    <th>Father's name</th>
                                    <td>{{ $data->fathers_name }}</td>
                                    <th>Mother's name</th>
                                    <td>{{ $data->mothers_name }}</td>
                                </tr>

                                <tr>

                                    <th>Date of Birth</th>
                                    <td>{{ $data->day }}-Day</td>
                                    <td>{{ $data->month }}-Month</td>
                                    <td>{{ $data->year }}-Year</td>
                                </tr>

                                <tr>

                                    @php
                                        $zela = preg_replace('/\d/', '', $data->loan_owner_zila);
                                    @endphp

                                    @php
                                        $upazela = preg_replace('/\d/', '', $data->loan_owner_upazila);
                                    @endphp

                                    @php
                                        $union = preg_replace('/\d/', '', $data->loan_owner_union);
                                    @endphp


                                    <th>Permanent Address</th>
                                    <td>District&nbsp;{{ $zela }}</td>
                                    <td>Thana / Upazila&nbsp;{{ $upazela }}</td>
                                    <td>Union&nbsp;{{ $union }}</td>
                                </tr>


                                <tr>

                                    <th>Post office</th>
                                    <td>{{ $data->loan_owner_pincode }}</td>
                                    <th>Village </th>
                                    <td>{{ $data->loan_owner_gram }}</td>

                                </tr>

                                <tr>

                                    <th>Branch </th>
                                    <td>{{ $data->loan_owner_branch }}</td>
                                    <th>Loan Ammount </th>
                                    <td style="font-weight: 800;">{{ $data->loan_amount }} ৳</td>

                                </tr>



                            </thead>


                        </table>


                        <h4>Granter's Information No. 1 :</h4>
                        <table class="table table-hover table-bordered">


                            <tr>
                                <th>Granter Name</th>
                                <th>{{ $data->granter_name }}</th>
                                <th>Granter Photo</th>
                                <td>
                                    <img src="{{ asset('uploads/loan_profile/') . '/' . $data->granter_image }}"
                                        style="width: 79px;
    height: 79px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Granter Phone Number</th>
                                <td>{{ $data->granter_mobile }}</td>
                                <th>ID Card Number </th>
                                <th>{{ $data->granter_id_card_no }}</th>

                            </tr>
                            <tr>
                                <th>Father's name</th>
                                <td>{{ $data->granter_fathers_name }}</td>
                                <th>Mother's name</th>
                                <td>{{ $data->granter_mothers_name }}</td>
                            </tr>

                            <tr>

                                <th>Date of Birth</th>
                                <td>{{ $data->granter_day }}-Day</td>
                                <td>{{ $data->granter_month }}-Month</td>
                                <td>{{ $data->granter_year }}-Year</td>
                            </tr>

                            <tr>

                                @php
                                    $granterzela = preg_replace('/\d/', '', $data->granter_zila);
                                @endphp

                                @php
                                    $granterupazela = preg_replace('/\d/', '', $data->granter_upazila);
                                @endphp

                                @php
                                    $granterunion = preg_replace('/\d/', '', $data->granter_union);
                                @endphp

                                <th>Permanent Address</th>
                                <td>District&nbsp;{{ $granterzela }}</td>
                                <td>Thana / Upazila&nbsp;{{ $granterupazela }}</td>
                                <td>Union&nbsp;{{ $granterunion }}</td>
                            </tr>


                            <tr>

                                <th>Post office</th>
                                <td>{{ $data->granter_pincode }}</td>
                                <th>Village </th>
                                <td>{{ $data->granter_gram }}</td>

                            </tr>




                        </table>

                        <!-------------------------Granter 2 information------------------->
                        <h4>Granter's Information No. 2 :</h4>
                        <table class="table table-hover table-bordered">


                            <tr>
                                <th>Granter Name</th>
                                <td>{{ $data->granter_2_name }}</td>
                                <th>Granter Photo</th>
                                <td>
                                    <img src="{{ asset('uploads/loan_profile/') . '/' . $data->granter__2_image }}"
                                        style="width: 79px;
    height: 79px;;">
                                </td>
                            </tr>
                            <tr>
                                <th>Granter Phone Number</th>
                                <td>{{ $data->granter_2_id_card_no }}</td>
                                <th>ID Card Number </th>
                                <th>{{ $data->granter_id_card_no }}</th>

                            </tr>
                            <tr>
                                <th>Father's name</th>
                                <td>{{ $data->granter_2_fathers_name }}</td>
                                <th>Mother's name</th>
                                <td>{{ $data->granter_mothers_name }}</td>
                            </tr>

                            <tr>

                                <th>Date of Birth</th>
                                <td>{{ $data->granter_2_day }}-Day</td>
                                <td>{{ $data->granter_2_month }}-Month</td>
                                <td>{{ $data->granter_2_year }}-Year</td>
                            </tr>

                            <tr>
                                @php
                                    $granterzela2 = preg_replace('/\d/', '', $data->granter_2_zila);
                                @endphp
                                @php
                                    $granterupazela2 = preg_replace('/\d/', '', $data->granter_2_upazila);
                                @endphp
                                @php
                                    $granterunion2 = preg_replace('/\d/', '', $data->granter_2_union);
                                @endphp
                                <th>Permanent Address</th>
                                <td>District&nbsp;{{ $granterzela2 }}</td>
                                <td>Thana / Upazila&nbsp;{{ $granterupazela2 }}</td>
                                <td>Union&nbsp;{{ $granterunion2 }}</td>
                            </tr>
                            <tr>
                                <th>Post office</th>
                                <td>{{ $data->granter_2_pincode }}</td>
                                <th>Village </th>
                                <td>{{ $data->granter_2_gram }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
