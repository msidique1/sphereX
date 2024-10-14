<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @if (session('notify'))
        <div class="my-3 text-center">
            <x-notification.notify />
        </div>
    @endif

    @if ($editRequest->isNotEmpty())
        <div class="overflow-x-auto my-7">
            <table class="w-full table-auto shadow-md">
                <thead>
                    <tr class="bg-slate-600">
                        <th class="w-1/12 py-4 px-6 text-left text-gray-100 font-bold">No.</th>
                        <th class="w-1/8 py-4 px-6 text-left text-gray-100 font-bold">Nama Mahasiswa</th>
                        <th class="w-1/2 py-4 px-6 text-left text-gray-100 font-bold">Keterangan</th>
                        <th class="w-1/8 py-4 px-6 text-left text-gray-100 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($editRequest as $request)
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-300">
                                {{ $loop->iteration + $editRequest->firstItem() - 1 }}</td>
                            <td class="py-4 px-6 border-b border-l border-gray-300">
                                {{ $request->mahasiswa->name }}
                            </td>
                            <td class="py-4 px-6 border-b border-l border-gray-300">
                                {{ $request->keterangan }}
                            </td>
                            <td class="py-4 px-6 border-b border-l border-gray-300">
                                <div class="flex flex-col text-center md:flex-row gap-2">
                                    <form action="{{ route('dosen.handle-request', [$request->id, 'approve']) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 text-white py-2 px-3 rounded-md cursor-pointer text-xs">
                                            {{ __('Approve') }}
                                        </button>
                                    </form>

                                    <form action="{{ route('dosen.handle-request', [$request->id, 'reject']) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white py-2 px-3 rounded-md cursor-pointer text-xs">
                                            {{ __('Reject') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $editRequest->links() }}</div>
    @else
        <div class="bg-yellow-100 text-center font-medium my-5 text-yellow-700 p-4 rounded-lg">
            Tidak ada request edit data mahasiswa yang perlu di-approve atau di-reject.
        </div>
    @endif
</x-app-layout>
