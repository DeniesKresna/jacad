@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <h1 class="font-weight-bold">Daftar Jobhun Academy</h1>
                <div class="row">
                    <div class="col-8">
                        <form id="form-academy-registration">
                            <div class="row">  
                                <div class="col-12">
                                    <span class="pf-title">Nama</span>
                                    <div class="pf-field">
                                        <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="pf-title">Kelas</span>
                                    <div class="pf-field">
                                        @foreach ($academies as $academy)
                                            <input type="checkbox" name="academies[]" value="{{ $academy->id }}" id="academy_{{ $academy->id }}"> 
                                            <label for="academy_{{ $academy->id }}">{{ $academy->name }}</label> <br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-6">
                                    <span class="pf-title">Alamat email</span>
                                    <div class="pf-field">
                                        <input type="text" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="dummy@gmail.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <span class="pf-title">Nomor Whatsapp</span>
                                    <div class="pf-field">
                                        <input type="text" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" placeholder="081234567890">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="pf-title">Profesimu saat ini</span>
                                    <div class="pf-field">
                                        <textarea class="special_ta" name="description">{{ Auth::check() && Auth::user()->profile ? Auth::user()->profile->description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="pf-title">Kamu berasal dari kota mana?</span>
                                    <div class="pf-field">
                                        <input type="text" name="domicile" value="{{ Auth::check() && Auth::user()->profile ? Auth::user()->profile->domicile : '' }}" placeholder="Surabaya">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="pf-title">Dari mana kamu mengetahui Jobhun Academy?</span>
                                    <div class="pf-field">
                                        <input type="text" name="jobhun_info" placeholder="Instagram, LinkedIn">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Lanjutkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extrajs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-academy-registration').on('submit', function(e) {
            e.preventDefault();

            $('body').loading();
            
            let formData= new FormData($('#form-academy-registration')[0]);
            
            formData.append('period', '{{ $period }}');
            formData.append('redirect_to', '{{ url()->current() }}');
            
            $.ajax({    
                url: `{{ url('/api/v1/user/academy-registrations') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                success: function(response) {
                    console.log(response);

                    $('body').loading('stop');

                    window.location.href= response.redirect_url;

                    /*sswal({ 
                        title: response.message, 
                        icon: 'success'
                    });*/
                },
                error: function(error) {
                    console.log(error);

                    $('body').loading('stop');

                    let message= '';

                    if (error.status === 422) {
                        for (field in error.responseJSON.message) {
                            $(`[name=${field}]`).addClass('error-field');

                            for (error_message of error.responseJSON.message[field]) {
                                message+= `${error_message}\n`;
                            }
                        }
                    } else {
                        message= error.responseJSON.message;
                    }

                    swal({ 
                        title: 'Gagal registrasi!', 
                        text: message,
                        icon: 'error'
                    });
                }   
            });
        });
    </script>
@endsection