<div class="d-flex justify-content-end  position-fixed fixed-bottom mb-3 mr-4">
    <h2 class="position-absolute" style="z-index: 9; top: -15px; right: 135px;">
        <span class="badge badge-warning bg-danger" style="color: white;">
            @if (isset($amount) && $amount)
                {!! $amount !!}
            @else
                0
            @endif
        </span>
    </h2>
    <a href="{{ route('car.show') }}" type="button" class="btn btn-info">
        <i class="ni ni-cart text-primary mr-2" style="color: white !important;"></i>Ver Carrito
    </a>
</div>
