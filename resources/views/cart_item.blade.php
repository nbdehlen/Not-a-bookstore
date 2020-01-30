<div class="cart-item col-12 py-2" data-id="{{ $item->item_id }}">
    <div class="row">
        <div class="col-12 col-sm-8">
            <div class="row align-items-center">
                <div class="col-3 col-sm-2 ml-2 text-center justify-self-center">
                    <img src="{{ asset($item->image) }}" class="image" alt="{{ $item->name }}">
                </div>
                <div class="col-auto col-sm-6">
                    <h5 class="item-name mb-0">{{ $item->name }}</h5>
                </div>
                <div class="price col-12 col-sm-3 ml-2 ml-sm-0 d-flex align-items-center justify-content-sm-center">
                    <span>{{ $item->price * $item->amount }}</span>
                    <img src="{{ asset("images/gold.png") }}" class="ml-1" alt="Price">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm d-flex align-items-center mr-2">
            <div class="input-group input-group-sm justify-content-center justify-content-sm-end">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-quantity btn-texture-gray cart-quantity-subtract" type="button">-</button>
                </div>
                <input type="text" class="amount form-control" value="{{ $item->amount ?? 1 }}" pattern="[0-9]{1,2}" disabled>
                <div class="input-group-btn mr-1">
                    <button class="btn btn-sm btn-quantity btn-texture-gray cart-quantity-add" type="button">+</button>
                </div>
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-texture-red btn-action-remove" type="button">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>