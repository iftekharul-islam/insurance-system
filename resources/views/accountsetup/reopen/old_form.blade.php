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
                        <form action="{{ route('loan.editform') }}" method="POST">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Enter User ID</th>

                                </tr>
                            </thead>

                            <tbody>

                                    @csrf

                                    <tr>

                                        <td>
                                            <div class="form-group">
                                                <input id="" type="text" class="form-control"
                                                    name="id" placeholder="Enter User id">
                                            </div>
                                        </td>

                                    </tr>


                            </tbody>


                        </table>
                        <button type="submit">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



@endsection
