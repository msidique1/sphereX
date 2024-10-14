<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="my-3">
        <span class="before:content-['*'] before:text-red-500 font-medium italic">
            {{ __('Pilih entitas atau role yang akan diplot berdasarkan kelas') }}
        </span>
    </div>

    @if (session('notify'))
        <x-notification.notify />
    @endif

    <div class="flex flex-row gap-3 my-5">
        <form action="{{ route('kaprodi.plot-detail', ['type' => 'mahasiswa']) }}" method="GET">
            <x-primary-button class="bg-indigo-500">
                {{ __('Plotting Mahasiswa') }}
            </x-primary-button>
        </form>

        <form action="{{ route('kaprodi.plot-detail', ['type' => 'dosen']) }}" method="GET">
            <x-primary-button class="bg-green-500">
                {{ __('Plotting Dosen') }}
            </x-primary-button>
        </form>
    </div>

    <section>
        <div class="overflow-x-auto">
            <h2 class="text-lg font-semibold my-1 mb-2">
                Dosen dan Mahasiswa berdasarkan Kelas
            </h2>
            <table class="w-full table-auto shadow-md">
                <thead>
                    <tr class="bg-slate-600">
                        <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Nama Dosen</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Jumlah Mahasiswa</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Kelas</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($kelas->isNotEmpty())
                        @foreach ($kelas as $kelasInstance)
                            <tr>
                                <td class="py-4 px-6 border-b border-r border-gray-300">
                                    {{ $loop->iteration + $kelas->firstItem() - 1 }}
                                </td>
                                <td class="py-4 px-6 border-b border-r border-gray-300">
                                    {{ $kelasInstance->dosen ? $kelasInstance->dosen->name : '-' }}
                                </td>
                                <td class="py-4 px-6 border-b border-r border-gray-300">
                                    {{ $kelasInstance->mahasiswa->count() }}
                                </td>
                                <td class="py-4 px-6 border-b border-r border-gray-300">
                                    {{ $kelasInstance->name }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="border-b p-2 text-center">Tidak ada data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $kelas->links() }}
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-lg font-semibold my-5 mb-3">
            Dosen yang tidak terelasi dengan Kelas
        </h2>
        <table class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 table-auto shadow-md">
            <thead>
                <tr class="bg-slate-600 text-white">
                    <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                    <th class="w-1/2 py-4 px-6 text-left text-gray-100 font-bold">Nama Dosen</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if ($dosenWithoutKelas->isNotEmpty())
                    @foreach ($dosenWithoutKelas as $dosen)
                        <tr>
                            <td class="py-4 px-6 border-b border-r border-gray-300">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-4 px-6 border-b border-r border-gray-300">
                                {{ $dosen->name }} 
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="border-b p-2 text-center">
                            Semua Dosen telah memiliki kelas masing-masing.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </section>
</x-app-layout>
