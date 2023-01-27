@extends('admin.layout.master')
@section('title', 'Site Settings')
@section('content')



    <main class="app-content">
        @foreach ($data as $data)
        @endforeach
        <div class="row">

            <div class="col-md-12">
                <div class="tile" style="border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <h3 class="tile-title">Site Settings</h3>

                    <div class="tile-body">
                        <form class="row" action="{{ route('site.settings') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <img src="{{ asset('uploads/logo/') . '/' . $data->site_logo }}" style="    width: 75px;height: 49px;margin-left: 17px;border: 1px solid;padding: 4px;}">

                            <div class="form-group col-md-12">
                                <label class="control-label">Site Logo</label>
                                <input type="file" name="site_logo" class="form-control">
                                @error('site_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>




                            <img src="{{ asset('uploads/logo/') . '/' . $data->home_logo }}" style="width: 75px;height: 49px;margin-left: 17px;border: 1px solid;padding: 4px;}">

                            <div class="form-group col-md-12">
                                <label class="control-label">Home Page Logo</label>
                                <input type="file" name="home_logo" class="form-control">
                                @error('home_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <img src="{{ asset('uploads/logo/') . '/' . $data->printing_logo }}" style="width: 75px;height: 49px;margin-left: 17px;border: 1px solid;padding: 4px;}">

                            <div class="form-group col-md-12">
                                <label class="control-label">Printing Logo</label>
                                <input type="file" name="printing_logo" class="form-control">
                                @error('printing_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <img src="{{ asset('uploads/logo/') . '/' . $data->favicon }}" style="width: 75px;height: 49px;margin-left: 17px;border: 1px solid;padding: 4px;}">

                            <div class="form-group col-md-12">
                                <label class="control-label">Favicon Icon</label>
                                <input type="file" name="favicon" class="form-control">
                                @error('favicon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>





                            <img style="display: none" src="{{ asset('uploads/logo/') . '/' . $data->fb_page_img }}" style="    width: 82px;height: 95px;margin-left: 17px;border: 1px solid;padding: 4px;">

                            <div class="form-group col-md-12" style="display: none">
                                <label class="control-label">Facebook Page Image</label>
                                <input type="file" name="fb_page_img" class="form-control">
                                @error('fb_page_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="hidden" name="chk_img" value="{{ $data->site_logo }}">
                            </div>

                            {{-- <div class="form-group col-md-12">
                                <label class="control-label">Facebook Link</label>
                                <input type="text" name="fb_link" class="form-control @error('fb_link') is-invalid @enderror" placeholder="Facebook Social Link" autocomplete="off" value="{{ $data->fb_link }}">
                                @error('fb_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Instagram Link</label>
                                <input type="text" name="insta_link" class="form-control @error('insta_link') is-invalid @enderror" placeholder="Instagram Social Link" autocomplete="off" value="{{ $data->insta_link }}">
                                @error('insta_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Twitter Link</label>
                                <input type="text" name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" placeholder="Twitter Social Link" autocomplete="off" value="{{ $data->twitter_link }}">
                                @error('twitter_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Linkdin Link</label>
                                <input type="text" name="linkdin_link" class="form-control @error('linkdin_link') is-invalid @enderror" placeholder="Twitter Social Link" autocomplete="off" value="{{ $data->linkdin_link }}">
                                @error('linkdin_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group col-md-12">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Mobile No" autocomplete="off" value="{{ $data->mobile_no }}">
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="off" value="{{ $data->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Office Address</label>
                                <input type="text" name="office_address" class="form-control @error('office_address') is-invalid @enderror" placeholder="Office Address" autocomplete="off" value="{{ $data->office_address }}">
                                @error('office_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Map</label>
                                <textarea class="form-control" name="map" placeholder="Map" style="    height: 97px;">{{ $data->map }}</textarea>
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">SMS 1 Entry -  {amount} , {date}, {form_id}</label>
                                <div>
                                    <input type="checkbox" name="sms1_is_enable" {{ $data->sms1_is_enable == 1  ?"checked='checked'" : ""}} /> Enable
                                </div>
                                <textarea class="form-control" name="sms1" placeholder="Congratulations, Dear BFSS-Ltd, deposit balance of account {form_id}, of {amount}৳ on {date}" style="    height: 97px;">{{ $data->sms1 }}</textarea>
                                @error('sms1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-12">
                                <label class="control-label">SMS on Approve -  {amount} , {date}</label>
                                <div>
                                    <input type="checkbox" name="sms2_is_enable" {{ $data->sms2_is_enable == 1 ? "checked='checked'" : ""}} />  Enable
                                </div>
                                <textarea class="form-control" name="sms2" placeholder="Congratulations, Dear BFSS-Ltd, Your loan successfully approved of {amount}৳ on {date}" style="    height: 97px;">{{ $data->sms2 }}</textarea>
                                @error('sms2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4 align-self-end">
                                <input type="Submit" name="submit" id="submit" class="btn btn-primary"  value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
