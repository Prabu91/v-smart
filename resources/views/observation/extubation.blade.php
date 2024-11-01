@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="extubationForm" action="/extubation" method="POST" class="space-y-6">
			@csrf
			<div class="bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold my-4">Data Persiapan Extubasi</h2>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="excubation_date" class="block text-sm font-medium text-gray-700">Waktu Extubasi</label>
						<input type="date" name="excubation_date" id="excubation_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
					</div>
					<div>
						<label for="preparation_extubation_therapy" class="block text-sm font-medium text-gray-700">Therapi Persiapan Ekstubasi</label>
						<input type="text" name="preparation_extubation_therapy" id="preparation_extubation_therapy" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Dexamethasone, Nebu Adrenaline">
					</div>
					<div>
						<label for="excubation" class="block text-sm font-medium text-gray-700">Tindakan Ekstubasi</label>
						<input type="text" name="excubation" id="excubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Sukses, Tanpa Komplikasi">
					</div>
				</div>
				<div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="nebu_adrenalin" class="block text-sm font-medium text-gray-700">Nebu Adrenalin</label>
						<div class="relative">
							<input type="text" name="nebu_adrenalin" id="nebu_adrenalin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="2">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mL</span>
						</div>
					</div>
					<div>
						<label for="dexamethasone" class="block text-sm font-medium text-gray-700">Dexamethasone</label>
						<div class="relative">
							<input type="text" name="dexamethasone" id="dexamethasone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg</span>
						</div>
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
		<div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
			<div class="bg-white rounded-lg shadow-lg p-6">
				<h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
				<p>Apakah Anda yakin ingin menyimpan data pasien?</p>
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
</script>
@endpush


@endsection

