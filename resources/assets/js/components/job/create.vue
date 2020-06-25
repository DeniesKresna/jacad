<template>
							<form @submit.prevent="storeData">
					 				<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
					 				<div class="row">
					 					<div class="col-lg-12">
					 						<span class="pf-title">Nama Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.name" placeholder="CV SINDIKAT KREASI DIGITAL" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Tagline Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.tagline" placeholder="Indonesia Maju" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Informasi Perusahaan</span>
					 						<div class="pf-field">
					 							<vue-editor :editorToolbar="editorToolbar" v-model="data.company.information"></vue-editor>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Alamat Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.address" placeholder="Jl. Ratna no 14, Ngagel, Surabaya" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Website Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.site_url" placeholder="https://www.jobhun.id/" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Email Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.email" placeholder="jobhun@gmail.com"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Telepon Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.company.phone" placeholder="081357000007"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Jenis Pekerjaan</span>
					 						<div class="pf-field">
					 							<select v-model="data.type" data-placeholder="Please Select Specialism" class="chosen">
													<option>Full Time</option>
													<option>Part Time</option>
													<option>Freelance</option>
													<option>Internship</option>
													<option>Volunteer</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Posisi dicari</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.position" placeholder="UI/UX Web Designer"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Deskripsi Pekerjaan</span>
					 						<div class="pf-field">
					 							<vue-editor :editorToolbar="editorToolbar" v-model="data.content"></vue-editor>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Lokasi</span>
					 						<div class="pf-field">
					 							<select data-placeholder="Please Select Specialism" class="chosen" v-model="location_id">
													<option v-for="location in locations" :value="locations.id">{{location.name}}</option>
												</select>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Gaya Berpakaian</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.dress_style" placeholder="Casual"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bahasa yang digunakan</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.language" placeholder="Bahasa Indonesia"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Tunjangan Fasilitas</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.facility" placeholder="BPJS Kesehatan, Ketenagakerjaan, THR"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Besar Gaji</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.salary" placeholder="2.000.000 - 4.000.000"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Waktu Proses Rekrut</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.process_time" placeholder="5 hari"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">Cara Kirim Lamaran</span>
					 						<div class="pf-field">
					 							<input type="text" v-model="data.how_to_send" placeholder="lewat email ke jobhun@gmail.com"/>
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<span class="pf-title">expired</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="01.11.207" class="form-control datepicker" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Unggah Poster</span>
					 						<div class="pf-field">
					 							<input type="file" ref="poster" @change="handlePosterUpload" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Bukti Transfer</span>
					 						<div class="pf-field">
					 							<input type="file" ref="transfer" @change="handleTransferUpload" />
					 						</div>
					 					</div>
					 					<div class="col-lg-6">
					 						<span class="pf-title">Logo Perusahaan</span>
					 						<div class="pf-field">
					 							<input type="file" ref="logo" @change="handleLogoUpload" />
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
</template>
<script>
export default{
	data(){
		this.data: {
			company:{}
		}
	},
	mounted(){
		this.data.information = "<p>Tulis deskripsi pekerjaan di dalam sini. selengkap-lengkapnya</p><p>Pekerjaan yang akan dilakukan :</p><p>Syarat dan Kualifikasi :</p><p>Kemampuan dan kompetensi harus dimiliki :</p>";
	},
	methods:{
		handlePosterUpload(){
	        this.data.poster = this.$refs.poster.files[0];
	    },
	    handleTransferUpload(){
	        this.data.transfer = this.$refs.transfer.files[0];
	    },
	    handleLogoUpload(){
	        this.data.logo = this.$refs.logo.files[0];
	    },
	    storeData(){
	        this.$store.dispatch('job/STORE', this.data).then(response=>{
	          this.data = {title: '', content: "", categories_objects: [], categories: [], file: null};
	          this.$refs.file.value = "";
	        });
	     }
	}
}
</script>
