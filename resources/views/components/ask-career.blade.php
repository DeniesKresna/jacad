<div class="{{ $css['col'] }} {{ isset($css['py']) ? $css['py'] : '' }}">
    <div class="d-flex">
        <img class="img-fluid" src="{{ $ask_career->mentor->image_url }}" width="160">
        <div class="ml-2">
            <h5 class="font-weight-bold">{{ $ask_career->mentor->name }} - {{ $ask_career->name }}</h5>
            @if (isset($schedule))
                {!! $schedule !!}
            @endif
            <span>Rp{{ number_format(strval($ask_career->price), 2) }}</span>
        </div>
    </div>
</div>