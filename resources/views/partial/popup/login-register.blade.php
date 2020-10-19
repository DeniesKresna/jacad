<!-- LOGIN POPUP -->
<div class="account-popup-area signin-popup-box">
	<div class="account-popup">
		<span class="close-popup">
            <i class="la la-close"></i>
        </span>
		<h3>Masuk dulu yuk!</h3>
        <span>Lengkapi kolom di bawah ini dengan nama pengguna/alamat email dan kata sandimu</span>
        
		{{-- <div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
        </div> --}}
        
		<form id="formLogin" {{-- action="{{ url('/').'/api/v1/login' }}" method="POST" --}}>
			<div class="cfield">
				<input type="text" placeholder="Nama pengguna" name="username"/>
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="Kata sandi" name="password"/>
				<i class="la la-key"></i>
			</div>
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
			</p>
			<a href="#" title="">Lupa kata sandi</a>
			<button type="submit" id="btnLogin">Masuk</button>
        </form>
        
		<!--<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
                <a class="google-login" href="{{ url('/socialite-redirect/google') }}" title="">
                    <i class="fa fa-google"></i>
                </a>
				<a class="fb-login" href="{{ url('/socialite-redirect/facebook') }}" title="">
                    <i class="fa fa-facebook"></i>
                </a>
			</div>-->
		</div>
	</div>
</div>
<!-- LOGIN POPUP -->

<!-- SIGNUP POPUP -->
<div class="account-popup-area signup-popup-box">
	<div class="account-popup">
		<span class="close-popup">
            <i class="la la-close"></i>
        </span>
        <h3 style="line-height: inherit">Daftar sebagai pengguna dulu ya!</h3>
        
		{{-- <div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div> --}}
        
        <form id="formRegister" {{-- action="{{ url('/').'/api/v1/register' }}" method="POST" --}}>
            <div class="cfield">
				<input type="text" placeholder="Nama lengkap" name="name"/>
				<i class="la la-name"></i>
			</div>
            <div class="cfield">
				<input type="text" placeholder="Nama pengguna" name="username"/>
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="Kata sandi" name="password"/>
				<i class="la la-key"></i>
            </div>
            <div class="cfield">
				<input type="password" placeholder="Konfirmasi kata sandi" name="password_confirmation"/>
				<i class="la la-key"></i>
			</div>
			<div class="cfield">
				<input type="email" placeholder="Alamat email" name="email"/>
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
				<input type="text" placeholder="Nomor handphone" name="phone"/>
				<i class="la la-phone"></i>
			</div>
			<button type="submit" id="btnRegister">Daftar</button>
        </form>
        
		<!--<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="tw-login" href="#" title="">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="fb-login" href="#" title="">
                    <i class="fa fa-facebook"></i>
                </a>
			</div>
		</div>-->
	</div>
</div>
<!-- SIGNUP POPUP -->

<script>
    //LOGIN
    $('#btnLogin').click(function(e) {
        e.preventDefault();

        let formData= new FormData($('#formLogin')[0]);

        $('body').loading();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ url('/') }}" + '/api/v1/login',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(response) {
                swal({ 
                    title: 'Login success!', 
                    text: '', 
                    icon: "success" 
                });

                $('body').loading('stop');

                return window.location.href= BASE_URL;
                
                //BUAT SESSION USER SEMENTARA
                /*$.ajax({
                    type: 'POST',
                    url: "{{ url('/') }}" + '/session-user',
                    data: response1.user,
                    dataType: 'JSON',
                    success: function(response2) {
                        swal({ 
                            title: 'Login success!', 
                            text: '', 
                            icon: "success" 
                        });

                        $('body').loading('stop');

                        return window.location.href= BASE_URL;
                    }
                });*/
            },
            error: function(error) {
                console.log(error);

                let msg= '';
                
                if (error.status == 422) {
                    //ERROR MESSAGE SEMENTARA
                    Object.keys(error.responseJSON.messages)
                          .forEach(key => msg+= error.responseJSON.messages[key][0]+'\n');
                } else if (error.status == 404) {
                    msg= error.responseJSON.messages;
                }
                
                swal({ 
                    title: 'Login failed!', 
                    text: msg, 
                    icon: "error" 
                });

                $('body').loading('stop');
            } 
        });
    });

    //REGISTER
    $('#btnRegister').click(function(e) {
        e.preventDefault();
        
        let formData = new FormData($('#formRegister')[0]);
        
        $('body').loading();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: 'POST',
            url: "{{ url('/') }}" + '/api/v1/register',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                
                $('body').loading('stop');

                swal({ 
                    title: 'Verify your account!', 
                    text: 'Check your e-mail to verify your account', 
                    icon: "info" 
                });
            },
            error: function(error) {

                if (error.status === 422) {
                    let msg= '';

                    //ERROR MESSAGE SEMENTARA
                    Object.keys(error.responseJSON.messages)
                          .forEach(key => msg+= error.responseJSON.messages[key][0]+'\n');

                    swal({ 
                        title: 'Registration failed!', 
                        text: msg, 
                        icon: "error" 
                    });

                    $('body').loading('stop');
                }
            }
        });
    });
</script>  