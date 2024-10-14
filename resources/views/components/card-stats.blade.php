@props(['color' => 'text-blue-500'])

<div class="flex items-center bg-white border rounded-md overflow-hidden shadow">
    <div class="p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 {{ $color }}" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" {{ $attributes->merge(['class' => $color]) }}>
            {{ $icon }}
        </svg>
    </div>
    <div class="px-4 text-gray-600">
        <h3 class="text-sm font-medium">
            {{ $title }}
        </h3>
        <p class="text-2xl font-bold first-letter:uppercase {{ $color }}">
            {{ $role }}
        </p>
    </div>
</div>
