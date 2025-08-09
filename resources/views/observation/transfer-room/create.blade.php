@extends('layouts.app')

@section('title', 'Transfer Room')

@section('content')
<div class="container mx-auto p-6">
	
	<div class="relative w-full ">
		<!-- Form -->
		<form id="transferForm" action="{{ route('transfer-rooms.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ $patient_id }}">
			
			<div class="bg-white p-8 rounded-xl">
				<h2 class="text-3xl font-bold mb-8 text-center">Data Pindah Ruangan</h2>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="transfer_room_datetime" class="block text-md font-bold text-txtl">Tanggal dan Waktu Pindah Ruangan</label>
						<input type="datetime-local" name="transfer_room_datetime" id="transfer_room_datetime" value="{{ old('transfer_room_datetime') }}" class="font-semibold text-black mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('transfer_room_datetime') border-red-500 @else border-gray-300 @enderror">
						<x-input-error :messages="$errors->get('transfer_room_datetime')" />
					</div>
					
					<div>
						<label for="transfer_room_name" class="block text-md font-bold text-txtl">Nama/Nomor Ruangan</label>
						<input type="text" name="transfer_room_name" id="transfer_room_name" value="{{ old('transfer_room_name') }}" class="font-semibold text-black mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('transfer_room_name') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Nama Ruangan">
						<x-input-error :messages="$errors->get('transfer_room_name')" />
					</div>
					<div>
						<label for="lab_culture_data" class="block text-md font-bold text-txtl">Hasil Lab Kultur</label>
						<div class="relative">
							<select name="lab_culture_data" id="lab_culture_data" 
									class="font-semibold text-black mt-1 block w-full px-3 py-2 border @error('lab_culture_data') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
								<option value="" disabled selected>Hasil Lab Kultur</option>
								<option value="Ada">Ada</option>
								<option value="Tidak Ada">Tidak Ada</option>
							</select>
						</div>
						<x-input-error :messages="$errors->get('lab_culture_data')" />
					</div>
				</div>

				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="main_diagnose_transfer" class="block text-lg font-bold text-txtl">Diagnosa Utama</label>
						<input type="text" name="main_diagnose_transfer" id="main_diagnose_transfer" value="{{ old('main_diagnose_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm @error('main_diagnose_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Utama">
						<x-input-error :messages="$errors->get('main_diagnose_transfer')" class="mt-2" />
					</div>
					<div>
						<label for="secondary_diagnose_transfer" class="block text-lg font-bold text-txtl">Diagnosa Sekunder</label>
						<input type="text" name="secondary_diagnose_transfer" id="secondary_diagnose_transfer" value="{{ old('secondary_diagnose_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('secondary_diagnose_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Sekunder">
						<x-input-error :messages="$errors->get('secondary_diagnose_transfer')" class="mt-2" />
					</div>
				</div>
				
				<h2 class="text-xl font-bold my-4">Hasil Lab Akhir</h2>
				<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="hb_transfer" class="block text-lg font-bold text-txtl">Hb</label>
						<div class="relative">
							<input type="number" name="hb_transfer" id="hb_transfer" value="{{ old('hb_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
						<x-input-error :messages="$errors->get('hb_transfer')" class="mt-2" />

					</div>
					<div>
						<label for="leukosit_transfer" class="block text-lg font-bold text-txtl">Leukosit</label>
						<div class="relative">
							<input type="number" name="leukosit_transfer" id="leukosit_transfer" value="{{ old('leukosit_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('leukosit_transfer')" class="mt-2" />

					</div>
					<div>
						<label for="pcv_transfer" class="block text-lg font-bold text-txtl">PCV</label>
						<div class="relative">
							<input type="number" name="pcv_transfer" id="pcv_transfer" value="{{ old('pcv_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						<x-input-error :messages="$errors->get('pcv_transfer')" class="mt-2" />

					</div>
					<div>
						<label for="trombosit_transfer" class="block text-lg font-bold text-txtl">Trombosit</label>
						<div class="relative">
							<input type="number" name="trombosit_transfer" id="trombosit_transfer" value="{{ old('trombosit_transfer') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_transfer') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('trombosit_transfer')" class="mt-2" />
					</div>
				</div>

				<!-- TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
					<div>
						<label for="td" class="block text-md font-bold text-txtl">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="sistolik" id="sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border rounded-md shadow-sm" placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="diastolik" id="diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border rounded-md shadow-sm" placeholder="70" min="0">
						</div>
					</div>
					<div>
						<label for="suhu" class="block text-md font-medium text-txtl">S.</label>
						<div class="relative">
							<input type="number" name="suhu" id="suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
						</div>
					</div>
					<div>
						<label for="nadi" class="block text-md font-medium text-txtl">N.</label>
						<div class="relative">
							<input type="number" name="nadi" id="nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
						</div>
					</div>
					<div>
						<label for="rr_ttv" class="block text-md font-medium text-txtl">RR</label>
						<div class="relative">
							<input type="number" name="rr_ttv" id="rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
						</div>
					</div>
					<div>
						<label for="spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2" id="spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
					</div>
					<div>
						<label for="consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
						<input type="text" name="consciousness" id="consciousness" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="">
						<x-input-error :messages="$errors->get('consciousness')" class="mt-2" />
					</div>
				</div>

				<div class="my-4">
					<label for="notes" class="block text-md font-bold text-txtl mt-4 mb-2">Notes</label>
					<x-input-error :messages="$errors->get('notes')" class="mt-2" />
					<textarea name="notes" id="notes" value="{{ old('notes') }}" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('notes') border-red-500 @else border-gray-300 @enderror" placeholder="Keterangan Tambahan"></textarea>
				</div>

				<div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-16">
					<!-- Tombol Back -->
					<a href="{{ url()->previous() }}" 
						class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
						Kembali
					</a>
		
					<!-- Tombol Simpan Data -->
					<button 
						type="button" 
						id="openModalButton" 
						class="inline-flex items-center px-4 py-2 bg-btn text-white font-semibold rounded-md shadow-sm hover:bg-btnh focus:outline-none focus:ring-2 focus:ring-btn focus:ring-offset-2">
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
				<p>Apakah Anda yakin ingin menyimpan data?</p>
				<div class="flex justify-end mt-4">
					<button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 hover:bg-gray-200 text-gray-700 rounded-md">Batal</button>
					<button id="confirmButton" class="px-4 py-2 bg-btn hover:bg-btnh text-white rounded-md">Ya, Simpan</button>
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