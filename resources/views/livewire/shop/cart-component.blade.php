<form>
<input type="hidden" wire:model="quantity" value="" >
<input type="hidden" wire:model="color" value="">
<input type="hidden" wire:model="size" value="">
<a title="{{$in_cart ? "Remove From Cart" : "Add To Cart"}}" wire:click="save" class="btn-group">
    <span wire:loading wire:target="save">
    <span class="spinner-border spinner-border-sm"></span>
    </span>
    {{$in_cart ? "Remove From Cart" : "Add To Cart"}}
</a>

<a wire:click="update" id="update_cart_quantity_{{$product->id}}" >Update</a>
</form>

<script>
    Livewire.emit('postAdded')
</script>
