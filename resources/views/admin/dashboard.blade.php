@extends('admin.layout.master')
@section('title', 'Notice')
@section('content')

    <main class="app-content">


        <h3>All Notice</h3>
        <hr />

        <div class="card">
            <div class="card-header">
                Notice
            </div>
            <div class="card-body">


                @foreach ($data as $data)
                    <blockquote class="blockquote mb-3">
                        <footer class="blockquote-footer">
                            <cite title="Source Title" class="text-info">
                                <i class="fa-solid fa-calendar-days"></i>
                                Published Date : <span>{{  \Carbon\Carbon::parse($data->created_at)->format('d-M-Y') }}</span>
                            </cite>
                            <cite title="Source Title"></cite>
                        </footer>
                        <cite title="" style="text-align: center">
                            <h5>{{ $data->notice }}</h5>
                        </cite>
                        <p class="mt-2">
                            {{ $data->notice_dec }}
                        </p>

                        <footer class="blockquote-footer">
                            <cite title="Source Title" class="text-info">File Name: <span
                                    class="text-black">notic-file.pdf</span></cite>
                            <cite title="Source Title">
                                @if (!empty($data->notice_pdf))
                                    <a href="{{ asset('uploads/pdf/') . '/' . $data->notice_pdf }}" download="" class="btn btn-primary btn-sm">Download</a>
                                @endif
                            </cite>
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>





    </main>



@endsection
