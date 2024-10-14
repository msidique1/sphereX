@props(['disabled' => false, 'placeholder' => '', 'value' => ''])

<input type="date" {{ $disabled ? 'disabled' : '' }} value="{{ $value }}" {!! $attributes->merge([
    'class' => 'bg-gray-50 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:italic',
    'placeholder' => $placeholder,
]) !!}>
