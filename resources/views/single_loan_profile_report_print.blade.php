<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <style>
        /* reset */
        @media print {
            #date-submit {
                display: none
            }
            .datep::-webkit-inner-spin-button,
            .datep::-webkit-calendar-picker-indicator{
                display: none;
                -webkit-appearance: none;
            }
            .datep {
                -webkit-appearance: none;
                appearance: none;
                font-weight: bold;
                margin-right: -10px;
            }
        }
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* content editable */

        *[contenteditable] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[contenteditable] {
            cursor: pointer;
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        td:hover *[contenteditable],
        td:focus *[contenteditable],
        img.hover {
            background: #DEF;
            box-shadow: 0 0 1em 0.5em #DEF;
        }

        span[contenteditable] {
            display: inline-block;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        /* header */

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }





        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }

        .add:hover {
            background: #00ADEE;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }

    </style>


    <style>
        .row {
            display: -ms-flexbox !important;
            display: flex !important;
            margin-right: -15px !important;
            margin-left: -15px !important;
            flex-wrap: unset !important;
        }

        .col {}

        .col-1 {
            width: 8.333333%;
        }

        .col-2 {
            width: 16.666667%;
        }

        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 33.333333%;
        }

        .col-5 {
            width: 41.666667%;
        }

        .col-6 {
            width: 50%;
        }

        .col-7 {
            width: 58.333333%;
        }

        .col-8 {
            width: 66.666667%;
        }

        .col-9 {
            width: 75%;
        }

        .col-10 {
            width: 83.333333%;
        }

        .col-11 {
            width: 91.666667%;
        }

        .col-12 {
            width: 100%;
        }


        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            flex: unset !important;
            max-width: unset !important;
        }


        .data_deader {}

        .data_deader .header_data_box {
            border: 1px solid #000;
            margin-right: 1px;
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .data_deader .header_data_box span{
            font-weight: 600;
        }

        .data_row {}

        .data_row .data_row_box {
            border: 1px solid #000;
            margin-right: 1px;
            border-top: 0;
        }

        .paper_body {

            box-sizing: border-box;
            /* height: 11in; */
            margin: 0 auto;
            overflow: hidden;
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);

            /* padding: 0.5in;
            width: 8.5in; */
            width: 9in;
            padding: 0.5in;


        }

        .paper_content {
            background: #fff;
            /* padding-left: 40px;
    padding-right: 40px; */
        }

        .account_info_box{
            border: 2px solid #000;
            margin-bottom: 25px;
            padding: 15px 0px;
        }
        .account_info_box p {
            margin-bottom: 0;
            margin: 12px 0;
            font-size: 13px;
        }
        .account_info_box p strong {}
        .account_info_box p span {}

        header .statement_header {}
        header .statement_header p {
            margin: 0;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 1px;
        }
        header .statement_header p span {
            margin-right: 5px
        }

    </style>
</head>



