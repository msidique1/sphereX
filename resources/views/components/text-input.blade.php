@props(['disabled' => false, 'placeholder' => '', 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} value="{{ $value }}" {!! $attributes->merge([
    'class' => $disabled
        ? 'bg-gray-200 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:italic'
        : 'bg-gray-50 mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:italic',
    'placeholder' => $placeholder,
]) !!}>