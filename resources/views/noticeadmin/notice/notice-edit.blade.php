@extends('admin.layout.master')
@section('title', 'Edit Notice')
@section('content')

    <main class="app-content">
        <h3>Notice Edit</h3>
        <hr />
        <div class="row">

            <div class="col-md-12">
                <div class="tile">
                    <!---Success Message--->

                    <!---Error Message--->

                    <div class="tile-body">
                        <form method="post" action="{{ route('notice.edit',$data->id) }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-12">
                                <label class="control-label">Add Notice</label>
                                <input required="" class="form-control" name="notice" value="{{ $data->notice }}" id="category"
                                    type="text" placeholder="Update Notice">
                                @if ($errors->has('notice'))
                                    <div class="text-danger">{{ $errors->first('notice') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Notice Description</label>
                                <textarea  class="form-control" name="notice_dec" id="" cols="30" rows="5">{{ $data->notice_dec }}</textarea>
                                @if ($errors->has('notice_dec'))
                                    <div class="text-danger">{{ $errors->first('notice_dec') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">Notice Validati</label>
                                <input  class="form-control" name="notice_validati" id="category"
                                type="date" placeholder="Add Validati">
                                @if ($errors->has('notice_validati'))
                                    <div class="text-danger">{{ $errors->first('notice_validati') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label" style="font-weight:bold;">Notice Status:&nbsp;
                                    <sup style="color:red">*</sup>
                                </label>
                                <select  class="form-control" name="noticestatus">
                                    <option value="{{ $data->noticestatus }}">{{ $data->noticestatus }}</option>
                                    <option value="important">Important</option>
                                    <option value="new">New</option>
                                    <option value="hot">Hot</option>
                                </select>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">Upload Pdf</label>
                                <input  class="form-control" type="file" name="notice_pdf">
                                @if ($errors->has('notice_pdf'))
                                    <div class="text-danger">{{ $errors->first('notice_pdf') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4 align-self-end">

                                <button class="btn" type="submit" style="background:#009688;color:#fff;">
                                    Update&nbsp;
                                    <i
                                        class="fa-solid fa-pencil"></i>
                                    </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>



@endsection
