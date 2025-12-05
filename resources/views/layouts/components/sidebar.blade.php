<aside id="sidebar" class="sidebar bg-gray-900 text-gray-300 w-64 flex-shrink-0 overflow-y-auto no-scrollbar">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-5">
            <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-13 w-auto opacity-80">
            <span class="text-xl font-bold text-white sidebar-text">D`Laundry</span>
        </div>
        <div class="border-t border-gray-700 mb-5"></div>

        <!-- Menu -->
        <nav class="space-y-2">
            @if($role_login == 'admin')
                @include('layouts.components.sidebarAdmin')
            @elseif($role_login == 'kasir' || $role_login == 'petugas')
                <!-- Order -->
                <a href="/orders" class="menu-item @if(request()->is('orders*')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="sidebar-text font-medium">Orders</span>
                </a>
            @endif
            <a href="/about-us" class="menu-item @if(request()->is('about-us')) active @endif flex items-center space-x-3 px-4 py-3 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z"/>
                </svg>
                <span class="sidebar-text font-medium">About Us</span>
            </a>
        </nav>
    </div>
</aside>
