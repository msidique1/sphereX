<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @php
        $splitArray = [
            [
                'title' => 'Nama Lengkap',
                'data' => $mahasiswa->name,
            ],
            [
                'title' => 'Nomor Induk Mahasiswa',
                'data' => $mahasiswa->nim,
            ],
            [
                'title' => 'Tempat Lahir / Tanggal Lahir',
                'data' => $mahasiswa->tempat_lahir . ', ' . $mahasiswa->formatted_tanggal_lahir,
            ],
            [
                'title' => 'Kelas',
                'data' => $mahasiswa->kelas->name,
            ],
        ];
    @endphp

    <section class="my-5">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">User Information</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal detail Information</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            @foreach ($splitArray as $item)
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ $item['title'] }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $item['data'] }}
                        </dd>
                    </div>
                </dl>
            @endforeach
        </div>
    </section>
</x-app-layout>
