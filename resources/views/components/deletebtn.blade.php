@props(['type' => 'button', 'id' => ''])
<button {{ $attributes->merge(['class' => 'btn btn-warning']) }} type="{{ $type }}" id="{{ $id }}">
    <i class="fas fa-trash"></i>
</button>
