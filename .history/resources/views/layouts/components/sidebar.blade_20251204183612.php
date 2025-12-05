<aside id="sidebar" class="sidebar bg-gray-900 text-gray-300 w-64 flex-shrink-0 overflow-y-auto no-scrollbar">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-5">
            <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center shadow-lg">
                <img src="image/LogoDLaundry.png" alt="D`Laundry Logo" style="opacity: .8">
            </div>
            <span class="text-xl font-bold text-white sidebar-text">D`Laundry</span>
        </div>
        <div class="border-t border-gray-700 mb-5"></div>

        <!-- Menu -->
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="/dashboard" class="menu-item @if(request()->is('dashboard*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="sidebar-text font-medium">Dashboard</span>
            </a>

            <!-- User Management -->
            <a href="/users" class="menu-item @if(request()->is('users*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="sidebar-text font-medium">Kelola User</span>
            </a>

            <!-- Customer -->
            <a href="/pelanggan" class="menu-item @if(request()->is('pelanggan*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="sidebar-text font-medium">Pelanggan</span>
            </a>

            <!-- Layanan -->
            <a href="/layanan" class="menu-item @if(request()->is('layanan*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                </svg>
                <span class="sidebar-text font-medium">Layanan</span>
            </a>

            <!-- Order -->
            <div class="space-y-1">
                <a href="/orders" class="menu-item @if(request()->is('orders*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="sidebar-text font-medium">Orders</span>
                </a>
            </div>

            <!-- Proses Laundry -->
            {{-- <a href="/proses/laundry" class="menu-item @if(request()->is('proses/laundry*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span class="sidebar-text font-medium">Proses Laundry</span>
            </a> --}}

            <!-- Laporan -->
            <a href="/laporan" class="menu-item @if(request()->is('laporan*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="sidebar-text font-medium">Laporan</span>
            </a>
            <a href="/about-us" class="menu-item @if(request()->is('about-us')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z"/>
    </svg>
                <span class="sidebar-text font-medium">About Us</span>
            </a>
        </nav>
    </div>
</aside>
