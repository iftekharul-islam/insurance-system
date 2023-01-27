<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<!-- Stylesheets -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/nice-select.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/magnific-popup.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/slicknav.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/animate.css')}}"/>
	<link rel="stylesheet" href="{{asset('user/css/loader.css')}}"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{asset('user/css/style.css')}}"/>
	<style type="text/css">
		/*.header-info{
			margin-right: 20px !important;
    		padding: 8px 0 !important;
		}*/
		#footer-box{
			width: 100%;
			height: 600px;
			background: red;
		}
		/*body{*/
		/*    background-image: url({{asset('bg.jpg')}});*/
		/*   background-repeat: no-repeat;*/
  /*          background-size: cover;*/
  /*          height: 20px !important;*/
		/*}*/
		/*@media only screen and (max-width: 600px) {*/
  /*        body {*/
  /*           background-image: url({{asset('bg.jpg')}});*/
		/*   background-repeat: no-repeat;*/
  /*          background-size: cover;*/
  /*          height: 300vh !important;*/
  /*        } */
  /*      }*/
	</style>
	
</head>
<body >
<!-- Preloader -->
		<div id="preloader">
			<div id="container" class="container-preloader">
				<div class="animation-preloader">
					<div class="spinner"></div>
					<div class="txt-loading">
						<span preloader-text="L" class="characters">L</span>
						
						<span preloader-text="O" class="characters">O</span>
						
						<span preloader-text="A" class="characters">A</span>
						
						<span preloader-text="D" class="characters">D</span>
						
						<span preloader-text="I" class="characters">I</span>
						
						<span preloader-text="N" class="characters">N</span>
						
						<span preloader-text="G" class="characters">G</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>	
	@include('user.layouts.header')
	@yield('content')
	@include('user.layouts.footer')


	<script type="text/javascript">
		$(document).ready(function() {
  setTimeout(function() {
    $('#container').addClass('loaded');
    // Once the container has finished, the scroll appears
    if ($('#container').hasClass('loaded')) {
      // It is so that once the container is gone, the entire preloader section is deleted
      $('#preloader').delay(2000).queue(function() {
        $(this).remove();
      });}
  }, 3000);});

	</script>
</body>
</html>