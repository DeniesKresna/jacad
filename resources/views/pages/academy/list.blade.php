@extends('layouts.user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                @if (count($academies) > 0)
                    <div class="row">
                        @foreach ($academies as $academy)
                            @include('components.academy', [
                                'academy' => $academy,
                                'css' => [
                                    'col' => 4
                                ]
                            ])
                        @endforeach
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