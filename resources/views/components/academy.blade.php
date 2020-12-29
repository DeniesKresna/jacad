<div class="{{ isset($css_classes) ? $css_classes : '' }} mt-4">
    <div class="d-flex">
        <img class="img-fluid" src="{{ $academy->image_url }}" width="200" alt="">
        <div class="mt-4 ml-2">
            <h5 class="font-weight-bold">Jobhun Academy: {{ $academy->name }}</h5>
            <img src="https://i.ibb.co/wc66P3d/unnamed.png" width="100" alt="">
            <div class="mt-3">Rp{{ number_format(strval($academy->activePeriod->price), 2) }}</div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ $academy->url }}" class="btn btn-success w-25">DAFTAR</a>
    </div> 
</div>