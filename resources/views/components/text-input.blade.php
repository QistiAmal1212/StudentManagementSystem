@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' form-control ']) !!} {!! $attributes->merge(['style' => ' width:100%; ']) !!}>
