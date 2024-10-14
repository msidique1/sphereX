<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    @if ($errors->any())
        <ul class="my-5">
            @foreach ($errors->all() as $error)
                <li class="text-red-500 before:content-['*'] before:text-red-500 before:mr-1">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form
        action="{{ $type == 'dosen'
            ? route('kaprodi.plot-dosen')
            : ($type == 'mahasiswa'
                ? route('kaprodi.plot-mahasiswa')
                : '') }}"
        method="POST" class="my-5 p-5 bg-white shadow-sm rounded-mds">
        @csrf
        <section>
            <x-input-label for="{{ $type }}_id" required>
                Pilih {{ ucfirst($type) }}
            </x-input-label>
            <x-select-option 
                name="{{ $type }}_id" id="{{ $type }}_id" 
                required>
                <option value="" disabled selected>
                    Pilih {{ ucfirst($type) }}
                </option>
                @if ($type == 'dosen')
                    @foreach ($dosen as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                @elseif ($type == 'mahasiswa')
                    @foreach ($mahasiswa as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                @endif
            </x-select-option>
        </section>
        <section>
            <x-input-label for="kelas_id" class="mt-5" required>
                {{ __('Pilih Kelas') }}
            </x-input-label>
            <x-select-option name="kelas_id" id="kelas_id" required>
                <option value="" disabled selected>Pilih Kelas</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </x-select-option>
        </section>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                Plot {{ ucfirst($type) }}
            </button>
        </div>
    </form>
</x-app-layout>
