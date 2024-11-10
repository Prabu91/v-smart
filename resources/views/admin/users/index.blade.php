@extends('layouts.app')

@section('content')
<div class="container mx-auto flex flex-col md:flex-row md:space-x-8">
    <div class="md:w-1/2 bg-white shadow-md rounded-lg p-8 mb-6">
        <h1 id="form-heading" class="text-2xl font-bold text-center mb-6">Tambah Pengguna</h1>

		@if (session('success'))
			<div class="bg-green-500 text-white p-3 rounded-md mb-4">
				{{ session('success') }}
			</div>
		@endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
				<x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
				<x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
                
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="hospital" class="block text-sm font-medium text-gray-700">Hospital</label>
                <input type="text" name="hospital" id="hospital" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                <x-input-error :messages="$errors->get('hospital')" class="mt-2" />
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-[#3085d6] text-white py-2 px-4 rounded-md hover:bg-[#276baa] transition duration-300 font-bold">Create</button>
            </div>
        </form>
    </div>

    <div class="md:w-full bg-white shadow-md rounded-lg p-8 mb-6">
        <h2 class="text-2xl font-bold text-center mb-4">Daftar Pengguna</h2>
        <table id="users-table" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Role</th>
                    <th class="px-4 py-2 border-b">Hospital</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts')
<script>
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.users.index') }}",
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'hospital', name: 'hospital' },
            { data: 'action', name: 'action', orderable: false, searchable: false, render: function(data, type, row) {
				return `
					<button class="edit" data-id="${row.id}" data-name="${row.name}" data-email="${row.email}" data-hospital="${row.hospital}" data-role="${row.role}" style="background-color: #3490dc; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#2779bd';" onmouseout="this.style.backgroundColor='#3490dc';">Edit</button>
					<button class="delete" data-id="${row.id}" style="background-color: #e3342f; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#cc1f1a';" onmouseout="this.style.backgroundColor='#e3342f';">Delete</button>

				`;
			}},
        ],
		createdRow: function(row, data, dataIndex) {
                // Apply center alignment to all cells
                $(row).find('td').addClass('text-center');
            }
    });

	$('#users-table').on('click', '.edit', function() {
		var userId = $(this).data('id');
		var userName = $(this).data('name');
		var userEmail = $(this).data('email');
		var userPassword = $(this).data('password');
        var userHospital = $(this).data('hospital');
		var userRole = $(this).data('role');

		// Ubah judul form menjadi "Edit Pengguna" pada h1 dengan id form-heading
		$('#form-heading').text('Edit Pengguna');

		// Isi form dengan data user yang dipilih
		$('#name').val(userName);
		$('#email').val(userEmail);
		$('#password').val(userPassword);
		$('#hospital').val(userHospital);
		$('#role').val(userRole);

		// Ganti action form ke route update
		$('form').attr('action', `/admin/users/${userId}`);
		
		// Tambah method PUT untuk update
		$('form').append('<input type="hidden" name="_method" value="PUT">');
		
		// Ubah tombol submit menjadi tombol update
		$('button[type="submit"]').text('Update');
	});

	// Reset form setelah update
	function resetForm() {
		$('#name').val('');
		$('#email').val('');
		$('#hospital').val('');
		$('#role').val('user');
		$('form').attr('action', '{{ route("admin.users.store") }}');
		$('form').find('input[name="_method"]').remove(); // Hapus input method PATCH jika ada
		$('button[type="submit"]').text('Create');

		// Kembalikan judul form menjadi "Tambah Pengguna"
		$('#form-heading').text('Tambah Pengguna');
	}

	// Reset form ketika DataTable selesai reload
	table.on('draw', function() {
		resetForm();
	});

	// SweetAlert for Flash Messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif


    // Handle delete button click
    $('#users-table').on('click', '.delete', function () {
        var userId = $(this).data('id');
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data tidak bisa dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/users/' + userId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        Swal.fire(
                            'Terhapus!',
                            'Data user telah dihapus.',
                            'success',
                        )
                        table.ajax.reload(); // Refresh DataTable
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Data user gagal dihapus.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection
