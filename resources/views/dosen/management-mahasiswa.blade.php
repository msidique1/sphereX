<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @if (session('notify'))
        <x-notification.notify />
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center my-3 mt-8">
        <div class="w-full md:w-1/2 flex items-center p-3 rounded-md bg-blue-700 mb-4 md:mb-0">
            <span class="mr-4">
                <x-ri-error-warning-line class="text-white h-5 w-5" />
            </span>
            <p class="text-base font-medium text-white">
                {{ __('List Mahasiswa yang terdaftar di kelas anda') }}
            </p>
        </div>
    
        <div class="flex justify-end w-full md:w-auto">
            <a href="/dosen/management-mahasiswa/add-edit-mahasiswa"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('Tambah Data') }}
            </a>
        </div>
    </div>
    

    <div class="overflow-x-auto">
        <table class="w-full table-auto shadow-md">
            <thead>
                <tr class="bg-slate-600">
                    <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Nama</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Tempat Lahir</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Tanggal Lahir</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($mahasiswa as $mhs)
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
                            <div class="flex flex-col md:flex-row gap-2">
                                <a href="{{ route('dosen.add-edit-mahasiswa', $mhs->id) }}"
                                    class="bg-yellow-300 text-white py-2 px-3 w-full md:w-fit text-center rounded-md text-xs hover:bg-yellow-400">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('dosen.delete-mahasiswa', $mhs->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-2 px-3 w-full text-center rounded-md text-xs hover:bg-red-600">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center font-medium bg-gray-50 text-gray-600">
                            {{ __('Dosen ini tidak memiliki Kelas atau Mahasiswa Aktif.') }}
                        </td>
                    </tr>
                @endforelse
        </table>
        <div class="mt-4">{{ $mahasiswa->links() }}</div>
    </div>
</x-app-layout>
