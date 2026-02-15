<header class="bg-white border-b border-gray-200 px-8 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">@yield('HeaderTitle')</h1>
                <p class="text-sm text-gray-500">@yield('Description')</p>
            </div>
        </div>

        <!-- User Info & Logout -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 bg-gray-50 rounded-xl px-4 py-2 border border-gray-200">
                @php
                    $initials = '';
                    $parts = explode(' ', $nama_login);
                    if (count($parts) > 0) {
                        $initials .= strtoupper(substr($parts[0], 0, 1)); // huruf pertama nama depan
                    }
                    if (count($parts) > 1) {
                        $initials .= strtoupper(substr(end($parts), 0, 1)); // huruf pertama nama belakang
                    }
                @endphp

                <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                    {{$initials}}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{$username_login}}</p>
                    <p class="text-xs text-gray-500">{{$role_login}}</p>
                </div>
            </div>
            <button id="btnLogout" class="flex items-center space-x-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
            <form id="logoutForm" action="/logout" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</header>
<script>
document.getElementById("btnLogout").addEventListener("click", function () {
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
            document.getElementById("logoutForm").submit();
        }
    });
});
</script>
