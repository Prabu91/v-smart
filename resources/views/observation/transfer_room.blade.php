@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="transferForm" action="/transfer" method="POST" class="space-y-6">
			@csrf
			<div class="bg-white p-8 rounded-xl">
				<div class="bg-white p-8 rounded-xl">
					<h2 class="text-xl font-bold mb-4">Data Pindah Ruangan</h2>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="transfer_room_date" class="block text-md font-medium text-gray-700">Tanggal Keluar</label>
							<input type="date" name="transfer_room_date" id="transfer_room_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
						</div>
						<div>
							<label for="transfer_room_name" class="block text-md font-medium text-gray-700">Nama Ruangan</label>
							<input type="text" name="transfer_room_name" id="transfer_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Ruangan">
						</div>
					</div>
					<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
					<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="hb_transfer_room" class="block text-md font-medium text-gray-700">Hb</label>
							<input type="text" name="hb_transfer_room" id="hb_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hb">
						</div>
						<div>
							<label for="leukosit_transfer_room" class="block text-md font-medium text-gray-700">Leukosit</label>
							<input type="text" name="leukosit_transfer_room" id="leukosit_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Leukosit">
						</div>
						<div>
							<label for="pcv_transfer_room" class="block text-md font-medium text-gray-700">PCV</label>
							<input type="text" name="pcv_transfer_room" id="pcv_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan PCV">
						</div>
						<div>
							<label for="trobosit_transfer_room" class="block text-md font-medium text-gray-700">Trombosit</label>
							<input type="text" name="trobosit_transfer_room" id="trobosit_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Trombosit">
						</div>
						{{-- <div>
							<label for="no_cm" class="block text-md font-medium text-gray-700">Hasil Lab Kultur</label>
							<input type="text" name="no_cm" id="no_cm" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Trombosit">
						</div> --}}
					</div>

					<!-- TTV -->
					<h2 class="text-xl font-bold my-4">TTV</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="transfer_room_td" class="block text-md font-medium text-gray-700">TD</label>
							<input type="text" name="transfer_room_td" id="transfer_room_td" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan TD">
						</div>
						<div>
							<label for="transfer_room_saturasi" class="block text-md font-medium text-gray-700">S.</label>
							<input type="text" name="transfer_room_saturasi" id="transfer_room_saturasi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan S.">
						</div>
						<div>
							<label for="transfer_room_nadi" class="block text-md font-medium text-gray-700">N.</label>
							<input type="text" name="transfer_room_nadi" id="transfer_room_nadi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan N.">
						</div>
						<div>
							<label for="transfer_room_rr" class="block text-md font-medium text-gray-700">RR</label>
							<input type="text" name="transfer_room_rr" id="transfer_room_rr" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan RR">
						</div>
						<div>
							<label for="transfer_room_spo2" class="block text-md font-medium text-gray-700">SPO2</label>
							<input type="text" name="transfer_room_spo2" id="transfer_room_spo2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan SPO2">
						</div>
					</div>
					
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