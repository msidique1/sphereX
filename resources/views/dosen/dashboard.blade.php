<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @php
        $cardStats = [
            [
                'icon' => 'fas-user-shield',
                'title' => "You're Logged in as",
                'value' => Auth::user()->role,
                'color' => 'text-green-600',
            ],
            [
                'icon' => 'fas-user-group',
                'title' => 'Total Mahasiswa Aktif',
                'value' => $mahasiswa,
                'color' => 'text-cyan-400',
            ],
            [
                'icon' => 'tabler-report-analytics',
                'title' => 'Total Permintaan Laporan',
                'value' => $requestModel,
                'color' => 'text-indigo-500',
            ],
            [
                'icon' => 'heroicon-s-user-group',
                'title' => 'Status Aktif Dosen',
                'value' => $dosenAvaibility,
                'color' => 'text-yellow-300',
            ],
        ];
    @endphp

    <div class="flex flex-col sm:grid sm:grid-cols-2 md:grid md:grid-cols-2 lg:grid-cols-4 gap-4 py-5">
        @foreach ($cardStats as $card)
            <x-card-stats :color="$card['color']">
                <x-slot name="icon">
                    @svg($card['icon'])
                </x-slot>
                <x-slot name="title">
                    {{ $card['title'] }}
                </x-slot>
                <x-slot name="role">
                    {{ $card['value'] }}
                </x-slot>
            </x-card-stats>
        @endforeach
    </div>

    <div class="flex flex-col sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-2">
        <div class="bg-white p-4 rounded-md shadow-sm">
            @if ($kelas->isNotEmpty())
                <p class="text-lg font-semibold leading-6 text-blue-600">
                    Daftar Kelas Aktif
                </p>
                <ul class="max-w-md">
                    @foreach ($kelas as $kelasItem)
                        <li class="pt-3 pb-0 sm:pt-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $kelasItem->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Jumlah Mahasiswa : {{ $kelasItem->mahasiswa->count() }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="before:content-['*'] before:text-blue-500">
                    Tidak ada kelas yang diampu saat ini.
                </p>
            @endif
        </div>
    </div>
</x-app-layout>
