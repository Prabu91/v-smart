@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Observasi Pasien ICU/PICU</h1>
    
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Total Pasien ICU</h2>
            <p class="text-3xl mt-2">25</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Pasien Diekstubasi</h2>
            <p class="text-3xl mt-2">8</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Pasien Diobservasi Hari Ini</h2>
            <p class="text-3xl mt-2">12</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="mb-4">
        <label for="filter" class="block text-sm font-medium text-gray-700">Filter Pasien</label>
        <select id="filter" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm">
            <option value="">Semua Ruangan</option>
            <option value="asal_ruangan">Asal Ruangan</option>
            <option value="icu">ICU</option>
            <option value="ruangan_lain">Pindah ke Ruangan Lain</option>
        </select>
    </div>

    <!-- Tabel Daftar Pasien -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Daftar Pasien</h2>
        <table id="patients-table" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">No. CM</th>
                    <th class="px-4 py-2 border-b">Nama Pasien</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Pasien -->
                <tr>
                    <td class="px-4 py-2 border-b text-center">123456</td>
                    <td class="px-4 py-2 border-b">John Doe</td>
                    <td class="px-4 py-2 border-b text-center">Baru</td>
                    <td class="px-4 py-2 border-b text-center">2024-10-15</td>
                </tr>
                <!-- Tambah data pasien lain di sini -->
            </tbody>
        </table>
    </div>
</div>



@endsection
