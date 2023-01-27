@extends('admin.layout.master')
@section('title', 'Create Notice')
@section('content')
    <style>
        @media only screen and (max-width: 600px) {
            .tile {
                overflow-x: scroll;
            }
        }
    </style>
    <main class="app-content">


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile" style="    border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Notice Name</th>
                                    <th>Notice Type</th>
                                    <th>Action</th>

                                </tr>
                            </thead>


                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->notice }}</td>
                                    <td>
                                        @if ($data->notice_type == 0)
                                            New
                                        @else
                                            Important
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('notice.edit', $data->id) }}">
                                            <button class="btn btn-info" type="button">Edit&nbsp;
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </a>
                                        <a
                                            href="{{ route('notice.delete', $data->id) }}"onclick="return confirm('Are you Sure?')">
                                            <button class="btn btn-danger" type="button">Delete&nbsp;
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </a>
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



@endsection
