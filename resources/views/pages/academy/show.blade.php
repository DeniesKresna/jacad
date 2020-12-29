@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <div class="d-flex">
                    <img class="img-fluid" src="{{ $academy->image_url }}">
                    <div class="my-auto ml-3">
                        <h1 class="font-weight-bold">Jobhun Academy: {{ $academy->name }}</h1>
                        <h3>Rp {{ number_format($academy->activePeriod->price, 2) }}</h3>
                        <div class="py-2">Kategori: {{ $academy->category }}</div>
                        <div class="py-3">
                            Tag:
                            @foreach ($academy->tags as $key => $tag)
                                @if ($key !== count($academy->tags)-1)
                                    {{ $tag->name }}, 
                                @else
                                    {{ $tag->name }}
                                @endif
                            @endforeach
                        </div>
                        <div class="py-1">
                            <a href="{{ url('/academies/registration') }}" class="btn btn-success">DAFTAR</a>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    {!! $academy->description !!}
                </div>

                <div class="mt-5">
                    <h4 class="font-weight-bold">Mentor yang akan mengajar</h4>
                    <div class="mx-auto">
                        @foreach ($academy->activePeriod->mentors as $mentor)
                            <div>{{ $mentor->name }}</div>
                         @endforeach
                    </div>
                </div>

                <div class="mt-5">
                    <h4 class="font-weight-bold">Apakah kamu tertarik?</h4>
                    <p>mengikuti kelas pada jadwal di atas? Tenang saja, kelas ini akan rutin diadakan. Daftarkan dirimu pada formulir di bawah ini, jika kelas sudah tersedia kembali maka kami akan memberitahumu!</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <span class="pf-title font-weight-bold">Nama</span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="pf-title font-weight-bold">Email</span>
                                        <div class="pf-field">
                                            <input type="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="pf-title font-weight-bold">Nomor HP</span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Nomor HP">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">Kirim</button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection