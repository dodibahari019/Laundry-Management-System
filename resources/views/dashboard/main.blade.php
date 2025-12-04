<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CleanPro Laundry Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .menu-item {
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
        }

        .menu-item.active {
            background: rgba(102, 126, 234, 0.15);
            border-left: 4px solid #667eea;
            color: #667eea;
        }

        .status-badge {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .8; }
        }

        .notification-dot {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-gray-900 text-gray-300 w-64 flex-shrink-0 overflow-y-auto">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white sidebar-text">CleanPro</span>
                </div>

                <!-- Menu -->
                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <a href="#" class="menu-item active flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Dashboard</span>
                    </a>

                    <!-- Order -->
                    <div class="space-y-1">
                        <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span class="sidebar-text font-medium">Order</span>
                            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">12</span>
                        </a>
                    </div>

                    <!-- Layanan -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Layanan</span>
                    </a>

                    <!-- Proses Laundry -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Proses Laundry</span>
                    </a>

                    <!-- Customer -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Customer</span>
                    </a>

                    <!-- Pembayaran -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Pembayaran</span>
                    </a>

                    <!-- Laporan -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Laporan</span>
                    </a>

                    <div class="border-t border-gray-700 my-4"></div>

                    <!-- User Management (Admin Only) -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Kelola User</span>
                    </a>

                    <!-- Settings -->
                    <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="sidebar-text font-medium">Pengaturan</span>
                    </a>
                </nav>
            </div>

            <!-- User Info Bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gray-800 border-t border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center text-white font-bold">
                        AS
                    </div>
                    <div class="sidebar-text flex-1">
                        <p class="text-sm font-semibold text-white">Admin Sari</p>
                        <p class="text-xs text-gray-400">Kasir</p>
                    </div>
                    <button class="text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                            <p class="text-sm text-gray-500">Selamat datang kembali, Admin Sari! 👋</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Cari order, customer..." class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full notification-dot"></span>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Quick Action -->
                        <button class="gradient-primary text-white px-6 py-2.5 rounded-xl font-semibold hover:opacity-90 transition shadow-lg flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Order Baru</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-green-600 text-sm font-semibold flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                                +12%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Order Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">28</p>
                        <p class="text-xs text-gray-400 mt-2">Dari kemarin: 25 order</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">PROSES</span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Dalam Proses</h3>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                        <p class="text-xs text-gray-400 mt-2">8 cuci • 4 setrika</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">SELESAI</span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Selesai Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">16</p>
                        <p class="text-xs text-gray-400 mt-2">14 sudah diambil</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-purple-600 text-sm font-semibold flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                                +8%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Pendapatan Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp 3.2jt</p>
                        <p class="text-xs text-gray-400 mt-2">Target: Rp 4jt</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Section (2 cols) -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Order Queue -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-900">Antrian Order</h2>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">5 MENUNGGU</span>
                            </div>

                            <div class="space-y-3">
                                <!-- Queue Item 1 -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl border-l-4 border-red-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                            <span class="text-red-600 font-bold">#1023</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Budi Santoso</p>
                                            <p class="text-sm text-gray-500">Cuci + Setrika Express • 5kg</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">MENUNGGU CUCI</span>
                                        <button class="gradient-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90">
                                            Proses
                                        </button>
                                    </div>
                                </div>

                                <!-- Queue Item 2 -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border-l-4 border-yellow-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                            <span class="text-yellow-600 font-bold">#1024</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Siti Aminah</p>
                                            <p class="text-sm text-gray-500">Cuci Kering • 3kg</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">SEDANG DICUCI</span>
                                        <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200">
                                            Update
                                        </button>
                                    </div>
                                </div>
<!-- Queue Item 3 -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-l-4 border-blue-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                            <span class="text-blue-600 font-bold">#1025</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Ahmad Fauzi</p>
                                            <p class="text-sm text-gray-500">Cuci Satuan - Jas • 2pcs</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">SEDANG SETRIKA</span>
                                        <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200">
                                            Update
                                        </button>
                                    </div>
                                </div>

                                <!-- Queue Item 4 -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-l-4 border-green-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                            <span class="text-green-600 font-bold">#1026</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Dewi Lestari</p>
                                            <p class="text-sm text-gray-500">Cuci + Setrika • 4kg</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">SIAP DIAMBIL</span>
                                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700">
                                            Selesai
                                        </button>
                                    </div>
                                </div>

                                <!-- Queue Item 5 -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-l-4 border-purple-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                            <span class="text-purple-600 font-bold">#1027</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Rina Kusuma</p>
                                            <p class="text-sm text-gray-500">Cuci Kering Express • 7kg</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">MENUNGGU CUCI</span>
                                        <button class="gradient-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90">
                                            Proses
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button class="w-full mt-4 text-purple-600 font-semibold py-2 hover:bg-purple-50 rounded-lg transition">
                                Lihat Semua Order →
                            </button>
                        </div>

                        <!-- Recent Orders Table -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-900">Riwayat Order Terbaru</h2>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 bg-purple-100 text-purple-600 rounded-lg text-sm font-semibold">Semua</button>
                                    <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-200">Selesai</button>
                                    <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-200">Proses</button>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Nomor Nota</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Customer</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Layanan</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                                            <th class="text-right py-3 px-4 text-sm font-semibold text-gray-600">Total</th>
                                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-semibold text-gray-900">#LDY-1027</span>
                                                <p class="text-xs text-gray-500">29 Nov 2024</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-medium text-gray-900">Rina Kusuma</p>
                                                <p class="text-xs text-gray-500">0812-3456-7890</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="text-sm text-gray-900">Cuci Kering Express</p>
                                                <p class="text-xs text-gray-500">7kg</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Proses</span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <p class="font-bold text-gray-900">Rp 105.000</p>
                                                <p class="text-xs text-green-600">Lunas</p>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button class="text-purple-600 hover:text-purple-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-semibold text-gray-900">#LDY-1026</span>
                                                <p class="text-xs text-gray-500">29 Nov 2024</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-medium text-gray-900">Dewi Lestari</p>
                                                <p class="text-xs text-gray-500">0813-2345-6789</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="text-sm text-gray-900">Cuci + Setrika</p>
                                                <p class="text-xs text-gray-500">4kg</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Siap Diambil</span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <p class="font-bold text-gray-900">Rp 32.000</p>
                                                <p class="text-xs text-green-600">Lunas</p>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button class="text-purple-600 hover:text-purple-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-semibold text-gray-900">#LDY-1025</span>
                                                <p class="text-xs text-gray-500">29 Nov 2024</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-medium text-gray-900">Ahmad Fauzi</p>
                                                <p class="text-xs text-gray-500">0811-9876-5432</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="text-sm text-gray-900">Cuci Satuan - Jas</p>
                                                <p class="text-xs text-gray-500">2pcs</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Setrika</span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <p class="font-bold text-gray-900">Rp 50.000</p>
                                                <p class="text-xs text-red-600">Belum Bayar</p>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button class="text-purple-600 hover:text-purple-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-semibold text-gray-900">#LDY-1024</span>
                                                <p class="text-xs text-gray-500">28 Nov 2024</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-medium text-gray-900">Siti Aminah</p>
                                                <p class="text-xs text-gray-500">0814-5678-9012</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="text-sm text-gray-900">Cuci Kering</p>
                                                <p class="text-xs text-gray-500">3kg</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Cuci</span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <p class="font-bold text-gray-900">Rp 30.000</p>
                                                <p class="text-xs text-green-600">Lunas</p>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button class="text-purple-600 hover:text-purple-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-semibold text-gray-900">#LDY-1023</span>
                                                <p class="text-xs text-gray-500">28 Nov 2024</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-medium text-gray-900">Budi Santoso</p>
                                                <p class="text-xs text-gray-500">0815-1234-5678</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="text-sm text-gray-900">Cuci + Setrika Express</p>
                                                <p class="text-xs text-gray-500">5kg</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Menunggu</span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <p class="font-bold text-gray-900">Rp 75.000</p>
                                                <p class="text-xs text-green-600">Lunas</p>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button class="text-purple-600 hover:text-purple-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Right Section (1 col) -->
                    <div class="space-y-6">
                        
                        <!-- Revenue Chart -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Pendapatan Mingguan</h3>
                            <canvas id="revenueChart" height="200"></canvas>
                        </div>

                        <!-- Important Notifications -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Notifikasi Penting</h3>
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold">3</span>
                            </div>

                            <div class="space-y-3">
                                <!-- Notification 1 -->
                                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-5 h-5 text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900">Order Terlambat</p>
                                            <p class="text-xs text-gray-600 mt-1">2 order melewati estimasi waktu selesai</p>
                                            <button class="text-xs text-red-600 font-semibold mt-2 hover:underline">Lihat Detail →</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notification 2 -->
                                <div class="p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900">Belum Diambil</p>
                                            <p class="text-xs text-gray-600 mt-1">4 order sudah selesai >3 hari belum diambil</p>
                                            <button class="text-xs text-yellow-600 font-semibold mt-2 hover:underline">Hubungi Customer →</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notification 3 -->
                                <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900">Customer Baru</p>
                                            <p class="text-xs text-gray-600 mt-1">5 customer baru mendaftar hari ini</p>
                                            <button class="text-xs text-blue-600 font-semibold mt-2 hover:underline">Lihat Data →</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl p-6 text-white">
                            <h3 class="text-lg font-bold mb-4">Statistik Bulan Ini</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Total Order</span>
                                    </div>
                                    <span class="text-2xl font-bold">842</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Pendapatan</span>
                                    </div>
                                    <span class="text-2xl font-bold">89jt</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Customer</span>
                                    </div>
                                    <span class="text-2xl font-bold">348</span>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Customer Activity -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivitas Customer Terbaru</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Rina Kusuma</p>
                                        <p class="text-xs text-gray-500">Menambah order baru</p>
                                    </div>
                                    <span class="text-xs text-gray-400">5 menit lalu</span>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Ahmad Fauzi</p>
                                        <p class="text-xs text-gray-500">Melakukan pembayaran</p>
                                    </div>
                                    <span class="text-xs text-gray-400">15 menit lalu</span>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Dewi Lestari</p>
                                        <p class="text-xs text-gray-500">Mengambil cucian</p>
                                    </div>
                                    <span class="text-xs text-gray-400">1 jam lalu</span>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Budi Santoso</p>
                                        <p class="text-xs text-gray-500">Registrasi customer baru</p>
                                    </div>
                                    <span class="text-xs text-gray-400">2 jam lalu</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

    <!-- Chart.js Script -->
    <script>
        // Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Pendapatan (Ribu)',
                    data: [450, 520, 380, 650, 720, 890, 800],
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y + '.000';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return value + 'k';
                            },
                            color: '#9CA3AF',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9CA3AF',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            
            sidebarTexts.forEach(text => {
                text.classList.toggle('hidden');
            });
        });

        // Search functionality (placeholder)
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('input', (e) => {
            console.log('Searching for:', e.target.value);
            // Add your search logic here
        });

        // Quick stats animation on load
        window.addEventListener('load', () => {
            const statCards = document.querySelectorAll('.hover-scale');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });

        // Add click handlers for buttons (placeholder)
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', (e) => {
                // Prevent default for demo
                if (button.textContent.includes('Proses') || 
                    button.textContent.includes('Update') || 
                    button.textContent.includes('Selesai')) {
                    e.preventDefault();
                    console.log('Button clicked:', button.textContent);
                    // Add your actual functionality here
                }
            });
        });

        // Notification badge animation
        setInterval(() => {
            const notificationBadges = document.querySelectorAll('.notification-dot');
            notificationBadges.forEach(badge => {
                badge.style.animation = 'none';
                setTimeout(() => {
                    badge.style.animation = 'ping 1s cubic-bezier(0, 0, 0.2, 1) infinite';
                }, 10);
            });
        }, 3000);

        // Table row hover effect
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'scale(1.01)';
                row.style.transition = 'transform 0.2s ease';
            });
            
            row.addEventListener('mouseleave', () => {
                row.style.transform = 'scale(1)';
            });
        });

        // Status badge pulse animation
        const statusBadges = document.querySelectorAll('.status-badge');
        statusBadges.forEach(badge => {
            setInterval(() => {
                badge.style.opacity = '0.8';
                setTimeout(() => {
                    badge.style.opacity = '1';
                }, 500);
            }, 2000);
        });

        // Add real-time clock to header
        function updateClock() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const timeString = now.toLocaleDateString('id-ID', options);
            
            // You can add a clock element to the header if needed
            console.log('Current time:', timeString);
        }

        setInterval(updateClock, 60000); // Update every minute
        updateClock(); // Initial call

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading state for buttons
        document.querySelectorAll('button.gradient-primary').forEach(button => {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = `
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 1000);
            });
        });

        // Auto-hide notifications after 5 seconds
        setTimeout(() => {
            const notificationDots = document.querySelectorAll('.notification-dot');
            notificationDots.forEach(dot => {
                dot.style.animation = 'none';
            });
        }, 5000);

        console.log('CleanPro Dashboard loaded successfully! 🎉');
    </script>

</body>
</html>