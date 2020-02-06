<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
            <h5 class="modal-title exocet">New items in your inventory!</h5>
        </div>
        <div class="modal-body">
            <ul class="exocet-light small">
                @isset($items)
                    @foreach ($items as $item)
                        <li>{{ $item->name }} x {{ $item->amount }}</li>
                    @endforeach
                @endisset
            </ul>
            <p class="price text-center">
                Total cost: <span></span><img src="{{ asset("images/gold.png") }}" alt="Price" class="ml-1">
            </p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn-accept text-uppercase exocet" data-dismiss="modal">Ok</button>
        </div>
        <span class="corner tl"></span>
        <span class="corner tr"></span>
        <span class="corner bl"></span>
        <span class="corner br"></span>
        </div>
    </div>
</div>
