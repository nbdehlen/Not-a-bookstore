@forelse ($items as $item)
    @component('npc_item', ['item' => $item])@endcomponent
@empty
    <p class="h2 exocet mx-auto my-auto">No items found!</p>
@endforelse
