@props(['route' => null, 'activeTab' => '', 'icon' => 'eva-chevron-right', 'label'])

<li>
    <a href="{{ $route ? route($route) : '#' }}" @click="activeTab = '{{ $route }}'"
        :class="{
            'bg-gray-100 dark:bg-gray-700': activeTab === '{{ $route }}'
        }"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <svg aria-hidden="true"
            class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            viewBox="0 0 20 20">
            {{ svg($icon) }}
        </svg>
        <span class="ml-3">{{ $label }}</span>
    </a>
</li>
