
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Jobhunt</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="CreativeLayers">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/bootstrap-grid.css')}}" />
	<link rel="stylesheet" href="{{asset('theme/jobhun/css/icons.css')}}">
	<link rel="stylesheet" href="{{asset('theme/jobhun/css/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/chosen.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/colors/colors.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('theme/jobhun/css/bootstrap.css')}}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	
</head>
<body>
<!--
<div class="page-loading">
	<img src="images/loader.gif" alt="" />
	<span>Skip Loader</span>
</div>-->

<div class="theme-layout" id="scrollup">
	
	@include('partial.menu')

	@include('partial.header.blog')

	@yield('content')

	@include('partial.footer')

</div>

<div class="account-popup-area signin-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>User Login</h3>
		<span>Click To Login With Demo User</span>
		<div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div>
		<form>
			<div class="cfield">
				<input type="text" placeholder="Username" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="********" />
				<i class="la la-key"></i>
			</div>
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
			</p>
			<a href="#" title="">Forgot Password?</a>
			<button type="submit">Login</button>
		</form>
		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- LOGIN POPUP -->

<div class="account-popup-area signup-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>Sign Up</h3>
		<div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div>
		<form>
			<div class="cfield">
				<input type="text" placeholder="Username" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="********" />
				<i class="la la-key"></i>
			</div>
			<div class="cfield">
				<input type="text" placeholder="Email" />
				<i class="la la-envelope-o"></i>
			</div>
			<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen">
					<option>Web Development</option>
					<option>Web Designing</option>
					<option>Art & Culture</option>
					<option>Reading & Writing</option>
				</select>
			</div>
			<div class="cfield">
				<input type="text" placeholder="Phone Number" />
				<i class="la la-phone"></i>
			</div>
			<button type="submit">Signup</button>
		</form>
		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- SIGNUP POPUP -->

<script src="{{asset('theme/jobhun/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/script.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/wow.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/slick.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/parallax.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/select-chosen.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/jobhun/js/jquery.scrollbar.min.js')}}" type="text/javascript"></script>

</body>
</html>

