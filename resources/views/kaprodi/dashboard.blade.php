<x-app-layout>
    <x-slot name="header">{{ $breadcrumb }}</x-slot>

    @php
        $cardStats = [
            [
                'icon' => 'fas-user-shield',
                'title' => "You're Logged in as",
                'value' => Auth::user()->role,
                'color' => 'text-blue-700',
            ],
            [
                'icon' => 'fas-user-group',
                'title' => 'Jumlah Dosen',
                'value' => $dosen->count(),
                'color' => 'text-green-400',
            ],
            [
                'icon' => 'fas-dice-d6',
                'title' => 'Jumlah Kelas',
                'value' => $kelas->count(),
                'color' => 'text-cyan-400',
            ],
            [
                'icon' => 'fas-users',
                'title' => 'Jumlah Mahasiswa',
                'value' => $mahasiswa->count(),
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

    @php
        $requirements = [
            [
                'desc' =>
                    'kaprodi itu bisa full crud data dosen dan kelas, dengan catatan dia bisa merubah isi dari kelasnya atau melakukan ploting untuk mahasiswa dan dosen tetapi tidak dengan merubah data mahasiswanya',
                'bg-stat' => 'bg-green-500',
                'date' => 'Sep 12, 2024',
                'position' => 'Marketing'
            ],
            [
                'desc' =>
                    'dosen itu bisa full crud data mahasiswa, dengan catatan dosen tersebut menjadi wali_kelas dari mahasiswa tersebut dan tidak bisa merubah data mahasiswa kelas lain dan Ketika dosen wali menyetujui ataupun menolak request edit_data dari mahasiswa maka data request tersebut langsung ikut terhapus',
                'bg-stat' => 'bg-blue-500',
                'date' => 'Mar 25, 2024',
                'position' => 'Social Specialist'
            ],
            [
                'desc' =>
                    'mahasiswa hanya bisa melihat datanya dia sendiri, tetapi ia bisa meminta request ke dosen_walinya untuk bisa merubah datanya sendiri jika saja terjadi kesalahan dalam pendataan dan akan langsung kehilangan hak aksesnya Ketika selesai mengedit',
                'bg-stat' => 'bg-yellow-400',
                'date' => 'Aug 15, 2024',
                'position' => 'UI Designer'
            ],
            [
                'desc' => 'untuk isi dari kelasnya itu tidak boleh melebihi dari jumlah kapasitas',
                'bg-stat' => 'bg-indigo-500',
                'date' => 'Oct 1, 2024',
                'position' => 'Developer'
            ],
            [
                'desc' =>
                    'mengisi system tersebut dengan data dummy sejumlah 1 kaprodi 5 dosen 20 mahasiswa perkelas ada 10 mahasiswa, jadi nanti akan ada 2 dosen_wali dan 3 dosen biasa yang tidak memiliki akses ke data 1 kelas',
                'bg-stat' => 'bg-sky-500',
                'date' => 'Dec 10, 2024',
                'position' => 'System Analyst'
            ],
        ];
    @endphp

    <h3 class="text-xl font-medium pt-3 text-gray-700">
        {{ __('Requirements') }}
    </h3>
    <p class="text-sm leading-8 pb-2 text-gray-600">
        Meet your spesific requirements to gain new knowledge
    </p>

    <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($requirements as $item)
            <article class="bg-white rounded-md shadow-sm flex flex-col items-start p-5">
                <div class="flex items-center gap-x-4 text-xs">
                    <time datetime="2020-03-16" class="text-gray-500 font-medium">
                        {{ $item['date'] }}
                    </time>
                    <a href="#"
                        class="relative z-10 rounded-md {{ $item['bg-stat'] }} px-3 py-1.5 font-medium text-white">
                    {{ $item['position'] }}
                    </a>
                </div>
                <div class="group relative">
                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            {{ __('System requirements #') }}{{ $loop->iteration }}
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                        {{ $item['desc'] }}
                    </p>
                </div>
            </article>
        @endforeach
    </div>

</x-app-layout>
