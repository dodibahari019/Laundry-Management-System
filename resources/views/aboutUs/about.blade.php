@extends('layouts.frame')
@section('Title', 'About Us')
@section('HeaderTitle', 'About Us')
@section('Description', 'Deskripsi singkat aplikasi dan daftar anggota kelompok')
@section('MainContentArea')

<div class="bg-white p-10 rounded-2xl shadow-md border border-gray-100">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold text-gray-900">About Us</h1>
    <p class="text-purple-600 font-semibold mt-1 mb-6">
        Laundry Management System – UAS PTI 2026
    </p>

    <!-- DESCRIPTION -->
    <div class="max-w-3xl space-y-5 text-gray-700 leading-relaxed mb-10">

        <p>
            Halaman ini disusun sebagai bagian dari pemenuhan tugas Ujian Tengah Semester (UAS)
            pada mata kuliah <strong>Penerapan Teknologi Internet</strong>
            yang dibimbing oleh Bapak <strong>Chrismikha Hardyanto, S.Kom., M.Kom.</strong>
            sesuai dengan ketentuan pada lembar soal UAS.
        </p>

        <blockquote class="border-l-4 border-purple-500 pl-4 italic text-gray-600">
            "Aplikasi ini dikembangkan untuk memenuhi aspek CRUD, autentikasi, manajemen data,
            serta menerapkan desain antarmuka modern yang responsif dan mudah digunakan dengan
            memanfaatkan teknologi web terkini."
        </blockquote>

        <p>
            Dalam tugas ini, kelompok kami mengembangkan sebuah aplikasi bernama
            <strong>Laundry Management System</strong>, yang dirancang untuk membantu operasional
            usaha laundry agar lebih efisien, terstruktur, dan mudah diakses. Sistem ini mengelola
            berbagai aspek bisnis laundry mulai dari pendaftaran pelanggan, manajemen layanan, 
            pemesanan dengan sistem pickup, tracking status real-time, hingga pembayaran terintegrasi 
            dengan payment gateway Midtrans.
        </p>

        <p>
            <strong>Fitur-fitur utama aplikasi meliputi:</strong>
        </p>
        
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Manajemen Pelanggan:</strong> Registrasi akun dengan verifikasi email, autentikasi Google OAuth, dan profil pelanggan yang dapat dikelola secara mandiri.</li>
            <li><strong>Sistem Pemesanan:</strong> Form pemesanan multi-step dengan integrasi peta interaktif (Leaflet) untuk menentukan lokasi pickup, pilihan slot waktu pickup, dan instruksi khusus untuk driver.</li>
            <li><strong>Manajemen Layanan:</strong> Katalog layanan lengkap dengan kategori kiloan dan satuan, upload foto layanan, dan perhitungan harga otomatis.</li>
            <li><strong>Tracking Real-Time:</strong> Pelanggan dapat melacak status cucian mereka secara real-time dengan timeline status yang informatif dari menunggu hingga selesai diambil.</li>
            <li><strong>Payment Gateway:</strong> Integrasi pembayaran digital dengan Midtrans Snap untuk mendukung berbagai metode pembayaran (QRIS, transfer bank, e-wallet).</li>
            <li><strong>Dashboard Admin:</strong> Panel administrasi lengkap untuk mengelola pesanan, update status, manajemen layanan, pelanggan, pengeluaran, dan laporan keuangan.</li>
            <li><strong>Sistem Laporan:</strong> Generate laporan transaksi, pendapatan, pelanggan, layanan, pengeluaran, dan keuangan dengan export ke PDF untuk keperluan analisis bisnis.</li>
        </ul>

        <p>
            Seluruh fitur dirancang dengan prinsip <strong>user experience</strong> yang baik, 
            memungkinkan admin dan pelanggan untuk melakukan input data, pencarian dengan filter dinamis, 
            pengurutan data, dan pembaruan informasi secara cepat dan akurat. Tampilan aplikasi dibuat 
            responsif menggunakan <strong>Tailwind CSS</strong> dengan desain modern yang nyaman digunakan 
            di berbagai perangkat (desktop, tablet, dan mobile).
        </p>

        <p>
            <strong>Teknologi yang Digunakan:</strong>
        </p>
        
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Backend:</strong> Laravel 11 dengan PHP 8.2 sebagai framework utama</li>
            <li><strong>Frontend:</strong> Blade Template Engine, Tailwind CSS, JavaScript ES6+, jQuery untuk interaksi dinamis</li>
            <li><strong>Database:</strong> MySQL/MariaDB dengan relasi yang terstruktur</li>
            <li><strong>Payment Gateway:</strong> Midtrans Snap untuk transaksi pembayaran</li>
            <li><strong>Map Integration:</strong> Leaflet.js dengan OpenStreetMap untuk lokasi pickup</li>
            <li><strong>Authentication:</strong> Laravel Sanctum, Google OAuth 2.0, Email Verification</li>
            <li><strong>PDF Generation:</strong> DomPDF untuk export laporan</li>
            <li><strong>Email Service:</strong> SMTP configuration untuk notifikasi dan verifikasi</li>
        </ul>

        <p>
            Aplikasi ini tidak hanya memenuhi kebutuhan akademis, tetapi juga dirancang untuk dapat 
            diimplementasikan secara nyata dalam bisnis laundry. Dengan fitur-fitur yang lengkap dan 
            user-friendly, <strong>Laundry Management System</strong> siap membantu pemilik usaha 
            laundry dalam meningkatkan efisiensi operasional dan memberikan pengalaman terbaik bagi pelanggan.
        </p>

    </div>

    <hr class="my-10 border-gray-200">

    <!-- TEAM TITLE -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Our Team</h2>

    <!-- TEAM LIST -->
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5">

        <!-- MEMBER 1 -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                D
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Dodi Bahari</h3>
                <p class="text-gray-600 text-sm">10123316</p>
            </div>
        </div>

        <!-- MEMBER 2 -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                M
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Moh Fauzi Einstein</h3>
                <p class="text-gray-600 text-sm">10123322</p>
            </div>
        </div>

        <!-- MEMBER 3 -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                R
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Rizki Ilham Putra Pratama</h3>
                <p class="text-gray-600 text-sm">10123329</p>
            </div>
        </div>

        <!-- MEMBER 4 -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                A
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Ahmad Zuhri Wirahanif</h3>
                <p class="text-gray-600 text-sm">10123334</p>
            </div>
        </div>

        <!-- MEMBER 5 -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                B
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Bararta Hamza</h3>
                <p class="text-gray-600 text-sm">10123343</p>
            </div>
        </div>

    </div>
</div>

@endsection