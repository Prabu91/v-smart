@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Dashboard Monitoring Penggunaan Ventilator</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        @foreach($hospitals as $hospital)
        <div class="bg-white shadow-md rounded-lg p-6 text-center md:text-left">
            <div class="card-header">
                <h2 class="text-xl font-bold">
                    <a href="{{ route('hospital.details', $hospital['id']) }}" class="text-grey-500 hover:underline">
                        {{ $hospital->hospital }}
                    </a>
                </h2> 
            </div>
            <div class="card-body"> 
                <p class="text-3xl mt-2 font-semibold">
                    {{ $hospital->intubated_count }} / {{ $hospital->ventilators_count }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
        <h2 class="text-2xl font-bold mb-4 text-center md:text-left">Semua Data Pasien</h2>
        <table id="patients-table" class="table-auto w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Rumah Sakit</th>
                    <th class="px-4 py-2">No RM</th>
                    <th class="px-4 py-2">Nama Pasien</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Ruangan</th>
                    <th class="px-4 py-2">Tanggal Masuk Ruangan</th>
                    <th class="px-4 py-2">Terakhir Update Data</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
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
                { data: 'hospital', name: 'hospital'},
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
                    return meta.row + 1 + meta.settings._iDisplayStart; // Numbering rows starting from 1
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
