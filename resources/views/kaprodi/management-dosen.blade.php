<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="pt-5 flex flex-wrap justify-between w-full">
        <h3 class="text-lg mt-2 font-medium text-gray-700">
            Daftar Keseluruhan Data Dosen
        </h3>
        <a href="/kaprodi/add-edit-dosen"
            class="text-white bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 md:mt-0 sm:mt-0">
            {{ __('Tambah Dosen') }}
        </a>
    </div>

    @if (session('notify'))
        <x-notification.notify />
    @endif

    <div class="overflow-x-auto mt-4">
        <table class="w-full table-auto shadow-md">
            <thead>
                <tr class="bg-slate-600">
                    <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Nama</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">NIP</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Kode Dosen</th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @php $counter = $dosen->firstItem() @endphp
                @foreach ($dosen as $dataDosen)
                    <tr>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $counter++ }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300 truncate">
                            {{ $dataDosen->name }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $dataDosen->nip }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $dataDosen->kode_dosen }}
                        </td>
                        <td class="py-4 px-3 border-b border-gray-300">
                            <div class="flex flex-col text-center md:flex-row gap-2">
                                <a href="{{ route('kaprodi.add-edit-dosen', $dataDosen->id) }}"
                                    class="bg-yellow-300 text-white py-2 px-3 w-full lg:w-1/3 rounded-md cursor-pointer text-xs">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('kaprodi.delete-dosen', $dataDosen->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure delete this data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-2 px-3 w-full rounded-md cursor-pointer text-xs">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $dosen->links() }}</div>
    </div>
</x-app-layout>
