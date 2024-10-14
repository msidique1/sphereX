@props(['action', 'mahasiswa'])

<form action="{{ $action }}" method="POST">
    @csrf
    <div class="my-4">
        <x-input-label for="keterangan" value="Keterangan" required />
        <textarea id="keterangan" name="keterangan" rows="3" required
            class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>

    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
    <input type="hidden" name="kelas_id" value="{{ $mahasiswa->kelas_id }}">

    <div class="flex my-2 mt-5 justify-end items-end">
        <button type="submit"
            class="flex justify-center items-center gap-3 w-full lg:w-1/2 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            <x-feathericon-send class="w-5 h-5 text-white" />
            Kirim Permintaan
        </button>
    </div>
</form>
