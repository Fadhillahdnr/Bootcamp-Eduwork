<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b"
     style="background-color: var(--bg-soft); border-color: var(--border-soft);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 font-bold text-lg"
                   style="color: var(--text-main);">
                    <x-application-logo class="h-9 w-auto"
                        style="fill: var(--primary);" />
                    <span>Admin Panel</span>
                </a>

                <!-- MENU -->
                <div class="hidden sm:flex items-center gap-6">

                    <a href="{{ route('admin.dashboard') }}"
                       class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>

                    <a href="{{ route('admin.orders') }}"
                       class="admin-nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        📦 Pesanan
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                       class="admin-nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        🛒 Produk
                    </a>

                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden sm:flex items-center gap-4">

                <!-- USER DROPDOWN -->
                <div x-data="{ openUser:false }" class="relative">

                    <button @click="openUser=!openUser"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg transition"
                        style="background: var(--bg-card); color: var(--text-main);">

                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 opacity-70" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </button>

                    <!-- DROPDOWN -->
                    <div x-show="openUser" @click.away="openUser=false"
                        class="absolute right-0 mt-2 w-44 rounded-xl shadow-lg overflow-hidden"
                        style="background: var(--bg-card); border:1px solid var(--border-soft);">

                        <a href="{{ route('profile.edit') }}"
                           class="dropdown-item">
                            👤 Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger w-full text-left">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">
                <button @click="open=!open"
                    class="p-2 rounded-lg"
                    style="color: var(--text-main);">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="sm:hidden px-4 py-4 space-y-2"
         style="background-color: var(--bg-soft); border-top:1px solid var(--border-soft);">

        <a href="{{ route('admin.dashboard') }}" class="mobile-link">Dashboard</a>
        <a href="{{ route('admin.orders') }}" class="mobile-link">Pesanan</a>
        <a href="{{ route('admin.products.index') }}" class="mobile-link">Produk</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="mobile-link text-danger w-full text-left">
                Logout
            </button>
        </form>
    </div>
</nav>
