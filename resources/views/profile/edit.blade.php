<x-app-layout>
    <x-slot name="header">
        {{ $breadcrumb }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-1 lg:px-1 space-y-6">

            @if(session('notify'))
                <x-notification.notify />
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
