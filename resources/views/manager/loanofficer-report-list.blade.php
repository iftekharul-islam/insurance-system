@extends('admin.layout.master')
@section('title', 'Manager Report')
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
                <div class="tile" style="    border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Manager Name</th>
                                    <th>Print</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($officer_list_withloan_report as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>

                                            <td>{{ $item->name }}</td>

                                            <td>
                                                <a href="{{ route('print.officer.loan.report', $item->id) }}"
                                                    onclick="return confirm('Are you Sure?')">
                                                    <button class="btn btn-secondary"
                                                        type="button">Print&nbsp;<i class="fa-solid fa-print"></i>
                                                    </button>
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
    </script>

@endsection
