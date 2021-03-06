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
        
		<form id="login-form">
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
			<button type="submit">Masuk</button>
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
        
        <form id="register-form">
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
			<button type="submit">Daftar</button>
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
    $(document).ready(function() {
        //LOGIN
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            $('body').loading();

            let formData= new FormData($('#login-form')[0]);

            for (input of formData.entries()) {
                $(`#login-form input[name=${input[0]}]`).removeClass('error-field');
            }
            
            $.ajax({
                type: 'POST',
                url: `{{ url('/api/v1/user/auth/login') }}`,
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);

                    $('body').loading('stop');
                    
                    swal({
                        title: 'Berhasil masuk!',
                        text: response.message, 
                        icon: 'success' 
                    });

                    window.location.href= response.base_url;
                },
                error: function(error) {
                    console.log(error);

                    $('body').loading('stop');

                    if (error.responseJSON.errors) {
                        for (input in error.responseJSON.errors) {
                            $(`#login-form input[name=${input}]`).addClass('error-field');
                        }
                    }
                    
                    swal({
                        title: 'Gagal masuk!', 
                        text: error.responseJSON.message, 
                        icon: error.status === 401 ? 'info' : 'error' 
                    })
                } 
            });
        });

        //REGISTER
        $('#register-form').on('submit', function(e) {
            e.preventDefault();
            $('body').loading();
            $('#register-form button').prop('disabled', true);

            let formData = new FormData($('#register-form')[0]);

            for (input of formData.entries()) {
                $(`#register-form input[name=${input[0]}]`).removeClass('error-field');
            }

            $.ajax({
                type: 'POST',
                url: `{{ url('/api/v1/user/auth/register') }}`,
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);

                    $('body').loading('stop');
                    $('#register-form button').prop('disabled', false);

                    for (field of formData.entries()) {
                        $(`#register-form input[name=${field[0]}]`).val('');
                    }

                    swal({
                        title: 'Berhasil daftar!', 
                        text: response.message,  
                        icon: 'info' 
                    });
                },
                error: function(error) {
                    console.log(error);

                    $('body').loading('stop');
                    $('#register-form button').prop('disabled', false);

                    if (error.responseJSON.errors) {
                        for (input in error.responseJSON.errors) {
                            $(`#register-form input[name=${input}]`).addClass('error-field');
                        }
                    }

                    swal({ 
                        title: 'Gagal daftar!', 
                        text: error.responseJSON.message, 
                        icon: error.status === 401 ? 'info' : 'error'
                    });
                }
            });
        });
    });
</script>  