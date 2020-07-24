@extends('user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('extracss')
	<link rel="stylesheet" type="text/css" href="{{ asset('jqte/jquery-te-1.4.0.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('extrajs')
	<script src="{{ asset('jqte/jquery-te-1.4.0.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    
	<script>
		$( document ).ready(function() {
		    $(".special_ta").jqte();
		    $(".datepicker").datepicker({
			      format: 'yyyy-mm-dd',
			      autoclose: true,
			      todayHighlight: true,
			});
            
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

            //LOGO COMPANY
		    $("#logo").change(function(e) {
		    	var reader = new FileReader();
			    reader.onload = function (e) {
			        document.getElementById("logo-img").src = e.target.result;
			    };
			    reader.readAsDataURL(this.files[0]);
		    });

            //AJAX GET DATA COMPANY - AUTO INPUT
		    $("#company_name").focusout(function(){
		    	if ($("#company_name").val().length > 2){
		    		$('body').loading();
		    		$.ajax({
			            type:'GET',
			            url: "{{url('/')}}" + '/api/v1/user/companies/name/' + $("#company_name").val(),
			            dataType: 'JSON',
			            success: function(data) {
                            var company = data.company;
                            $('body').loading('stop');
                            $('#jobForm input, #jobForm select').each(
                                function(index){  
                                    let input = $(this);
                                    for (let prop in company){
                                        if (input.attr('name') == prop) {
                                            input.val(company[prop]);
                                        }
                                    }
                                }
                            );
                            $('#jobForm textarea').each(
                                function(index){  
                                    let input = $(this);
                                    for (let prop in company){
                                        if(input.attr('name') == prop){
                                            input.html(company[prop]);
                                        }
                                    }
                                }
                            );
                            $('#logo-img').attr('src',company.logo_url);
                        },
			            error: function(error) {
			           	    $('body').loading('stop');
			            }
			        });
		        }
		    });
            
            //AJAX FORM SUBMIT   
		    $("#btnSubmit").click(function(e){
		        e.preventDefault();

		        var formData = new FormData($('form')[0]);

		        formData.set('logo', $("#logo").prop('files')[0]);
                formData.set('sector_ids', $('.chosen').val());
                
		        for (var pair of formData.entries()) {
		        	let iptDom = document.getElementsByName(pair[0])[0];
		           	iptDom.style.backgroundColor = "white";
				}

		        $.ajax({
		            type: 'POST',
		            url: "{{url('/')}}" + '/api/v1/user/jobs',
		            data: formData,
		            dataType: 'JSON',
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
		           	    if (error.status === 422){
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
			});
		});
	</script>
@endsection

@section('content')	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
                            
					 		<div class="profile-title">
					 		    <h3>Post a New Job</h3>
                            </div>
                            
                            <!-- FORM -->
					 		<div class="profile-form-edit">
					 			<form id="jobForm" {{-- action="{{ url('api/v1/user/jobs') }}" method="POST" --}} enctype="multipart/form-data">
					 				<div class="row">
					 					<div class="col-lg-12">
					 						<span class="pf-title">Nama Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="PT CAHAYA ABADI" name="name" id="company_name" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Tagline Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Lampu baru/bekas, tetap berkualitas" name="tagline"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Informasi tentang Perusahaan</span>
					 						<div class="pf-field">
					 							<textarea name="information">Kami adalah produsen lampu merek Shikotsa dan telah aktif dalam bisnis perlampuan selama lebih dari 9 dekade. Pabrik dan kantor utama kami terletak di Semarang, Jawa Tengah, Indonesia.Kami memiliki karyawan yang berdedikasi, yang bekerja untuk memenuhi tuntutan pelanggan lokal maupun pelanggan internasional kami. ......</textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Alamat Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Jl. Pemuda No.148, Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50132" name="address" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Logo Perusahaan</span>
							 				<span><img src="http://placehold.it/160x138" alt="" width="160" id="logo-img" /></span>
							 				<div class="upload-info">
							 					<input type="file" name="logo" id="logo" accept="image/x-png,image/jpeg" />
							 					<span>Max ukuran file adalah 1MB dan extensi file adalah .jpg atau .png</span>
							 				</div>
							 			</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Web Site</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="cahayaabadi.xyz" name="site_url" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Telepon</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="081357006012" name="phone" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Surel</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="career@cahayaabadi.xyz" name="email" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Jumlah Karyawan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="50-100 orang" name="employee_amount" />
					 						</div>
					 					</div>
					 					<hr>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Posisi yang dicari</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Designer Web" name="position" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bidang Pekerjaan</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Bisa pilih lebih dari satu" class="chosen" name="sector_ids" multiple>
													<option value="1">Designer</option>
													<option value="2">Programmer</option>
													<option value="3">Marketing</option>
													<option value="4">Human Resource</option>
													<option value="5">Accounting</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Jenis Pekerjaan</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Pilih salah satu" class="chosen" name="type">
													<option selected>Full Time</option>
													<option>Part Time</option>
													<option>Freelance</option>
													<option>Internship</option>
													<option>Volunteer</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Deskripsi Pekerjaan</span>
					 						<div class="pf-field">
					 							<textarea class="special_ta" name="job_desc"><p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p></textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Lokasi Pekerjaan</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Pilih salah satu" class="chosen" name="location_id">
													<option value="1">Jakarta</option>
													<option value="2">Surabaya</option>
													<option value="3">Yogyakarta</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Waktu bekerja</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="8 s/d 5 WIB" name="work_time" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Gaya Berpakaian</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Resmi" name="dress_style" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bahasa yang digunakan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Bahasa Indonesia" name="language" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Tunjangan/Fasilitas</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Jamsostek, BPJS Kesehatan" name="facility" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Besar Gaji</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="3 - 4 juta" name="salary" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Cara mengirimkan Lamaran</span>
					 						<div class="pf-field">
					 							<textarea name="how_to_send">Email atau dikirim lewat Pos ke alamat kami</textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Batas waktu melamar</span>
					 						<div class="pf-field">
					 							<input type="text" class="datepicker" name="expired" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Waktu proses rekrut</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="2 hari kerja" name="process_time" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Dari mana mengetahui Jobhun</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Iklan Instagram dan Facebook" name="jobhun_info" />
					 						</div>
					 					</div>
					 					{{--
					 					<div class="col-lg-12">
					 						{!! NoCaptcha::renderJs() !!}
                    						{!! NoCaptcha::display() !!}
										</div>
										--}}
					 					<div class="col-lg-12">
					 						<button type="submit" id="btnSubmit">Simpan</button>
					 					</div>
					 				</div>
					 			</form>
                             </div>
                             
                             <!-- FORM -->
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>
@endsection
