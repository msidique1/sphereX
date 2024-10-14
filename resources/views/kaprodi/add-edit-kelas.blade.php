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
                'valueLabel' => 'Nama Kelas',
                'valueInput' => old('name', $kelas->name ?? ''),
                'placeholder' => 'Contoh : Sains dan Teknologi',
            ],
            [
                'for' => 'jumlah',
                'id' => 'jumlah',
                'name' => 'jumlah',
                'valueLabel' => 'Jumlah',
                'valueInput' => old('jumlah', $kelas->jumlah ?? ''),
                'placeholder' => 'Contoh : 33',
            ],
        ];
    @endphp

    <form 
        action="{{ isset($kelas) ? route('kaprodi.update-kelas', $kelas->id) : route('kaprodi.store-kelas') }}"
        class="bg-white p-7 rounded-md shadow-sm"
        method="POST">
        @csrf

        @if (isset($kelas))
            @method('PUT')
        @endif
        
        @foreach ($dataForm as $item)
            <div class="mb-4">
                <x-input-label 
                    for="{{ $item['for'] }}" 
                    value="{{ $item['valueLabel'] }}" 
                    required />
                <x-text-input 
                    id="{{ $item['id'] }}" 
                    name="{{ $item['name'] }}" 
                    value="{{ $item['valueInput'] }}"
                    placeholder="{{ $item['placeholder'] }}"    
                    required />
            </div>
        @endforeach

        @foreach ($errors->all() as $error)
            <div class="text-red-500 before:content-['*'] before:text-red-500 before:mr-1">
                {{ $error }}
            </div>
        @endforeach

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                {{ isset($kelas) ? 'Update Kelas' : 'Tambah Kelas' }}
            </button>
        </div>
    </form>
</x-app-layout>
