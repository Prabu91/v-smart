@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
<div class="container mx-auto flex flex-col md:flex-row md:space-x-8 px-4">
    <div class="bg-white shadow-md rounded-lg p-8 mb-6 md:w-full">
        <div class="flex items-center justify-between mb-4 flex-col md:flex-row">
            <h2 class="text-3xl font-bold text-center mb-4 md:mb-0 md:text-left flex-grow">DAFTAR PENGGUNA</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-btn hover:bg-btnh text-white font-bold py-2 px-4 rounded mt-2 md:mt-0">
                Tambah Data
            </a>
        </div>
        
        <!-- Table with overflow-x-auto for mobile responsiveness -->
        <div class="overflow-x-auto">
            <table id="users-table" class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Username</th>
                        <th class="px-4 py-2 border-b">Hospital</th>
                        <th class="px-4 py-2 border-b">Ventilator</th>
                        <th class="px-4 py-2 border-b">Bed</th>
                        <th class="px-4 py-2 border-b">Role</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will go here -->
                </tbody>
            </table>
        </div>
        
        <!-- Modal -->
        <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
                <p>Apakah Anda Yakin Ingin Menghapus Data Pengguna?</p>
                <div class="flex justify-end mt-4">
                    <button id="cancelButton" class="mr-2 px-4 py-2 bg-btn hover:bg-btnh text-txtd rounded-md">Batal</button>
                    <button id="confirmButton" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>



    {{-- SWAL --}}
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: true,
                timer: 5000,
                timerProgressBar: true,
            });
        </script>
    @endif

@push('scripts')
<script>
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.users.index') }}",
        columns: [
            {
                data: null, 
                name: 'row_number',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'hospital', name: 'hospital' },
            { data: 'venti', name: 'venti' },
            { data: 'bed', name: 'bed' },
            { data: 'role', name: 'role' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class="edit" data-id="${row.id}" style="background-color: #eab308; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s;" 
                                onmouseover="this.style.backgroundColor='#facc15';" 
                                onmouseout="this.style.backgroundColor='#eab308';">
                            Edit
                        </button>
                        <button class="delete" data-id="${row.id}" style="background-color: #e3342f; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s;" 
                                onmouseover="this.style.backgroundColor='#cc1f1a';" 
                                onmouseout="this.style.backgroundColor='#e3342f';">
                            Delete
                        </button>
                    `;
                }
            },
        ],
		createdRow: function(row, data, dataIndex) {
                $(row).find('td').addClass('text-center');
            }
    });
	
    $('#users-table').on('click', '.edit', function () {
        let userId = $(this).data('id');
        window.location.href = `/admin/users/${userId}/edit`;
    });

    $(document).on('click', '.delete', function() {
        var userId = $(this).data('id');
        var deleteUrl = '/admin/users/' + userId;

        document.getElementById('confirmationModal').classList.remove('hidden');
        
        document.getElementById('confirmButton').addEventListener('click', function() {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(response) {
                    document.getElementById('confirmationModal').classList.add('hidden');
                    $('#users-table').DataTable().ajax.reload();

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pengguna berhasil dihapus',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                },
                error: function(xhr, status, error) {
                    document.getElementById('confirmationModal').classList.add('hidden');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal menghapus pengguna',
                        text: xhr.responseJSON.message || 'Terjadi kesalahan saat menghapus pengguna.',
                        showConfirmButton: true,
                        timer: 5000,
                        timerProgressBar: true,
                    });
                }

            });
        });
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.add('hidden');
    });

</script>
@endpush
@endsection
