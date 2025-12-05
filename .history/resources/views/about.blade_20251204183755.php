@extends('layouts.frame')
@section('Title', 'About Us')
@section('HeaderTitle', 'About Us')
@section('Description', 'Deskripsi singkat aplikasi dan ko')
@section('MainContentArea')

<div class="bg-white p-10 rounded-2xl shadow-md border border-gray-100">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold text-gray-900">About Us</h1>
    <p class="text-purple-600 font-semibold mt-1 mb-6">
        Laundry Management System – UTS PTI 2025
    </p>

    <!-- DESCRIPTION -->
    <div class="max-w-3xl space-y-5 text-gray-700 leading-relaxed mb-10">

        <p>
            Halaman ini disusun sebagai bagian dari pemenuhan tugas Ujian Tengah Semester (UTS)
            pada mata kuliah <strong>Penerapan Teknologi Internet</strong>
            yang dibimbing oleh Bapak <strong>Chrismikha Hardyanto, S.Kom., M.Kom.</strong>
            sesuai dengan ketentuan pada lembar soal UTS.
        </p>

        <blockquote class="border-l-4 border-purple-500 pl-4 italic text-gray-600">
            “Aplikasi ini dikembangkan untuk memenuhi aspek CRUD, autentikasi, manajemen data,
            serta menerapkan desain antarmuka modern agar mudah digunakan.”
        </blockquote>

        <p>
            Dalam tugas ini, kelompok kami mengembangkan sebuah aplikasi bernama
            <strong>Laundry Management System</strong>, yang dirancang untuk membantu operasional
            usaha laundry agar lebih efisien, terstruktur, dan mudah diakses. Sistem ini mengelola
            data pelanggan, layanan, pesanan, status pengerjaan, hingga pembayaran.
        </p>

        <p>
            Seluruh fitur dirancang agar admin dapat melakukan input, pencarian, pengurutan data,
            dan pembaruan informasi secara cepat dan akurat. Selain itu, tampilan aplikasi dibuat
            responsif dan nyaman digunakan.
        </p>

        <p>
            Proyek ini dikerjakan secara berkelompok selama 2 minggu, dengan pembagian tugas seperti
            analisis kebutuhan, desain UI, implementasi backend, integrasi database, dan pengujian
            aplikasi. Kerja sama dan komunikasi menjadi aspek penting dalam penyelesaian project ini.
        </p>

    </div>

    <hr class="my-10 border-gray-200">

    <!-- TEAM TITLE -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Our Team</h2>

    <!-- TEAM LIST -->
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5">

        <!-- MEMBER -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                D
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Dodi Bahari</h3>
                <p class="text-gray-600 text-sm">10123316 • Peran dalam tim</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                M
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Moh Fauzi Einstein</h3>
                <p class="text-gray-600 text-sm">10123322 • Peran dalam tim</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                R
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Rizki Ilham Putra Pratama</h3>
                <p class="text-gray-600 text-sm">10123329 • Peran dalam tim</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                A
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Ahmad Zuhri Wirahanif</h3>
                <p class="text-gray-600 text-sm">10123334 • Peran dalam tim</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow transition">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold">
                B
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Bararta Hamza</h3>
                <p class="text-gray-600 text-sm">10123343 • Peran dalam tim</p>
            </div>
        </div>

    </div>

</div>

@endsection