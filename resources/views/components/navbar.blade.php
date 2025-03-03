<nav class="flex flex-col h-screen bg-gray-900 text-gray-300 w-64 fixed top-0 left-0 border-r border-gray-800 z-50">
    <!-- Logo Section -->
    <div class="flex items-center h-16 px-6 border-b border-gray-800 bg-gray-800">
        <a href="{{ route('dashboard.index') }}" class="text-lg font-semibold">
            <span class="text-indigo-400">{{ config('app.name') }}</span>
            <span class="text-xs font-medium text-gray-500 ml-2">Admin Panel</span>
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto p-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard.index') }}"
            class="flex items-center gap-3 p-3 rounded-lg
                  {{ request()->routeIs('dashboard.index') ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }} 
                  transition-colors">
            <i class="fas fa-table-cells w-5 text-center"></i>
            <span class="text-sm font-medium">{{ __('messages.dashboard') }}</span>
        </a>

        <!-- CRUD Section -->
        <div class="pt-4">
            <h4 class="px-3 text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">
                Data Management
            </h4>

            <!-- Posts -->
            <a href="{{ route('posts.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg
                      {{ request()->routeIs('posts.index') ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}
                      transition-colors">
                <i class="fas fa-newspaper w-5 text-center"></i>
                <span class="text-sm font-medium">Posts</span>
                <span
                    class="ml-auto text-xs bg-indigo-900/30 text-indigo-400 px-2 py-1 rounded-full {{ request()->routeIs('posts.index') ? 'block' : 'hidden' }}">@yield('posts_count')</span>
            </a>

        </div>
    </div>

    <!-- Bottom Section -->
    <div class="p-4 border-t border-gray-800 bg-gray-800">
        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-700 rounded-lg 
                           transition-colors text-sm font-medium">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                Logout
            </button>
        </form> --}}
        <!-- Language Switcher -->
        <div class="pt-4">
            <h4 class="px-3 text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">
                Language
            </h4>

            <a href="{{ route('language.switch', ['lang' => 'en']) }}"
                class="flex items-center gap-3 p-3 rounded-lg
              {{ app()->getLocale() == 'en' ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}
              transition-colors">
                <i class="fas fa-language w-5 text-center"></i>
                <span class="text-sm font-medium">English</span>
            </a>

            <a href="{{ route('language.switch', ['lang' => 'id']) }}"
                class="flex items-center gap-3 p-3 rounded-lg
              {{ app()->getLocale() == 'id' ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}
              transition-colors">
                <i class="fas fa-language w-5 text-center"></i>
                <span class="text-sm font-medium">Indonesia</span>
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Toggle Button -->
<button
    class="md:hidden fixed top-4 left-4 z-50 p-2 bg-gray-800 border border-gray-700 
              rounded-lg shadow-sm hover:bg-gray-700">
    <i class="fas fa-bars text-gray-400"></i>
</button>
