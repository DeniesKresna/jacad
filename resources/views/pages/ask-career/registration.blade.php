<div class="container mt-5">
    <h2 class="font-weight-bold">Daftar mentoring di Jobhun Ask Career</h2>
    <div class="row">
        <div class="col-lg-8">
            <form id="form-mentoring-registration">
                <div class="row">
                    <div class="col-12">
                        <span class="pf-title">Mentor</span>
                        <div class="pf-field">
                            <input type="text" name="mentor_name" value="{{ $ask_career->mentor->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Nama lengkap</span>
                        <div class="pf-field">
                            <input type="text" name="name" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Alamat email</span>
                        <div class="pf-field">
                            <input type="text" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Nomor WhatsApp</span>
                        <div class="pf-field">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Kamu berasal dari kota mana?</span>
                        <div class="pf-field">
                            <input type="text" name="domicile" value="{{ Auth::user()->profile->domicile }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Apa profesimu saat ini?</span>
                        <div class="pf-field">
                            <input type="text" name="description" value="{{ Auth::user()->profile->description }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="pf-title">Jenis pembahasan apa yang ingin kamu dapatkan dari mentor?</span>
                        <div class="pf-field">
                            <select data-placeholder="Bisa pilih lebih dari satu" class="chosen" name="mentoring_types" multiple>
                                <option value="teori">Teori</option>
                                <option value="study_case">Study case</option>
                                <option value="karier">Karier</option>
                                <option value="tools">Tools</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="pf-title">Jelaskan secara spesifik topik/pembahasan apa saja yang ingin kamu pelajari dari mentor?</span>
                        <div class="pf-field">
                            <textarea class="special_ta" name="spesific_topic"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Pengajuan tanggal mentoring</span>
                        <div class="pf-field">
                            <input type="text" name="date">
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Pengajuan waktu mentoring</span>
                        <div class="pf-field">
                            <input type="text" name="time">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="pf-title">Berapa lama durasi mentoring yang kamu inginkan?</span>
                        <div class="pf-field">
                            <select data-placeholder="Pilih salah satu" class="chosen" name="duration">
                                <option selected>1 jam</option>
                                <option>2 jam</option>
                                <option>3 jam</option>
                                <option>Lebih dari 3 jam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="pf-title">Dari mana kamu mengetahui Jobhun?</span>
                        <div class="pf-field">
                            <input type="text" name="jobhun_info">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>