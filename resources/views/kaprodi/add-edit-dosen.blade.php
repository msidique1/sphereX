<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @php
        $dataForm = [
            [
                'for' => 'name',
                'id' => 'name',
                'name' => 'name',
                'valueLabel' => 'Nama Dosen',
                'valueInput' => old('name', $dosen->name ?? ''),
                'placeholder' => 'Contoh : Ir. Vincent Satoru S.Kom.',
            ],
            [
                'for' => 'nip',
                'id' => 'nip',
                'name' => 'nip',
                'valueLabel' => 'NIP',
                'valueInput' => old('nip', $dosen->nip ?? ''),
                'placeholder' => 'Contoh : 18xxxx ...',
            ],
            [
                'for' => 'kode_dosen',
                'id' => 'kode_dosen',
                'name' => 'kode_dosen',
                'valueLabel' => 'Kode Dosen',
                'valueInput' => old('kode_dosen', $dosen->kode_dosen ?? ''),
                'placeholder' => 'Contoh : 1xx',
            ],
        ];
    @endphp

    <form action="{{ isset($dosen) ? route('kaprodi.update-dosen', $dosen->id) : route('kaprodi.submit-dosen') }}"
        class="bg-white p-7 mt-5 rounded-md shadow-sm" method="POST">
        @csrf

        @if (isset($dosen))
            @method('PUT')
        @endif

        @foreach ($dataForm as $item)
            <div class="mb-4">
                <x-input-label for="{{ $item['for'] }}" value="{{ $item['valueLabel'] }}" required />
                <x-text-input id="{{ $item['id'] }}" name="{{ $item['name'] }}" value="{{ $item['valueInput'] }}"
                    placeholder="{{ $item['placeholder'] }}" required />
            </div>
        @endforeach

        @foreach ($errors->all() as $error)
            <div class="text-red-500 before:content-['*'] before:text-red-500 before:mr-1">
                {{ $error }}
            </div>
        @endforeach

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                {{ isset($dosen) ? 'Update Dosen' : 'Tambah Dosen' }}
            </button>
        </div>
    </form>
</x-app-layout>
