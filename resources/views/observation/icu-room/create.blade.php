@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    {{-- <h1 class="text-2xl text-center font-bold mb-4">Form Observasi Pasien ICU/PICU</h1> --}}
	<h1 class="text-3xl font-bold mb-6 text-center">Data Ruang Intensif</h1>

    <div class="relative w-full ">
		<div id="icu-fields">
        	<!-- Form -->
			<form id="icuForm" method="POST" action="{{ route('icu-rooms.store') }}">
				@csrf
				<input type="hidden" name="patient_id" value="{{ request('patient') }}">
				<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

				<div class="bg-white p-8 rounded-xl">
					<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
						<div>
							<label for="icu_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Masuk</label>
							<input type="datetime-local" name="icu_room_datetime" id="icu_room_datetime" class="mt-1 block w-full px-3 py-2 border @error('icu_room_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
							@error('icu_room_datetime')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						
						<div>
							<label for="icu_room_name" class="block text-md font-medium text-gray-700">Ruangan</label>
							<select name="icu_room_name" id="icu_room_name" class="mt-1 block w-full px-3 py-2 border @error('icu_room_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
								<option value="">Pilih Ruangan</option>
								<option value="ICU 1">ICU</option>
								<option value="PICU">PICU</option>
								<option value="NICU">NICU</option>
								<option value="IGD">IGD</option>
							</select>
							@error('icu_room_name')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="icu_room_bednum" class="block text-md font-medium text-gray-700">Nomor Bed</label>
							<input type="number" name="icu_room_bednum" id="icu_room_bednum" class="mt-1 block w-full px-3 py-2 border @error('icu_room_bednum') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="1">
							@error('icu_room_bednum')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
					<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="hb_icu" class="block text-md font-medium text-gray-700">Hb</label>
							<div class="relative">
								<input type="number" name="hb_icu" id="hb_icu" value="{{ old('hb_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_icu') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
							</div>
							@error('hb_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="leukosit_icu" class="block text-md font-medium text-gray-700">Leukosit</label>
							<div class="relative">
								<input type="number" name="leukosit_icu" id="leukosit_icu" value="{{ old('leukosit_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_icu') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
							</div>
							@error('leukosit_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="pcv_icu" class="block text-md font-medium text-gray-700">PCV</label>
							<div class="relative">
								<input type="number" name="pcv_icu" id="pcv_icu" value="{{ old('pcv_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_icu') border-red-500 @else border-gray-300 @enderror" placeholder="38">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div>
							@error('pcv_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="trombosit_icu" class="block text-md font-medium text-gray-700">Trombosit</label>
							<div class="relative">
								<input type="number" name="trombosit_icu" id="trombosit_icu" value="{{ old('trombosit_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_icu') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
							</div>
							@error('trombosit_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="kreatinin_icu" class="block text-md font-medium text-gray-700">Kreatitin</label>
							<div class="relative">
								<input type="number" name="kreatinin_icu" id="kreatinin_icu" value="{{ old('kreatinin_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kreatinin_icu') border-red-500 @else border-gray-300 @enderror" placeholder="1,0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
							</div>
							@error('kreatinin_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					<h2 class="text-xl font-bold my-4">AGD</h2>
					<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="ph_icu" class="block text-md font-medium text-gray-700">pH</label>
							<input type="number" name="ph_icu" id="ph_icu" value="{{ old('ph_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ph_icu') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
							@error('ph_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="pco2_icu" class="block text-md font-medium text-gray-700">pCO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="pco2_icu" id="pco2_icu" value="{{ old('pco2_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pco2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="40">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
							</div>
								@error('pco2_icu')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
						</div>
						<div>
							<label for="po2_icu" class="block text-md font-medium text-gray-700">pO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="po2_icu" id="po2_icu" value="{{ old('po2_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('po2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="80">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
							</div>
								@error('po2_icu')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
						</div>
						<div>
							<label for="spo2_icu" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="spo2_icu" id="spo2_icu" value="{{ old('spo2_icu') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('spo2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="95">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div>
							@error('spo2_icu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						
					</div>
				</div>

				<div class="my-10 bg-white p-8 rounded-xl">
					<div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
						<div class="mb-4">
							<label for="ro" class="block text-sm font-medium text-gray-700">RO Sudah / Belum</label>
							<select id="ro" name="ro" class="ro block w-full mt-1 px-3 py-2 border @error('ro') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
								<option value="">Pilih status</option>
								<option value="sudah">Sudah</option>
								<option value="belum">Belum</option>
							</select>
							@error('ro_post_incubation')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="ro_post_intubation" class="block text-md font-medium text-gray-700">RO Post Intubasi</label>
							<input type="text" name="ro_post_intubation" id="ro_post_intubation" class="mt-1 block w-full px-3 py-2 border @error('ro_post_intubtion') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Stabil">
							@error('ro_post_intubation')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label for="blood_culture" class="block text-md font-medium text-gray-700">Kultur Darah</label>
							<input type="text" name="blood_culture" id="blood_culture" class="mt-1 block w-full px-3 py-2 border @error('blood_culture') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Negatif">
							@error('blood_culture')
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
				
			</form>
		</div>
			
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
		document.getElementById('icuForm').submit(); 
	});


</script>
@endpush


@endsection

