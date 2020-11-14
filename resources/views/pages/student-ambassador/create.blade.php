<section>
    <div class="container p-5" id="">
        <div id="aboutJSA"></div>
        
        <!-- FORM -->
        <form>
            <div class="row" id="jsaForm-row">
                <div class="col-lg-12" id="emailField">
                    <span class="pf-title">E-mail</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="email" id="sa_email"/>
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Nama Lengkap</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="name" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Usia</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="age" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Alamat tempat tinggal saat ini</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="address" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Asal Universitas</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="university" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Fakultas</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="faculty" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Jurusan</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="major" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">No. HP/WhatsApp</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="phone" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">ID Line</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="line_id" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Link Profile Instagram (Tidak di-private)</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="ig_link" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <span class="pf-title">Link Profile LinkedIn</span>
                    <div class="pf-field">
                        <input type="text" placeholder="" name="linkedin_link" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" id="btnNext">Next</button>
                    <button type="submit" id="btnBack">Back</button>
                </div>
            </div>
        </form>
        <!-- FORM -->
    </div>
</section>

@section('extrajs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        
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
            if ($('#sa_email').val() === '') {
                swal({ 
                    title: 'Validation Error', 
                    text: 'Required e-mail field', 
                    icon: 'error'
                });
            } else {
                let formData= new FormData($('form')[0]);

                for (let pair of formData.entries()) {
		        	let iptDom = document.getElementsByName(pair[0])[0];
		           	iptDom.style.backgroundColor = "white";
				}
                
                //AJAX FORM SUBMIT
                if ($('#btnBack').is(':visible')) {
                    $.ajax({
                        type: 'POST',
                        url: `{{ url('/api/v1/user/student-ambassadors') }}`,
                        data: formData,
                        dataTypes: 'JSON',
                        processData: false,
    			        contentType: false,
                        success: function(response) {
                            swal({ 
                                title: 'Create success!', 
                                text: "", 
                                icon: "success" 
                            });
                        },
                        error: function(error) {
                            if (error.status === 422) {
                                let msg = "";
                                
                                for (let prop in error.responseJSON.message){
                                    let iptDom = document.getElementsByName(prop)[0];
                                    iptDom.style.backgroundColor = "yellow";
                                    //msg = msg + error.responseJSON.message[prop][0] + "\n";
                                }
                                
                                swal({ 
                                    title: 'Validation Error', 
                                    text: "check the yellow background inputs", 
                                    icon: "error" 
                                });
                            }
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

