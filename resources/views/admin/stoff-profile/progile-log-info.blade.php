@extends('admin.layout.master')
@section('title', 'Officer Profile')
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
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>User Name : </th>
                                    <th>User IP Address : </th>
                                    <th>User Login Country : </th>
                                    <th>User Device : </th>
                                    <th>User Broeser Name : </th>
                                    <th>User Oparating System :</th>
                                    <th>Last Login Time : </th>
                                </tr>
                                <tr>
                                    <th>
                                        @if ($user_info->name)
                                            {{ $user_info->name }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->user_ip))
                                            {{ $loginfo->user_ip }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->login_country))
                                            {{ $loginfo->login_country }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->device))
                                            {{ $loginfo->device }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->user_browser))
                                            {{ $loginfo->user_browser }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->user_os))
                                            {{ $loginfo->user_os }}
                                        @endif
                                    </th>
                                    <th>
                                        @if (!empty($loginfo->last_login_time))
                                            {{ $loginfo->last_login_time }}
                                        @endif
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script></script>



@endsection
