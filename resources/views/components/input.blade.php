@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'outline-none p-2 rounded-md shadow-sm border border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50']) !!}>
