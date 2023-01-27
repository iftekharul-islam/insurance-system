{{-- @php
   $data = DB::table('site_settings')->get();
@endphp
@foreach($data as $data)
@endforeach --}}
<style type="text/css">
	ul {
    margin: 0px;
    padding: 0px;
}
.footer-section {
  /*background: #008000;*/
  background-image: url("https://cdn.olscafp.org/wp-content/uploads/2013/05/23141845/footer.jpg");
  position: relative;
  padding-top: 4px !important;
}
.footer-cta {
  border-bottom: 1px solid #373636;
}
.single-cta i {
  color: #fff;
  font-size: 30px;
  float: left;
  margin-top: 8px;
}
.cta-text {
  padding-left: 15px;
  display: inline-block;
  margin-bottom: 33px;
}
.cta-text h4 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 2px;
}
.cta-text span {
      color: #ffffff;
    font-size: 14px;
    font-weight: 600;

}
.footer-content {
  position: relative;
  z-index: 2;
}
.footer-pattern img {
  position: absolute;
  top: 0;
  left: 0;
  height: 330px;
  background-size: cover;
  background-position: 100% 100%;
}
.footer-logo {
  margin-bottom: 30px;
}
.footer-logo img {
    max-width: 200px;
}
.footer-text p {
  margin-bottom: 14px;
  font-size: 14px;
      color: #7e7e7e;
  line-height: 28px;
}
.footer-social-icon span {
  color: #fff;
  display: block;
  font-size: 20px;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 20px;
}
.footer-social-icon a {
  color: #fff;
  font-size: 16px;
  margin-right: 15px;
}
.footer-social-icon i {
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 38px;
  border-radius: 50%;
}
.facebook-bg{
  background: #3B5998;
}
.twitter-bg{
  background: #55ACEE;
}
.google-bg{
  background: #DD4B39;
}
.footer-widget-heading h3 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 40px;
  position: relative;
}
.footer-widget-heading h3::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -15px;
  height: 2px;
  width: 50px;
  background: #ff5e14;
}
.footer-widget ul li {
  display: inline-block;
  float: left;
  width: 50%;
  margin-bottom: 12px;
}
.footer-widget ul li a:hover{
  color: #ff5e14;
}
.footer-widget ul li a {
  color: #878787;
  text-transform: capitalize;
}
.subscribe-form {
  position: relative;
  overflow: hidden;
}
.subscribe-form input {
  width: 100%;
  padding: 14px 28px;
  background: #2E2E2E;
  border: 1px solid #2E2E2E;
  color: #fff;
}
.subscribe-form button {
    position: absolute;
    right: 0;
    background: #ff5e14;
    padding: 13px 20px;
    border: 1px solid #ff5e14;
    top: 0;
}
.subscribe-form button i {
  color: #fff;
  font-size: 22px;
  transform: rotate(-6deg);
}
.copyright-area{
  background: #202020;
  padding: 25px 0;
}
.copyright-text p {
  margin: 0;
  font-size: 14px;
  color: #878787;
}
.copyright-text p a{
  color: #ff5e14;
}
.footer-menu li {
  display: inline-block;
  margin-left: 20px;
}
.footer-menu li:hover a{
  color: #ff5e14;
}
.footer-menu li a {
  font-size: 14px;
  color: #878787;
}
iframe{
  width: 100% !important;
  height: 350px !important;
}
</style>

<footer class="footer-section">
        <div class="container">

            <div class="footer-content pt-5 pb-5">

                <div class="row">

                    <div class="col-12 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                        	<div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                {{-- <span>{{$data->email}}</span> --}}
                            </div>
                        </div>
                            <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Helpline Number</h4>
                                {{-- <span>+{{$data->mobile_no}}</span> --}}
                            </div>
                        </div>
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Our Office Address</h4>
                                {{-- <span>{{$data->office_address}}</span> --}}
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 col-md-6 mb-50">
                       {{-- <iframe src="{{$data->map}}"   style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                       <iframe src=""   style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
                <hr style="border: 1px solid #fff;">
                <h5 style="color: #fff;text-align: center;">&copy;&nbsp;Copywright 2022</h5>
            </div>
        </div>

    </footer>





<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('user/js/vendor/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('user/js/jquery.slicknav.min.js')}}"></script>
	<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('user/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('user/js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('user/js/main.js')}}"></script>
