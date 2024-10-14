<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="my-4">
        @if (session('notify'))
            <x-notification.notify />
        @endif
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        @if ($mahasiswa)
            @foreach ($mahasiswa as $mhs)
                @if ($mhs->edit)
                    <div class="mt-6 bg-white shadow-md rounded-lg p-6 mx-auto">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ $mhs->name }}</h2>
                        <div
                            class="flex items-center justify-start gap-3 w-full lg:w-1/2 bg-green-500 p-3 rounded-md shadow-sm">
                            <x-gmdi-read-more-r class="w-6 h-6 text-white" />
                            <span class="font-medium text-white">
                                Status Edit saat ini yaitu
                                {{ $mhs->edit ? 'Dapat Mengedit' : 'Tidak Dapat Mengedit' }}
                            </span>
                        </div>
                        <x-forms.mahasiswa :action="route('mahasiswa.update-data-request', $mhs->id)" :mahasiswa="$mhs" />
                    </div>
                @else
                    <div class="mx-auto lg:mx-0 w-full lg:w-1/2 justi mt-6 bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ $mhs->name }}</h2>
                        <x-forms.mahasiswa-card-request :action="route('mahasiswa.store-edit-request')" :mahasiswa="$mhs" />
                    </div>
                @endif
            @endforeach
        @endif
    </section>
</x-app-layout>
