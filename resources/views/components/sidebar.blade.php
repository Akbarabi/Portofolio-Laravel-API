<!-- Mobile Toggle Button -->
<button id="mobile-toggle"
    class="md:hidden fixed bottom-8 left-4 z-50 p-2 bg-gray-800 border border-gray-700 rounded-lg shadow-sm hover:bg-gray-700 transition">
    <i class="fas fa-bars text-gray-400"></i>
</button>

<!-- Sidebar -->
<nav id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-gray-300 border-r border-gray-800 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">

    <!-- Logo Section -->
    <div class="flex items-center h-16 px-6 border-b border-gray-800 bg-gray-800">
        <a href="{{ route('dashboard.index') }}" class="text-lg font-semibold flex-1">
            <span class="text-indigo-400">{{ config('app.name') }}</span>
            <span class="text-xs font-medium text-gray-500 ml-2">Admin Panel</span>
        </a>
        <!-- Close Button for Mobile -->
        <button id="close-sidebar" class="md:hidden p-2 text-gray-400 hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Content Wrapper (Prevents Scroll Issue) -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Navigation Menu (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="{{ route('dashboard.index') }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-colors 
                      {{ request()->routeIs('dashboard.index') ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}">
                <i class="fas fa-table-cells w-5 text-center"></i>
                <span class="text-sm font-medium">{{ __('messages.dashboard') }}</span>
            </a>

            <div class="pt-4">
                <h4 class="px-3 text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">
                    Data Management
                </h4>
                <a href="{{ route('posts.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-colors
                          {{ request()->routeIs('posts.index') ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}">
                    <i class="fas fa-newspaper w-5 text-center"></i>
                    <span class="text-sm font-medium">Posts</span>
                    @if (request()->routeIs('posts.index'))
                        <span
                            class="ml-auto text-xs bg-indigo-900/30 text-indigo-400 px-2 py-1 rounded-full">@yield('posts_count')</span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Language Switcher (Always at Bottom) -->
        <div class="p-4 border-t border-gray-800 bg-gray-800">
            <h4 class="px-3 text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">
                Language
            </h4>
            <a href="{{ route('language.switch', ['lang' => 'en']) }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-colors
                      {{ app()->getLocale() == 'en' ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}">
                <i class="fas fa-language w-5 text-center"></i>
                <span class="text-sm font-medium">English</span>
            </a>

            <a href="{{ route('language.switch', ['lang' => 'id']) }}"
                class="flex items-center gap-3 p-3 rounded-lg transition-colors
                      {{ app()->getLocale() == 'id' ? 'bg-indigo-900/30 text-indigo-400' : 'hover:bg-gray-800 text-gray-400' }}">
                <i class="fas fa-language w-5 text-center"></i>
                <span class="text-sm font-medium">Indonesia</span>
            </a>
        </div>
    </div>
</nav>

<!-- JavaScript for Sidebar Toggle -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuButton = document.getElementById("mobile-toggle");
        const closeButton = document.getElementById("close-sidebar");
        const sidebar = document.getElementById("sidebar");

        menuButton.addEventListener("click", function() {
            sidebar.classList.remove("-translate-x-full");
        });

        closeButton.addEventListener("click", function() {
            sidebar.classList.add("-translate-x-full");
        });
    });
</script>