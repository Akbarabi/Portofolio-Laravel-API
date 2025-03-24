<nav class="flex flex-row md:flex-row justify-between items-start md:items-center gap-4 px-5 py-2 z-50 w-full">
    <h1 class="text-4xl md:text-6xl font-black"><a href="{{ route('guest.index') }}">ABI.DEV</a></h1>
    <div class="flex flex-row gap-3">
        <a href="{{ route('guest.index') }}"
            class="flex items-center gap-2 px-4 py-2 font-bold border-4 border-black transition-transform hover:-translate-y-1 {{ request()->routeIs('guest.index') ? 'bg-black text-yellow-300' : 'bg-white hover:bg-gray-100' }}">
            <i class="mdi mdi-home mdi-18px"></i>
            HOME
        </a>
        <a href="{{ route('guest.about') }}"
            class="flex items-center gap-2 px-4 py-2 font-bold border-4 border-black transition-transform hover:-translate-y-1 {{ request()->routeIs('guest.about') ? 'bg-black text-yellow-300' : 'bg-white hover:bg-gray-100' }}">
            <i class="mdi mdi-account mdi-18px"></i>
            ABOUT
        </a>
        <a href="{{ route('guest.project') }}"
            class="flex items-center gap-2 px-4 py-2 font-bold border-4 border-black transition-transform hover:-translate-y-1 {{ request()->routeIs('guest.project') ? 'bg-black text-yellow-300' : 'bg-white hover:bg-gray-100' }}">
            <i class="mdi mdi-folder mdi-18px"></i>
            PROJECT
        </a>
    </div>
</nav>