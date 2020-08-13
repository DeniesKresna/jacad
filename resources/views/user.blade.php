
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
	@include('partial.maincss')
	@yield('extracss')
	
</head>
<body>
<!--
<div class="page-loading">
	<img src="images/loader.gif" alt="" />
	<span>Skip Loader</span>
</div>-->

<div class="theme-layout" id="scrollup">
	
	@include('partial.menu')

	@yield('banner')

	@yield('content')

	@include('partial.footer')

</div>

<!-- LOGIN POPUP -->
<div class="account-popup-area signin-popup-box">
	<div class="account-popup">
		<span class="close-popup">
            <i class="la la-close"></i>
        </span>
		<h3>User Login</h3>
        <span>Click To Login With Demo User</span>
        
		{{-- <div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
        </div> --}}
        
		<form id="login-form" {{-- action="login" method="POST" --}}>
			<div class="cfield">
				<input type="text" placeholder="Username" name="username"/>
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="********" name="password"/>
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
</div>
<!-- LOGIN POPUP -->

<!-- SIGNUP POPUP -->
<div class="account-popup-area signup-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
        <h3>Sign Up</h3>
        
		{{-- <div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div> --}}
        
        <form id="register-form" {{-- action="register" method="POST" --}}>
            <div class="cfield">
				<input type="text" placeholder="Name" name="name"/>
				<i class="la la-name"></i>
			</div>
            <div class="cfield">
				<input type="text" placeholder="Username" name="username"/>
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="Password" name="password"/>
				<i class="la la-key"></i>
            </div>
            <div class="cfield">
				<input type="password" placeholder="Confirm - Password" name="password_confirmation"/>
				<i class="la la-key"></i>
			</div>
			<div class="cfield">
				<input type="email" placeholder="Email" name="email"/>
				<i class="la la-envelope-o"></i>
            </div>
			{{-- <div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen">
					<option>Web Development</option>
					<option>Web Designing</option>
					<option>Art & Culture</option>
					<option>Reading & Writing</option>
				</select>
			</div> --}}
			<div class="cfield">
				<input type="text" placeholder="Phone Number" name="phone"/>
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
</div>
<!-- SIGNUP POPUP -->

@include('partial.mainjs')
@yield('extrajs')

</body>
</html>

