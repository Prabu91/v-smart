@extends($layout)

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-6">Data Pasien</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="patientForm" action="{{ route('patients.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

			<div class="bg-white p-8 rounded-xl">
				{{-- <h2 class="text-xl font-bold mb-4">Data Pasien</h2> --}}
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="name" class="block text-md font-medium text-gray-700">Nama Pasien</label>
						<input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Pasien" required>
						@error('name')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="no_jkn" class="block text-md font-medium text-gray-700">No Kartu JKN</label>
						<input type="text" name="no_jkn" id="no_jkn" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan No Kartu JKN" required>
						@error('no_jkn')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="no_rm" class="block text-md font-medium text-gray-700">No Kartu Rekam Medis</label>
						<input type="text" name="no_rm" id="no_rm" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan No Kartu Rekam Medis" required>
						@error('no_rm')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>
				<div class="flex justify-end mt-10">
					<button type="button" id="openModalButton" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
						Simpan Data
					</button>
				</div>
			</div>
		</form>

		<!-- Modal -->
		{{-- <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
			<div class="bg-white rounded-lg shadow-lg p-6">
				<h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
				<p>Apakah Anda yakin ingin menyimpan data pasien?</p>
				<div class="flex justify-end mt-4">
					<button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</button>
					<button id="confirmButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ya, Simpan</button>
				</div>
			</div>
		</div> --}}

    </div>
</div>

<!-- Script for Slide Navigation -->
@push('scripts')
<script>
	document.getElementById('openModalButton').addEventListener('click', function() {
		Swal.fire({
			title: 'Konfirmasi',
			text: "Apakah Anda yakin ingin menyimpan data ini?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya, simpan!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				// Kirim form jika pengguna mengkonfirmasi
				document.getElementById('patientForm').submit();
			}
		});
	});

	// Tangkap event submit dari form
	document.getElementById('patientForm').addEventListener('submit', function(event) {
		event.preventDefault(); // Mencegah pengiriman form langsung

		// Tampilkan SweetAlert kedua setelah form disubmit
		Swal.fire({
			title: 'Data Tersimpan!',
			text: "Ke mana Anda ingin melanjutkan?",
			icon: 'success',
			showCancelButton: true,
			confirmButtonText: 'Halaman Detail Pasien',
			cancelButtonText: 'Halaman Observasi'
		}).then((result) => {
			if (result.isConfirmed) {
				// Jika pengguna memilih halaman detail pasien
				window.location.href = '/patient/' + patientId; // Ganti dengan ID pasien yang sesuai
			} else {
				// Jika pengguna memilih halaman observasi
				window.location.href = '/origin-rooms'; // Ganti dengan URL yang sesuai
			}
		});

		// Kirim form setelah menampilkan SweetAlert
		this.submit();
	});

</script>
@endpush


@endsection

