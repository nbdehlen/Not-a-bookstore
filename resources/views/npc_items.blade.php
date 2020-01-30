@foreach ($items as $item)
    @component('npc_item', ['item' => $item])@endcomponent
@endforeach