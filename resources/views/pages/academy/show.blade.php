@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <div class="d-flex">
                    <img class="img-fluid" src="{{ $academy->image_url }}" width="40%">
                    <div class="px-3">
                        <h1>Jobhun Academy: {{ $academy->name }}</h1>
                        <h3>Rp{{ number_format(strval($academy->price), 2) }}</h3>
                        <div class="py-1">SKU: {{ $academy->sku }}</div>
                        <div class="py-1">Kategori: {{ $academy->category }}</div>
                        <div class="py-1">
                            Tag:
                            @foreach ($academy->tags as $key => $tag)
                                @if ($key !== count($academy->tags)-1)
                                    {{ $tag->name }}, 
                                @else
                                    {{ $tag->name }}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pages.academy.registration')
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
            formData.append('batch', '{{ $academy->batch }}');
            formData.append('academy_id', '{{ $academy->id }}');

            $.ajax({
                url: `{{ url('/api/v1/user/academy-registrants') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                success: function(response) {
                    $('body').loading('stop');

                    swal({ 
                        title: 'Pendaftaran berhasil!', 
                        text: response.message  , 
                        icon: "success" 
                    });
                },
                error: function(error) {
                    $('body').loading('stop');

                    if (error.status === 400) {
                        swal({ 
                            title: 'Pendaftaran gagal!', 
                            text: error.responseJSON, 
                            icon: "error" 
                        });
                    }
                }   
            });
        });
    </script>
@endsection