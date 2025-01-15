@extends('layouts.app')

@section('title', 'Detail Hospital')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl text-center font-bold mb-6">{{ $hospital->name }}</h1>
        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Pasien Terpasang Ventilator</h2>
                <p class="text-3xl mt-2">{{ $intubatedCount }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Total Observasi Bulan Ini</h2>
                <p class="text-3xl mt-2">{{ $totalPatientsThisMonth }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Jumlah Ventilator</h2>
                <p class="text-3xl mt-2">{{ $hospital->venti }}</p>
            </div>
        </div>


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
                ajax: '{{ route('hospital.details', $hospital->id) }}',
                columns: [
                    { data: 'id', name: 'id' },
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
                        return meta.row + 1 + meta.settings._iDisplayStart;
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
