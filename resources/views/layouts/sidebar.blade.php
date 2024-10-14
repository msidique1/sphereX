@php
    $currentRoute = Route::currentRouteName();
    $userRole = Auth::user()->role;
@endphp

<aside x-cloak x-show="{ openSidebar }"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 transition-transform transform md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation"
    :class="{ '-translate-x-full': !openSidebar, 'translate-x-0': openSidebar }"
    x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul x-data="{ activeTab: '{{ $currentRoute }}' }" class="space-y-2">
            <!-- Dashboard Link -->
            <x-sidebar.sidebar-link 
                :route="$userRole . '.dashboard'" 
                :active-tab="$currentRoute" 
                icon="ri-dashboard-3-fill" 
                label="Dashboard" />

            {{-- Dropdown untuk Kaprodi --}}
            @if($userRole === 'kaprodi')
                <x-sidebar.sidebar-dropdown 
                    label="Manajemen Data" 
                    icon="coolicon-file-document">
                    <x-sidebar.sidebar-link 
                        :route="$userRole . '.management-dosen'" 
                        :active-tab="$currentRoute" 
                        label="Manajemen Dosen" />
                    <x-sidebar.sidebar-link 
                        label="Manajemen Kelas" 
                        :route="$userRole . '.management-kelas'"
                        :active-tab="$currentRoute" />
                    <x-sidebar.sidebar-link 
                        label="Plotting" 
                        :route="$userRole . '.plotting'"
                        :active-tab="$currentRoute" />
                </x-sidebar.sidebar-dropdown>
            @endif

            {{-- Dropdown untuk Dosen --}}
            @if($userRole === 'dosen')
                <x-sidebar.sidebar-dropdown 
                    label="Manajemen Data"
                    icon="coolicon-file-document"
                    >
                    <x-sidebar.sidebar-link 
                        :route="$userRole . '.management-mahasiswa'" 
                        :active-tab="$currentRoute" 
                        label="Manajemen Mahasiswa" />
                    <x-sidebar.sidebar-link
                        :route="$userRole . '.daftar-mahasiswa'"
                        :active-tab="$currentRoute" 
                        label="Daftar Mahasiswa" />
                    <x-sidebar.sidebar-link
                        :route="$userRole . '.request-edit'"
                        :active-tab="$currentRoute" 
                        label="Laman Request" />
                </x-sidebar.sidebar-dropdown>
            @endif

            {{-- Dropdown untuk Mahasiswa --}}
            @if($userRole === 'mahasiswa')
            <x-sidebar.sidebar-link 
                route="mahasiswa.request-edit" 
                :active-tab="$currentRoute" 
                icon="bxs-edit" 
                label="Permintaan Edit" 
                />
            <x-sidebar.sidebar-link 
                route="mahasiswa.show-detail" 
                :active-tab="$currentRoute" 
                icon="bxs-edit" 
                label="User Detail" 
                />
            @endif

            <!-- Profil Link -->
            <x-sidebar.sidebar-link 
                route="profile.edit" 
                :active-tab="$currentRoute" 
                icon="fas-user-cog" 
                label="Profil" />
        </ul>
    </div>
</aside>