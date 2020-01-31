@foreach ($cart as $item)
    @component('cart_item', ['item' => $item])@endcomponent
@endforeach
