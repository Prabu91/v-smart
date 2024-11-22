@extends($layout)

@section('content')
<div class="container mx-auto p-6">
	<h2 class="text-2xl font-bold mb-6 text-center">Data Pindah Ruangan</h2>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="transferForm" action="{{ route('transfer-rooms.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ $patient_id }}">
			<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

			<div class="bg-white p-8 rounded-xl">
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="transfer_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Pindah Ruangan</label>
						<input type="datetime-local" name="transfer_room_datetime" id="transfer_room_datetime" value="{{ old('transfer_room_datetime') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('transfer_room_datetime') border-red-500 @else border-gray-300 @enderror">
						@error('transfer_room_datetime')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					
					<div>
						<label for="transfer_room_name" class="block text-md font-medium text-gray-700">Nama/Nomor Ruangan</label>
						<input type="text" name="transfer_room_name" id="transfer_room_name" value="{{ old('transfer_room_name') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('transfer_room_name') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Nama Ruangan">
						@error('transfer_room_name')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="lab_culture_data" class="block text-sm font-medium text-gray-700">Hasil Lab Kultur</label>
						<div class="relative">
							<select name="lab_culture_data" id="lab_culture_data" 
									class="mt-1 block w-full px-3 py-2 border @error('lab_culture_data') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
								<option value="" disabled selected>Pilih Kondisi Pasien</option>
								<option value="Ada">Ada</option>
								<option value="Tidak Ada">Tidak Ada</option>
							</select>
						</div>
						@error('lab_culture_data')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="main_diagnose_transfer" class="block text-md font-medium text-gray-700">Diagnosa Utama</label>
						<input type="text" name="main_diagnose_transfer" id="main_diagnose_transfer" value="{{ old('main_diagnose_transfer') }}" class="mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm @error('main_diagnose_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Utama">
						@error('main_diagnose_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="secondary_diagnose_transfer" class="block text-md font-medium text-gray-700">Diagnosa Sekunder</label>
						<input type="text" name="secondary_diagnose_transfer" id="secondary_diagnose_transfer" value="{{ old('secondary_diagnose_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('secondary_diagnose_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Sekunder">
						@error('secondary_diagnose_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>
				
				<h2 class="text-xl font-bold my-4">Hasil Lab Akhir</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="hb_transfer" class="block text-md font-medium text-gray-700">Hb</label>
						<div class="relative">
							<input type="number" name="hb_transfer" id="hb_transfer" value="{{ old('hb_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
						@error('hb_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="leukosit_transfer" class="block text-md font-medium text-gray-700">Leukosit</label>
						<div class="relative">
							<input type="number" name="leukosit_transfer" id="leukosit_transfer" value="{{ old('leukosit_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						@error('leukosit_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="pcv_transfer" class="block text-md font-medium text-gray-700">PCV</label>
						<div class="relative">
							<input type="number" name="pcv_transfer" id="pcv_transfer" value="{{ old('pcv_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						@error('pcv_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="trombosit_transfer" class="block text-md font-medium text-gray-700">Trombosit</label>
						<div class="relative">
							<input type="number" name="trombosit_transfer" id="trombosit_transfer" value="{{ old('trombosit_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						@error('trombosit_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="kreatinin_transfer" class="block text-md font-medium text-gray-700">Kreatitin</label>
						<div class="relative">
							<input type="number" name="kreatinin_transfer" id="kreatinin_transfer" value="{{ old('kreatinin_transfer') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kreatinin_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="1,0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
						@error('kreatinin_transfer')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<!-- TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="td" class="block text-md font-medium text-gray-700">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="sistolik" id="sistolik" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="diastolik" id="diastolik" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="70" min="0">
							@error('td')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					
					<div>
						<label for="suhu" class="block text-md font-medium text-gray-700">S.</label>
						<div class="relative">
							<input type="number" name="suhu" id="suhu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							@error('suhu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="nadi" class="block text-md font-medium text-gray-700">N.</label>
						<div class="relative">
							<input type="number" name="nadi" id="nadi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							@error('nadi')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="rr_ttv" class="block text-md font-medium text-gray-700">RR</label>
						<div class="relative">
							<input type="number" name="rr_ttv" id="rr_ttv" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							@error('rr_ttv')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="spo2" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2" id="spo2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							@error('spo2')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
				</div>

				<div class="flex justify-end mt-10">
					<button type="button" id="openModalButton" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
						Simpan Data
					</button>
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

	document.getElementById('confirmButton').addEventListener('click', function() {
		document.getElementById('transferForm').submit(); 
	});
</script>
@endpush
@endsection