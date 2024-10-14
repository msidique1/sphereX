@props(['name' => '', 'id' => '', 'required' => false])

<select 
    {{ $attributes->merge([
        'class' => 'bg-gray-50 mt-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:italic'
        ]) 
    }}
    name={{ $name }}
    id={{ $id }}>
    {{ $slot }}
</select>