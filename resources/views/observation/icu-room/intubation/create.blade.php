@extends($layout)

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-6">Tambah Data Intubasi</h1>

    {{-- Intubasi --}}
	<div class="relative w-full">
		<form id="intubationForm" method="POST" action="{{ route('intubations.store') }}" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ request()->get('patient_id') }}">
			<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
			@if ($intubation)
			<input type="hidden" name="ttv_id" value="{{ $intubation->ttv->id }}">
			@endif
			<div class="bg-white p-8 rounded-xl">
				{{-- <h2 class="text-2xl font-bold mb-4">Intubasi</h2> --}}
				<!-- Location of Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="intubation_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Masuk</label>
						<input type="datetime-local" name="intubation_datetime" id="intubation_datetime" class="mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('intubation_datetime', $intubation->intubation_datetime ?? '') }}" {{ $intubation ? 'disabled' : '' }}>
						<x-input-error :messages="$errors->get('intubation_datetime')" class="mt-2" />

					</div>
					<div>
						<label for="intubation_location" class="block text-md font-medium text-gray-700">Lokasi Intubasi</label>
						<select name="intubation_location" 
								id="intubation_location" 
								class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('intubation_location') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror" {{ $intubation ? 'disabled' : '' }}>
							<option value="" {{ old('intubation_location', $intubation->intubation_location ?? '') === '' ? 'selected' : '' }}>Pilih Lokasi</option>
							<option value="IGD" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'IGD' ? 'selected' : '' }}>IGD</option>
							<option value="ICU" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'ICU' ? 'selected' : '' }}>ICU</option>
							<option value="PICU" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'PICU' ? 'selected' : '' }}>PICU</option>
							<option value="NICU" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'NICU' ? 'selected' : '' }}>NICU</option>
							<option value="OK" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'OK' ? 'selected' : '' }}>OK</option>
							<option value="other" {{ old('intubation_location', $intubation->intubation_location ?? '') === 'other' ? 'selected' : '' }}>Lainnya</option>
						</select>
					
						<!-- Input teks untuk "Lainnya" -->
						<div id="other_location_input" class="mt-2 {{ old('intubation_location', $intubation->intubation_location ?? '') === 'other' ? '' : 'hidden' }}">
							<label for="intubation_location_other" class="block text-gray-700">Masukkan Lokasi Lainnya:</label>
							<input type="text" id="intubation_location_other" name="intubation_location_other" class="mt-1 p-2 border rounded w-full" placeholder="Masukkan lokasi..." value="{{ old('intubation_location_other', $intubation->intubation_location_other ?? '') }}">
						</div>
					
						<x-input-error :messages="$errors->get('intubation_location')" class="mt-2" />
					</div>
					
				</div>
				<!-- Doctor Information Section -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="dr_intubation_name" class="block text-md font-medium text-gray-700">Nama Dokter yang Intubasi</label>
						<input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border @error('dr_intubation_name') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('dr_intubation_name', $intubation->dr_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Masukan Nama Dokter">
						<x-input-error :messages="$errors->get('dr_intubation_name')" class="mt-2" />

					</div>
					<div>
						<label for="dr_consultant_name" class="block text-md font-medium text-gray-700">Nama Dokter Konsulan</label>
						<input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border @error('dr_consultant_name') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('dr_consultant_name', $intubation->dr_consultant ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Masukan Nama Dokter Konsulan">
						<x-input-error :messages="$errors->get('dr_consultant_name')" class="mt-2" />

					</div>
				</div>

				<!-- Pre-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="preintubation" class="block text-lg font-medium text-gray-700">Pre-Intubation</label>
						<input type="text" name="preintubation" id="preintubation" class="mt-1 block w-full px-3 py-2 border @error('dr_consultant_name') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('preintubation', $intubation->pre_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Pre-Intsubation">
						<x-input-error :messages="$errors->get('preintubation')" class="mt-2" />

					</div>
				</div>

				<!-- Therapy and Ventilator Settings Section -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="therapy_type" class="block text-md font-medium text-gray-700">Therapy</label>
						<input type="text" name="therapy_type" id="therapy_type" class="mt-1 block w-full px-3 py-2 border @error('therapy_type') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('therapy_type', $intubation->therapy_type ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Masukan Therapy">
						<x-input-error :messages="$errors->get('therapy_type')" class="mt-2" />
					</div>
					<div>
						<label for="ett_depth" class="block text-md font-medium text-gray-700">ETT/Kedalaman</label>
						<div class="flex space-x-2">
							<div class="relative w-1/2">
								<input type="number" name="diameter" id="diameter" class="mt-1 block w-full px-3 py-2 border @error('diameter') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('diameter', $intubation->diameter ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="7.5" min="0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
							</div>
							
							<span class="flex items-center text-lg">/</span>
							
							<div class="relative w-1/2">
								<input type="number" name="depth" id="depth" class="mt-1 block w-full px-3 py-2 border @error('depth') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('depth', $intubation->depth ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="22" min="0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
							</div>
							<x-input-error :messages="$errors->get('diameter' || 'depth')" class="mt-2" />
						</div>
					</div>
				</div>
				
				<!-- TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="td" class="block text-md font-medium text-gray-700">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="sistolik" id="sistolik" class="mt-1 block w-1/2 px-3 py-2 border @error('sistolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('sistolik', $intubation->ttv->sistolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="diastolik" id="diastolik" class="mt-1 block w-1/2 px-3 py-2 border @error('diastolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('diastolik', $intubation->ttv->diastolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="70" min="0">
							<x-input-error :messages="$errors->get('sistolik' || 'diastolik')" class="mt-2" />

						</div>
					</div>
					
					<div>
						<label for="suhu" class="block text-md font-medium text-gray-700">S.</label>
						<div class="relative">
							<input type="number" name="suhu" id="suhu" class="mt-1 block w-full px-3 py-2 border @error('suhu') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('diastolik', $intubation->ttv->diastolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							<x-input-error :messages="$errors->get('sistolik' || 'diastolik')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="nadi" class="block text-md font-medium text-gray-700">N.</label>
						<div class="relative">
							<input type="number" name="nadi" id="nadi" class="mt-1 block w-full px-3 py-2 border @error('nadi') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('nadi', $intubation->ttv->nadi ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							<x-input-error :messages="$errors->get('nadi')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="rr_ttv" class="block text-md font-medium text-gray-700">RR</label>
						<div class="relative">
							<input type="number" name="rr_ttv" id="rr_ttv" class="mt-1 block w-full px-3 py-2 border @error('rr_ttv') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('rr_ttv', $intubation->ttv->rr ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							<x-input-error :messages="$errors->get('rr_ttv')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="spo2" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2" id="spo2" class="mt-1 block w-full px-3 py-2 border @error('spo2') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('spo2', $intubation->ttv->spo2 ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							<x-input-error :messages="$errors->get('spo2')" class="mt-2" />

						</div> 
					</div>
				</div>

				<!-- Post-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="postintubation" class="block text-lg font-medium text-gray-700">Post-Intubation</label>
						<input type="text" name="postintubation" id="postintubation" class="mt-1 block w-full px-3 py-2 border @error('postintubation') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('postintubation', $intubation->post_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }}" placeholder="Post-Intubation">
						<x-input-error :messages="$errors->get('postintubation')" class="mt-2" />
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


@push('scripts')
<script>
	document.getElementById('intubation_location').addEventListener('change', function () {
		const otherInput = document.getElementById('other_location_input');
		if (this.value === 'other') {
			otherInput.classList.remove('hidden');
		} else {
			otherInput.classList.add('hidden');
		}
	});

	document.getElementById('openModalButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.remove('hidden');
	});

	document.getElementById('cancelButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.add('hidden');
	});

	document.getElementById('confirmButton').addEventListener('click', function() {
		document.getElementById('intubationForm').submit(); 
	});
</script>
@endpush
@endsection

