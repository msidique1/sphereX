<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @php
        $formdata = [
            [
                'for' => 'name',
                'id' => 'name',
                'name' => 'name',
                'valueLabel' => 'Nama Mahasiswa',
                'valueInput' => old('name', $mahasiswa->name ?? ''),
                'placeholder' => 'Contoh: Budiono Siregar',
            ],
            [
                'for' => 'nim',
                'id' => 'nim',
                'name' => 'nim',
                'valueLabel' => 'NIM',
                'valueInput' => old('nim', $mahasiswa->nim ?? ''),
                'placeholder' => 'Contoh: 21xxx ...',
            ],
            [
                'for' => 'tempat_lahir',
                'id' => 'tempat_lahir',
                'name' => 'tempat_lahir',
                'valueLabel' => 'Tempat Lahir',
                'valueInput' => old('tempat_lahir', $mahasiswa->tempat_lahir ?? ''),
                'placeholder' => 'Contoh: Nusa Tenggara Timur',
            ],
            [
                'for' => 'tanggal_lahir',
                'id' => 'tanggal_lahir',
                'name' => 'tanggal_lahir',
                'valueLabel' => 'Tanggal Lahir',
                'valueInput' => old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? ''),
                'placeholder' => 'Contoh: Nusa Tenggara Timur',
                'type' => 'date',
            ],
        ];
    @endphp

    <form
        action="{{ isset($mahasiswa) ? route('dosen.update-mahasiswa', $mahasiswa->id) : route('dosen.store-mahasiswa') }}"
        class="bg-white p-7 mt-4 rounded-md shadow-sm" method="POST">
        @csrf

        @if (isset($mahasiswa))
            @method('PUT')
        @endif

        @foreach ($formdata as $item)
            <div class="mb-4">
                <x-input-label for="{{ $item['for'] }}" value="{{ $item['valueLabel'] }}" required />

                @if ($item['name'] === 'tanggal_lahir')
                    <x-date-input id="{{ $item['id'] }}" name="{{ $item['name'] }}" value="{{ $item['valueInput'] }}"
                        required />
                @else
                    <x-text-input id="{{ $item['id'] }}" name="{{ $item['name'] }}" value="{{ $item['valueInput'] }}"
                        placeholder="{{ $item['placeholder'] }}" required />
                @endif
            </div>
        @endforeach

        @foreach ($errors->all() as $error)
            <div class="text-red-500 before:content-['*'] before:text-red-500 before:mr-1">
                {{ $error }}
            </div>
        @endforeach

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                {{ isset($mahasiswa) ? 'Update Mahasiswa' : 'Tambah Mahasiswa' }}
            </button>
        </div>
    </form>

</x-app-layout>
