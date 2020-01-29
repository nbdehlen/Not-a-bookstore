<div class="col-12">
<div class="npc-item py-2" data-id="{{ $item->item_id }}" data-quantity="{{ $item->quantity }}">
    <div class="row">
        <div class="col-12 col-sm-8">
            <div class="row">
                <div class="col-4 col-sm-3 ml-2">
                    <img src="{{ asset($item->image) }}" class="image" alt="{{ $item->name }}">
                </div>
                <div class="col">
                    <h5 class="h6 mt-0">{{ $item->name }}</h5>
                    <p class="small mb-0">{{ $item->description }}</p>
                </div>
            </div>
            <div class="row">
                <div class="price col-12 col-sm-3 text-sm-center ml-2">
                    {{-- Placeholder coin --}}
                    <img src="https://via.placeholder.com/16" alt="Price">
                    <span>{{ $item->price }}</span>
                </div>
                <div class="col-12 col-sm ml-2 ml-sm-0">
                    <small class="text-muted">In stock: <span class="quantity">{{ $item->quantity }}</span></small>
                </div>
            </div>
        </div>
        <div class="col d-flex align-items-center mr-2">
            <div class="input-group input-group-sm justify-content-center justify-content-sm-end">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-quantity btn-texture-gray quantity-subtract" type="button">-</button>
                </div>
                <input type="text" class="amount form-control" value="1" pattern="[0-9]{1,2}">
                <div class="input-group-btn mr-1">
                    <button class="btn btn-sm btn-quantity btn-texture-gray quantity-add" type="button" {{ $item->quantity === 1 ? 'disabled' : '' }}>+</button>
                </div>
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-action btn-texture-blue" type="button">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>