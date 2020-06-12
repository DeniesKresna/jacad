@extends('user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('extracss')
	<link rel="stylesheet" type="text/css" href="{{asset('jqte/jquery-te-1.4.0.css')}}" />
@endsection

@section('extrajs')
	<script src="{{asset('jqte/jquery-te-1.4.0.min.js')}}" type="text/javascript"></script>

	<script>
		$( document ).ready(function() {
		    $(".special_ta").jqte();
		});
	</script>
@endsection

@section('content')	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	<div class="col-lg-12 column">
				 		<div class="padding-left">
					 		<div class="profile-title">
					 			<h3>Formulir Jobhun Career Hub Reguler</h3>
					 		</div>
					 		<div class="profile-form-edit">
					 			<form>
					 				<div class="row">
					 					<div class="col-lg-12">
					 						<span class="pf-title">Nama Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="CV SINDIKAT KREASI DIGITAL" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Tagline Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Indonesia Maju" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Informasi Perusahaan</span>
					 						<div class="pf-field">
					 							<textarea class="common_ta">Spent several years working on sheep on Wall Street. Had moderate success investing in Yugos on Wall Street. Managed a small team buying and selling pogo sticks for farmers. Spent several years licensing licorice in West Palm Beach, FL. Developed severalnew methods for working with banjos in the aftermarket. Spent a weekend importing banjos in West Palm Beach, FL.In this position, the Software Engineer ollaborates with Evention's Development team to continuously enhance our current software solutions as well as create new solutions to eliminate the back-office operations and management challenges present</textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Alamat Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="Jl. Ratna no 14, Ngagel, Surabaya" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Website Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="https://www.jobhun.id/" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Email Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Telepon Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Jenis Pekerjaan</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Please Select Specialism" class="chosen">
													<option>Full Time</option>
													<option>Part Time</option>
													<option>Freelance</option>
													<option>Internship</option>
													<option>Volunteer</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Posisi-posisi dicari</span>
					 						<div class="pf-field">
						 						<ul class="tags">
										           <li class="addedTag">Web UI Designer<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Web Deisgn"></li>
							            			<li class="tagAdd taglist">  
							              				 <input type="text" id="search-field">
										            </li>
												</ul>
											</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Deskripsi Pekerjaan</span>
					 						<div class="pf-field">
					 							<textarea class="special_ta">{!! '<p>Tulis deskripsi pekerjaan di dalam sini. selengkap-lengkapnya</p><p>Pekerjaan yang akan dilakukan :</p><p>Syarat dan Kualifikasi :</p><p>Kemampuan dan kompetensi harus dimiliki :</p>' !!}</textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Lokasi</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Please Select Specialism" class="chosen">
													<option>Jakarta</option>
													<option>Surabaya</option>
													<option>Bandung</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Gaya Berpakaian</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bahasa yang digunakan</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Tunjangan Fasilitas</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Besar Gaji</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Waktu Proses Rekrut</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Cara Kirim Lamaran</span>
					 						<div class="pf-field">
					 							<textarea class="special_ta"><p>kirim melalui email</p></textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Batas Waktu Lamaran</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="01.11.207" class="form-control datepicker" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Unggah Poster</span>
					 						<div class="pf-field">
					 							<input type="file" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bukti Transfer</span>
					 						<div class="pf-field">
					 							<input type="file" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Logo Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="file" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Dari mana tahu Jobhun</span>
					 						<div class="pf-field">
					 							<input type="text" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<button type="submit">Submit</button>
					 					</div>
					 				</div>
					 			</form>
					 		</div>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>
@endsection
