@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <h2 class="font-weight-bold">{{ $ask_career->mentor->name }} - {{ $ask_career->name }}</h2>
                <div class="d-flex">
                    <img class="img-fluid" src="{{ $ask_career->mentor->image_url }}" width="400">
                    <div class="ml-4 my-auto">
                        {!! $ask_career->schedule !!}
                        <span class="font-weight-bold">Tarif mentoring per jam: </span> Rp{{ number_format(strval($ask_career->price), 2) }}
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="font-weight-bold">Detail mentor</h2>
                    {!! $ask_career->mentor->description !!}
                </div> 
            </div>

            @include('pages.ask-career.registration')
        </div>
    </section>
@endsection

@section('extrajs')
    <script>
        $('#form-mentoring-registration').on('submit', function(e) {
            e.preventDefault(); 
            $('body').loading();

            let formData= new FormData($('#form-mentoring-registration')[0]);

            for (input of formData.entries()) {
                $(`[name=${input[0]}]`).removeClass('error-field');
            }

            formData.set('mentoring_types', JSON.stringify($('.chosen').val()));
            formData.append('ask_career_id', '{{ $ask_career->id }}');
            
            $.ajax({
                type: 'POST',
                url: '{{ url("/api/v1/user/mentoring") }}',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);

                    $('body').loading('stop');
                    swal({ 
                        title: 'Sukses',
                        text: response.message,
                        icon: 'success' 
                    });
                },
                error: function (error) {
                    console.log(error);
                    
                    if (error.responseJSON.validation_errors) {
                        for (input in error.responseJSON.validation_errors) {
                            $(`[name=${input}]`).addClass('error-field');
                        }
                    }

                    $('body').loading('stop');
                    swal({ 
                        title: 'Gagal', 
                        text: error.responseJSON.message, 
                        icon: 'error' 
                    });
                }
            });
        });
    </script>
@endsection