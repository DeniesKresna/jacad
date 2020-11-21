<section>
    <div class="block">
        <div class="container">
            <h1>Daftar Jobhun Academy</h1>
            <div class="row">
                <div class="col-8">
                    <form id="form-academy-registration">
                        <div class="row">  
                            <div class="col-12">
                                <span class="pf-title">Kelas</span>
                                <div class="pf-field">
                                    <input type="text" name="academy_name" value="{{ $academy->name }}" disabled>
                                </div>
                            </div> 
                            <div class="col-12">
                                <span class="pf-title">Nama</span>
                                <div class="pf-field">
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="pf-title">Alamat email</span>
                                <div class="pf-field">
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" placeholder="dummy@gmail.com">
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="pf-title">Nomor Whatsapp</span>
                                <div class="pf-field">
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="081234567890">
                                </div>
                            </div>
                            <div class="col-12">
                                <span class="pf-title">Profesimu saat ini</span>
                                <div class="pf-field">
                                    <textarea class="special_ta" name="profession">{{ Auth::user()->profile->desc }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <span class="pf-title">Kamu berasal dari kota mana?</span>
                                <div class="pf-field">
                                    <input type="text" name="domicile" value="{{ Auth::user()->profile->domicile }}" placeholder="Surabaya">
                                </div>
                            </div>
                            <div class="col-12">
                                <span class="pf-title">Dari mana kamu mengetahui Jobhun Academy?</span>
                                <div class="pf-field">
                                    <input type="text" name="jobhun_info" placeholder="Instagram, LinkedIn">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>