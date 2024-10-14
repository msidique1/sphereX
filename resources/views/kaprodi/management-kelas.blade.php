<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="pb-3 pt-5 flex justify-start w-full">
        <a href="/kaprodi/add-edit-kelas"
            class="text-white bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 md:mt-0 sm:mt-0 before:content-['+'] before:text-white before:mr-1 before:text-base">
            {{ __('Tambah data') }}
        </a>
    </div>

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
                        Nama Kelas
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Jumlah
                    </th>
                    <th class="w-1/4 py-4 px-6 text-left text-gray-100 font-bold">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($kelas as $dataKelas)
                    <tr>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $loop->iteration + $kelas->firstItem() - 1 }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300 truncate">
                            {{ $dataKelas->name }}
                        </td>
                        <td class="py-4 px-6 border-b border-r border-gray-300">
                            {{ $dataKelas->jumlah }}
                        </td>
                        <td class="py-4 px-3 border-b border-gray-300">
                            <div class="flex flex-col text-center md:flex-row gap-2">
                                <a href="{{ route('kaprodi.add-edit-kelas', $dataKelas->id) }}"
                                    class="bg-yellow-300 text-white py-2 px-3 w-full lg:w-1/4 rounded-md cursor-pointer text-xs">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('kaprodi.delete-kelas', $dataKelas->id) }}" method="POST"
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
    </div>
    <div class="mt-4">
        {{ $kelas->links() }}
    </div>
</x-app-layout>
