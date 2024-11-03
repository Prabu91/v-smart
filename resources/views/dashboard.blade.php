@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Observasi Pasien ICU/PICU</h1>
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Total Pasien ICU</h2>
            <p class="text-3xl mt-2">25</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Pasien Intubasi</h2>
            <p class="text-3xl mt-2">8</p>
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Venti Yang digunakan Hari ini</h2>
            <p class="text-3xl mt-2">12</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Jumlah Total Venti</h2>
            <p class="text-3xl mt-2">12</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold">Jumlah Ruangan ICU/PICU/ICCU/NICU</h2>
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
        <h2 class="text-xl font-bold mb-4">Data Pasien</h2>
        <table id="patients-table" class="table-auto w-full text-left">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No JKN</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                    <th>Ruangan</th>
                    <th>Tanggal Masuk Ruangan</th>
                    <th>Terakhir Update Data</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>        
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#patients-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('dashboard') }}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'no_jkn', name: 'no_jkn' },
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status' },
                { data: 'room', name: 'room' },
                { data: 'room_date', name: 'room_date' },
                { data: 'updated_time', name: 'updated_time' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            columnDefs: [
                { targets: 0, render: function (data, type, row, meta) {
                    return meta.row + 1; // Numbering rows starting from 1
                }}
            ],
            language: {
                emptyTable: "Belum Ada Data Pasien"
            }
        });
    });

</script>
@endpush



@endsection
