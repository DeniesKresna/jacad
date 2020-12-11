<div class="col-{{ $css['col'] }} mt-4">
    <div class="d-flex">
        <img class="img-fluid" src="{{ $academy->image_url }}" width="200" alt="">
        <div class="mt-4 ml-2">
            <h5>Jobhun Academy: {{ $academy->name }}</h5>
            <img src="https://i.ibb.co/wc66P3d/unnamed.png" width="100" alt="">
            <span class="mt-3">Rp{{ number_format(strval($academy->active_period->price), 2) }}</span>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ $academy->url }}" class="btn btn-success w-25">DAFTAR</a>
    </div> 
</div>