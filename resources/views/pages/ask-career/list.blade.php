@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Pilih mentor disini!</h2>
                </div>
                @if (count($ask_careers) > 0)
                    <div class="row">
                        <div class="col-lg-9">
                            @foreach ($ask_careers as $ask_career)
                                <a href="{{ $ask_career->mentor->url }}">
                                    @include('components.ask-career', [
                                        'ask_career' => $ask_career,
                                        'schedule' => $ask_career->schedule,
                                        'css' => [
                                            'col' => 'col-12',
                                            'py' => 'py-2'
                                        ]
                                    ])
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="pagination">
                    <ul>
                        <li class="prev">
                            <a href="">
                                <i class="la la-long-arrow-left"></i> Sebelumnya
                            </a>
                        </li>
                        <li>
                            <a href="">1</a>
                        </li>
                        <li class="active">
                            <a href="">2</a>
                        </li>
                        <li>
                            <a href="">3</a>
                        </li>
                        <li>
                            <span class="delimeter">...</span>
                        </li>
                        <li>
                            <a href="">14</a>
                        </li>
                        <li class="next">
                            <a href="">
                                Selanjutnya <i class="la la-long-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection