<nav class="fixed w-full bg-white/90 backdrop-blur-lg z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center space-x-3">
                <img  src="{{ asset('image/LogoDLaundry.png') }}"  alt="D`Laundry" class="h-12 w-auto opacity-80">
                <a href="/">
                    <span class="text-2xl font-bold text-gray-900">D`Laundry</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-10">
                <a href="#layanan" class="text-gray-700 hover:text-purple-600 font-medium transition">Layanan</a>
                <a href="#harga" class="text-gray-700 hover:text-purple-600 font-medium transition">Harga</a>
                <a href="#tracking" class="text-gray-700 hover:text-purple-600 font-medium transition">Tracking</a>
                <a href="#keunggulan" class="text-gray-700 hover:text-purple-600 font-medium transition">Keunggulan</a>
                <a href="#testimoni" class="text-gray-700 hover:text-purple-600 font-medium transition">Testimoni</a>
                {{-- <a href="/customer-orders" class="text-gray-700 hover:text-purple-600 transition flex items-center" aria-label="Keranjang Belanja">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M3 3h2l2.5 12h10l2-8H6.5" />
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="17" cy="20" r="1" />
                    </svg>
                </a> --}}
                <a href="/customer-orders" class="text-gray-700 hover:text-purple-600 transition flex items-center relative" aria-label="Keranjang Belanja">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M3 3h2l2.5 12h10l2-8H6.5" />
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="17" cy="20" r="1" />
                    </svg>
                    <!-- Cart Counter Badge -->
                    <span id="cartBadge" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">
                        0
                    </span>
                </a>
            </div>

            @auth('pelanggan')
                <div class="relative group">
                    <button class="flex items-center space-x-3 text-black-600 px-6 py-2.5 rounded-xl font-semibold hover:opacity-90 transition">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span>{{ Auth::guard('pelanggan')->user()->nama }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                        <div class="p-2">
                            {{-- <a href="/customer/profile" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-xl transition">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">Profil Saya</span>
                            </a> --}}
                            <a href="/customer-dashboard" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-xl transition">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="/customer-ordersList" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-xl transition">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="font-medium">Pesanan Saya</span>
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <button id="btnLogoutCustomer" type="button" class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="font-medium">Logout</span>
                            </button>
                            <form id="logoutFormCustomer" action="{{ route('customer.logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-3">
                    <a href="/customer-login" class="text-gray-700 hover:text-purple-800 px-6 py-2.5 rounded-xl font-semibold hover:bg-white-50 transition border-2 border-transparent hover:border-purple-300">
                        Masuk
                    </a>
                    <a href="/customer-register" class="gradient-primary text-white px-7 py-2.5 rounded-xl font-semibold hover:opacity-90 transition shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
<script>
    document.getElementById("btnLogoutCustomer").addEventListener("click", function () {
        Swal.fire({
            title: "Anda yakin ingin logout?",
            text: "Sesi Anda akan diakhiri.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6D28D9",
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logoutFormCustomer").submit();
            }
        });
    });
</script>
<script>
// Script untuk update cart badge di navbar
document.addEventListener('DOMContentLoaded', function() {
    const cartBadge = document.getElementById('cartBadge');
    
    // Fungsi untuk update badge
    function updateBadge() {
        const cartCount = localStorage.getItem('cartCount') || 0;
        if (cartBadge) {
            if (cartCount > 0) {
                cartBadge.textContent = cartCount;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
    }
    
    // Update saat halaman dimuat
    updateBadge();
    
    // Listen untuk perubahan cart
    window.addEventListener('cartUpdated', function(e) {
        updateBadge();
    });
    
    // Cek perubahan localStorage dari tab lain
    window.addEventListener('storage', function(e) {
        if (e.key === 'cartCount') {
            updateBadge();
        }
    });
});
</script>
<style>
/* Cart Badge Animation */
#cartBadge {
    animation: pulse 0.3s ease-in-out;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Smooth transition */
#cartBadge.hidden {
    display: none !important;
}
</style>
