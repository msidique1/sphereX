@props(['action', 'mahasiswa'])

<form action="{{ $action }}" method="POST">
    @csrf
    @method('PUT')

    <div class="my-4">
        <x-input-label for="name" value="Nama" required />
        <x-text-input id="name" name="name" value="{{ $mahasiswa->name }}" placeholder="Masukkan nama" required />
    </div>

    <div class="my-4">
        <x-input-label for="nim" value="NIM" required />
        <x-text-input id="nim" name="nim" value="{{ $mahasiswa->nim }}" placeholder="Masukkan NIM" required />
    </div>

    <div class="my-4">
        <x-input-label for="kelas" value="Kelas" required />
        <x-text-input id="kelas" name="kelas" value="{{ $mahasiswa->kelas ? $mahasiswa->kelas->name : '-' }}"
            placeholder="Kelas" disabled />
    </div>

    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="my-2">
                <x-input-label for="tempat_lahir" value="Tempat Lahir" required />
                <x-text-input id="tempat_lahir" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}"
                    placeholder="Masukkan tempat lahir" required />
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
            <div class="my-2">
                <x-input-label for="tanggal_lahir" value="Tanggal Lahir" required />
                <x-date-input id="tanggal_lahir" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}"
                    required />
            </div>
        </div>
    </div>

    <div class="flex my-2 mt-5 justify-end items-end">
        <button type="submit" class="flex justify-center items-center gap-3 w-full lg:w-1/4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            <x-ri-save-line class="w-5 h-5" />
            Simpan Perubahan
        </button>
    </div>
</form>