<body class="paper_body">
    <div id="menu">
        {{-- <button target="_blank" id="print" class="btn btn-primary">Download / Print</button> --}}
        <a target="_blank" id="print" class="btn btn-primary">Download / Print</a>
        {{-- <button onclick="CreatePDFfromHTML()" class="btn btn-danger">Download PDF</button> --}}
    </div>
    <br>



    <div class="html-content paper_content">
        <header>

            <div class="row statement_header">
                <div class="col-5">
                    <p>
                        <span>Help Line : </span> 09638654171
                    </p>
                    <p>
                        <span>Phone : </span>09638654171
                    </p>
                    <p>
                        <span>Email : </span>helloworld@gmail.com
                    </p>
                    <p>
                        {{ settings()->office_address }}
                    </p>

                    <p>
                        Kashipur bazar, Howladar Market 1st(Flor)
                        Bauphal, Patuakhali
                    </p>
                    {{-- <p>{{ settings()->mobile_no }}</p> --}}
                </div>
                <div class="col-2">
                    {{-- <img class="w-100" src="{{ asset('uploads/logo') }}/{{ settings()->site_logo }}" alt=""> --}}
                    <img class="w-100" src="{{ asset('uploads/logo/') . '/' . settings()->printing_logo }}" alt="Logo">
                </div>
                <div class="col-5 text-right">
                    <p>
                        @php
                            $dateTime = \Carbon\Carbon::now();
                            echo $dateTime->format("d/m/Y  H:i:s A");
                        @endphp
                    </p>
                    <p>
                        <span>User : </span>{{ auth()->user()->name }}
                    </p>
                </div>
            </div>

        </header>





        <div class="row text-center">
            <div class="col-12 d-flex justify-content-center align-items-center" style="margin-bottom: 10px">
                <h6 style="font-weight: 700;margin:0;">Account Statment For The Period:&nbsp;&nbsp;</h6>
                <form action="" method="get" class="d-flex">
                    <input type="date" name="from_date" class="datep" value="{{ $from_date }}">
                    <b>to</b> &nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="to_date" class="datep" value="{{ $to_date }}">
                    <input type="submit" class="btn btn-primary" id="date-submit" />
                </form>
            </div>
        </div>


        <div class="row account_info_box">
            <div class="col-6">

                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Account Number:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                {{ $data->form_id }}
                            </span>
                        </p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Account Title:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                {{ $data->name }}
                            </span>
                        </p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Account Type:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                {{ $data->installmentType }}
                            </span>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-6">

                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Open Date:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Currency:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                BDT-Bangladeshi Taka
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>
                            <strong>
                                Address:
                            </strong>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>
                            <span>
                                <span>
                                    @php
                                        $loan_owner_zila = explode(':', $data->loan_owner_zila);
                                        $zila = end($loan_owner_zila);

                                        $loan_owner_upazila = explode(':', $data->loan_owner_upazila);
                                        $upazila = end($loan_owner_upazila);

                                        $loan_owner_union = explode(':', $data->loan_owner_union);
                                        $union = end($loan_owner_union);
                                    @endphp
                                    {{ $union }},{{ $upazila }},{{ $zila }}
                                </span>
                            </span>
                        </p>
                    </div>
                </div>

            </div>
        </div>



        <!-- Tran H. -->
        <div class="row data_deader">
            <div class="col-2 text-left header_data_box">
                <span>Trans Date</span>
            </div>
            <div class="col-4 text-center header_data_box">
                <span>Remark</span>
            </div>
            <div class="col-2 text-center header_data_box">
                <span>Loan Amount</span>
            </div>
            <div class="col-2 text-center header_data_box">
                <span>Entry Amount</span>
            </div>
            <div class="col-2 text-center header_data_box">
                <span>Due Amount</span>
            </div>
        </div>


        @foreach ($recived_history as $single)
            <div class="row data_row">
                <div class="col-2 data_row_box">
                    <span>{{ \Carbon\Carbon::parse($single->created_at)->format('d/m/Y') }}</span>
                </div>
                <div class="col-4 data_row_box">
                    <span>{{ $single->loanInstallment_remarks }}</span>
                </div>
                <div class="col-2 text-center data_row_box">
                    <span>৳&nbsp;{{ $data->loan_amount }}</span>
                </div>
                <div class="col-2 text-center data_row_box">
                    <span>৳&nbsp;{{ $single->recived_amount }}</span>
                </div>
                <div class="col-2 text-center data_row_box">
                    <span>৳&nbsp;{{ $single->due_amount }}</span>
                </div>
            </div>
        @endforeach

        <aside>
            <h1 style="float:right;margin-top: 180px;"><span>Authorized Signature</span></h1>
        </aside>


        <div id="editor"></div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script>
        $("body").on("click", "#pdf_make", function () {
            html2canvas($('#print_area')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("International Travel House Ltd.pdf");
                }
            });
        });

        $("#print").click(function () {
            //alert("jj");
            $("#menu").css("display", "none");
            //Hide all other elements other than printarea.
            $("#print_area").show();
            window.print();

            //alert("hello");
        });

        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        function CreatePDFfromHTML() {
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($(".html-content")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width,
                    canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4),
                        canvas_image_width, canvas_image_height);
                }
                pdf.save("single_Vistor.pdf");
                //$(".html-content").hide();

            });


        }

    </script>
</body>

</html>
