@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    
    <div class="container mx-auto px-4 py-6">
        @if (Auth::User()->role === 'user')
            <h1 class="text-3xl font-bold text-center md:text-left mb-6">
                Dashboard Penggunaan Ventilator
            </h1>
        
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="bg-white shadow-md rounded-lg p-6 text-center sm:text-left">
                    <h2 class="text-xl font-bold text-gray-700">Pasien Terpasang Ventilator</h2>
                    <p class="text-3xl font-semibold text-grey-600 mt-2">{{ $intubatedCount }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center sm:text-left">
                    <h2 class="text-xl font-bold text-gray-700">Jumlah Ventilator</h2>
                    <p class="text-3xl font-semibold text-grey-600 mt-2">{{ $user->userDetails->venti }}</p>
                </div>
            </div>
            @else
            <h1 class="text-3xl font-bold mb-6 text-center md:text-left">Dashboard Monitoring Penggunaan Ventilator</h1>
        
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

        @endif



        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Data Pasien</h2>
            <div class="overflow-x-auto">
                <table id="patients-table" class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-4 py-2 text-sm font-semibold border">No</th>
                            <th class="px-4 py-2 text-sm font-semibold border">No RM</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Nama Pasien</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Status</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Ruangan</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Tanggal Masuk Ruangan ICU</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Terakhir Update Data</th>
                            <th class="px-4 py-2 text-sm font-semibold border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#patients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard') }}',
                pageLength: 10,
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'no_rm', name: 'no_rm' },
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
