<section>
    <div class="container p-5">
        <div id="aboutJSA"></div>
        <div class="row">
            <div class="col-lg-8">
                <form>
                    <div class="row" id="jsaForm-row">
                        <div class="col-lg-12" id="emailField">
                            <span class="pf-title">E-mail</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="email" id="email_sa" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <span class="pf-title">Nama Lengkap</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Usia</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="age" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Alamat tempat tinggal saat ini</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="address" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Asal Universitas</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="university" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Fakultas</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="faculty" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Jurusan</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="major" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">No. HP/WhatsApp</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="phone" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">ID Line</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="line_id" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Link Profile Instagram (Tidak di-private)</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="ig_url" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="pf-title">Link Profile LinkedIn</span>
                            <div class="pf-field">
                                <input type="text" placeholder="" name="linkedIn_url" />
                            </div>  
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" id="btnNext">Daftar</button>
                            <button type="submit" id="btnBack">Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@section('extrajs')
    <script> 
        let aboutJSA_Content= `
            <h2>
                <strong>Jobhun Student Ambassador</strong>
            </h2>
            <p>Jobhun Student Ambassador adalah sebuah program yang memberikan peluang bagi seluruh mahasiswa di Indonesia untuk bersama-sama menyebarkan awareness terkait pentingnya pengembangan karier dengan memperkenalkan program & layanan Jobhun secara online. Silakan mengisi formulir di bawah ini dengan lengkap ya, Jobhuners!</p>
        `;

        $('#aboutJSA').html(aboutJSA_Content);
        $('#btnBack').hide();
        $('#jsaForm-row').children('div').each(function() {
            let field= $(this);

            if (field.attr('id') === undefined) {
                if (!field.children('button').length) {
                    field.hide();
                }
            }
        });

        $('#btnNext').click(function(e) {
            e.preventDefault();
            
            //AJAX FORM SUBMIT
            if ($('#email_sa').val() === '') {
                swal({ 
                    title: 'Gagal daftar!', 
                    text: 'Untuk lanjut, lengkapi email anda terlebih dahulu ya :)', 
                    icon: 'error'
                });
            } else {
                let formData= new FormData($('form')[0]);

                for (let input of formData.entries()) {
		        	$(`input[name=${input[0]}]`).removeClass('error-field');
				}
                
                //AJAX FORM SUBMIT
                if ($('#btnBack').is(':visible')) {
                    $('body').loading();

                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/api/v1/user/student-ambassadors") }}',
                        data: formData,
                        dataTypes: 'JSON',
                        processData: false,
    			        contentType: false,
                        success: function(response) {
                            console.log(response);

                            $('body').loading('stop');
                            swal({ 
                                title: 'Sukses', 
                                text: response.message, 
                                icon: 'success'
                            });
                        },
                        error: function(error) {
                            console.log(error);

                            if (error.responseJSON.validation_errors) {
                                for (let input in error.responseJSON.validation_errors) {
                                    $(`input[name=${input}]`).addClass('error-field');
                                }
                            }

                            $('body').loading('stop');
                            swal({ 
                                title: 'Gagal', 
                                text: error.responseJSON.message,
                                icon: error.status === 401 ? 'info' : 'error'
                            });
                        }
                    });
                } else {
                    $('#btnBack').show();
                    $('#aboutJSA').html(`
                        <h4>
                            <strong>Isi sesuai data diri kamu ya!</strong>    
                        </h4>
                    `);
                    $('#emailField').hide();
                    $('#jsaForm-row').children('div').each(function() {
                        let field= $(this);

                        if (field.attr('id') === undefined) {
                            field.show();
                        }
                    });
                }
            }
        });

        $('#btnBack').click(function(e) {
            e.preventDefault();

            $('#btnBack').hide();
            $('#aboutJSA').html(aboutJSA_Content);
            $('#emailField').show();
            $('#jsaForm-row').children('div').each(function() {
                let field= $(this);

                if (field.attr('id') === undefined) {
                    if (!field.children('button').length) {
                        field.hide();
                    }
                }
            });
        });
    </script>    
@endsection

