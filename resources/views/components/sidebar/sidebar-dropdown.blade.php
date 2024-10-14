@props(['label', 'icon'])

<li x-data="{ open: false }">
    <button type="button" @click="open = !open"
        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" viewBox="0 0 20 20">
            {{ svg($icon) }}
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ $label }}</span>
        <svg class="w-6 h-6 focus:rotate-180 transition-transform duration-300" :class="{ 'rotate-180': open }" viewBox="0 0 20 20">
            {{ svg('ri-arrow-down-s-line') }}
        </svg>
    </button>

    <ul x-show="open" x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" x-cloak
        @click.away="open = false" class="py-2 space-y-2">
        {{ $slot }}
    </ul>
</li>
