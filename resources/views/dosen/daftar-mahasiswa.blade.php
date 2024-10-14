<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="overflow-x-auto mt-7">
        <table class="w-full table-auto shadow-md">
            <thead>
                <tr class="bg-slate-600">
                    <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Nama</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Tempat Lahir</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Tanggal Lahir</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Kelas Terdaftar</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td class="py-4 px-6 border-b border-gray-300">
                            {{ $loop->iteration + $mahasiswa->firstItem() - 1 }}
                        </td>
                        <td class="py-4 px-6 border-b border-l border-gray-300">
                            {{ $mhs->name }}
                        </td>
                        <td class="py-4 px-6 border-b border-l border-gray-300">
                            {{ $mhs->tempat_lahir }}
                        </td>
                        <td class="py-4 px-6 border-b border-l border-gray-300">
                            {{ \Carbon\Carbon::parse($mhs->tanggal_lahir)->format('d / F / Y') }}
                        </td>
                        <td class="py-4 px-6 border-b border-l border-gray-300">
                            {{ $mhs->kelas->name }}
                        </td>
                @endforeach
        </table>
        <div class="mt-4">{{ $mahasiswa->links() }}</div>
    </div>
</x-app-layout>
