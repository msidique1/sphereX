<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @if (session('notify'))
        <x-notification.notify />
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto shadow-md text-">
            <thead>
                <tr class="bg-slate-600">
                    <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">
                        No.
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Nama Mahasiswa
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        NIM
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Tempat Lahir
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Tanggal Lahir
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Kelas
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $loop->iteration + $mahasiswa->firstItem() - 1 }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300 truncate">
                            {{ $mhs->name }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $mhs->nim }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $mhs->tempat_lahir }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $mhs->tanggal_lahir }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $mhs->kelas->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $mahasiswa->links() }}
    </div>
</x-app-layout>
