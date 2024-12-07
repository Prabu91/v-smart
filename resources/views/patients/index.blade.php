@extends($layout)

@section('title', 'Tambah Pasien')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-6">Data Pasien</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="patientForm" action="{{ route('patients.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

			<div class="bg-white mx-auto max-w-lg p-8 rounded-xl">
				{{-- <h2 class="text-xl font-bold mb-4">Data Pasien</h2> --}}
					<div>
						<label for="name" class="block text-md font-medium text-gray-700">Nama Pasien</label>
						<input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Nama Pasien" required>
						<x-input-error :messages="$errors->get('name')" />

					</div>
					<div>
						<label for="no_jkn" class="mt-4 block text-md font-medium text-gray-700">No Kartu JKN</label>
						<input type="text" name="no_jkn" id="no_jkn" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan No Kartu JKN" required>
						<x-input-error :messages="$errors->get('no_jkn')" />

					</div>
					<div>
						<label for="no_rm" class="mt-4 block text-md font-medium text-gray-700">No Kartu Rekam Medis</label>
						<input type="text" name="no_rm" id="no_rm" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan No Kartu Rekam Medis" required>
						<x-input-error :messages="$errors->get('no_rm')" />

					</div>
				<div class="flex justify-end mt-4">
					<button type="button" id="openModalButton" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
						Simpan Data
					</button>
				</div>
			</div>
		</form>

		<!-- Modal -->
		<div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
			<div class="bg-white rounded-lg shadow-lg p-6">
				<h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
				<p>Apakah Anda Yakin Ingin Menyimpan Data Pasien?</p>
				<div class="flex justify-end mt-4">
					<button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</button>
					<button id="confirmButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ya, Simpan</button>
				</div>
			</div>
		</div>
    </div>
</div>

<!-- Script for Slide Navigation -->
@push('scripts')
<script>
	document.getElementById('openModalButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.remove('hidden');
	});

	document.getElementById('cancelButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.add('hidden');
	});

	document.getElementById('confirmButton').addEventListener('click', function() {
		document.getElementById('patientForm').submit(); 
	});
</script>
@endpush


@endsection

