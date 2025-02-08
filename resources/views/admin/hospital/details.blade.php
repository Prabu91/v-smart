@extends('layouts.app')

@section('title', 'Detail Hospital')

@section('content')

<nav class="flex" aria-label="Breadcrumb">
	<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
		<li class="inline-flex items-center">
		<a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-grey-900 dark:text-gray-400 dark:hover:text-slate-900">
			<svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
			<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
			</svg>
			Home
		</a>
		</li>
		<li aria-current="page">
		<div class="flex items-center">
			<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
			</svg>
			<span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-grey-900">Detail Data di Rumah Sakit</span>
		</div>
		</li>
	</ol>
</nav>

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
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Data Pasien</h2>
                <div class="flex flex-wrap gap-2">
                    <p class="flex items-center">Filter :</p>
                    <select id="filter-year" class="border border-gray-300 rounded px-3 py-2 focus:outline-none">
                        <option value="">Semua Tahun</option>
                        @foreach(range(date('Y'), date('Y') - 5) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>    
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
        let table = $('#patients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('hospital.details', $hospital->id) }}',
                    data: function(d) {
                        d.year = $('#filter-year').val();
                    }
                },
                pageLength: 10,
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

            $('#filter-year').change(function() {
                table.ajax.reload();
            });
        });
    </script>
@endpush
@endsection
