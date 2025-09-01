@extends('layouts.app')

@section('title', 'Data Awal')

@section('content')

<div class="container mx-auto">
    <div class="relative w-full ">
		<!-- Form -->
		<form id="originForm" action="{{ route('origin-rooms.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ $patient_id }}">
			<div class="bg-white p-8 rounded-xl">
				<h1 class="text-3xl font-bold mb-8 text-center">Data Ruang Asal Pasien</h1>
				<div>
					<label for="origin_room_name" class="block text-lg font-medium text-txtl">Nama/Nomor Ruangan Asal Pasien</label>
					<input type="text" name="origin_room_name" id="origin_room_name" value="{{ old('origin_room_name') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('origin_room_name') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Nama Ruangan">
					<x-input-error :messages="$errors->get('origin_room_name')" class="mt-2" />
				</div>
				<div>
					<label for="physical_check" class="block text-lg font-medium text-txtl mt-4">Pemeriksaan Fisik</label>
					<x-input-error :messages="$errors->get('physical_check')" class="mt-2" />
					<textarea name="physical_check" id="physical_check" value="{{ old('physical_check') }}" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('physical_check') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan hasil pemeriksaan fisik	"></textarea>
				</div>

				<h2 class="text-xl font-bold my-4">Hasil Penunjang Awal Masuk</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="hb_origin" class="block text-lg font-medium text-txtl">Hb</label>
						<div class="relative">
							<input type="number" name="hb_origin" id="hb_origin" value="{{ old('hb_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_origin') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
						<x-input-error :messages="$errors->get('hb_origin')" class="mt-2" />

					</div>
					<div>
						<label for="leukosit_origin" class="block text-lg font-medium text-txtl">Leukosit</label>
						<div class="relative">
							<input type="number" name="leukosit_origin" id="leukosit_origin" value="{{ old('leukosit_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_origin') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('leukosit_origin')" class="mt-2" />

					</div>
					<div>	
						<label for="pcv_origin" class="block text-lg font-medium text-txtl">PCV</label>
						<div class="relative">
							<input type="number" name="pcv_origin" id="pcv_origin" value="{{ old('pcv_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_origin') border-red-500 @else border-gray-300 @enderror" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						<x-input-error :messages="$errors->get('pcv_origin')" class="mt-2" />

					</div>
					<div>
						<label for="trombosit_origin" class="block text-lg font-medium text-txtl">Trombosit</label>
						<div class="relative">
							<input type="number" name="trombosit_origin" id="trombosit_origin" value="{{ old('trombosit_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_origin') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('trombosit_origin')" class="mt-2" />

					</div>
					<div>
						<label for="kreatinin_origin" class="block text-lg font-medium text-txtl">Kreatitin</label>
						<div class="relative">
							<input type="number" name="kreatinin_origin" id="kreatinin_origin" value="{{ old('kreatinin_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kreatinin_origin') border-red-500 @else border-gray-300 @enderror" placeholder="1,0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
						<x-input-error :messages="$errors->get('kreatinin_origin')" class="mt-2" />

					</div>
				</div>

				<h2 class="text-xl font-bold my-4">AGD</h2>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="ph_origin" class="block text-lg font-medium text-txtl">pH</label>
						<input type="number" name="ph_origin" id="ph_origin" value="{{ old('ph_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ph_origin') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
						<x-input-error :messages="$errors->get('ph_origin')" class="mt-2" />
					</div>
					<div>
						<label for="pco2_origin" class="block text-lg font-medium text-txtl">pCO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="pco2_origin" id="pco2_origin" value="{{ old('pco2_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pco2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
						<x-input-error :messages="$errors->get('pco2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="po2_origin" class="block text-lg font-medium text-txtl">pO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="po2_origin" id="po2_origin" value="{{ old('po2_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('po2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
						<x-input-error :messages="$errors->get('po2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="spo2_origin" class="block text-lg font-medium text-txtl">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2_origin" id="spo2_origin" value="{{ old('spo2_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('spo2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						<x-input-error :messages="$errors->get('spo2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="be_origin" class="block text-lg font-medium text-txtl">Base Excees</label>
						<div class="relative">
							<input type="number" name="be_origin" id="be_origin" value="{{ old('be_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('be_origin') border-red-500 @else border-gray-300 @enderror" placeholder="-9">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('be_origin')" class="mt-2" />
					</div>
					<div>
						<label for="sbpt" class="block text-lg font-medium text-txtl">SBPT</label>
						<div class="relative">
							<input type="number" name="sbpt" id="sbpt" value="{{ old('sbpt') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('sbpt') border-red-500 @else border-gray-300 @enderror" placeholder="22">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('sbpt')" class="mt-2" />
					</div>
					<div>
						<label for="pf_ratio" class="block text-lg font-medium text-txtl">P/F Ratio</label>
						<div class="relative">
							<input type="number" name="pf_ratio" id="pf_ratio" value="{{ old('pf_ratio') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pf_ratio') border-red-500 @else border-gray-300 @enderror" placeholder="300">
						</div>
						<x-input-error :messages="$errors->get('pf_ratio')" class="mt-2" />
					</div>
					<div>
						<label for="hco3" class="block text-lg font-medium text-txtl">HCO3</label>
						<div class="relative">
							<input type="number" name="hco3" id="hco3" value="{{ old('hco3') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hco3') border-red-500 @else border-gray-300 @enderror" placeholder="18">
						</div>
						<x-input-error :messages="$errors->get('hco2')" class="mt-2" />
					</div>
					<div>
						<label for="tco2" class="block text-lg font-medium text-txtl">TCO2</label>
						<div class="relative">
							<input type="number" name="tco2" id="tco2" value="{{ old('tco2') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('tco2') border-red-500 @else border-gray-300 @enderror" placeholder="19">
						</div>
						<x-input-error :messages="$errors->get('tco2')" class="mt-2" />
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8">
					<div>
						<label for="na_origin" class="block text-lg font-medium text-txtl">Na<sup>+</sup></label>
						<div class="relative">
							<input type="number" name="na_origin" id="na_origin" value="{{ old('na_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('na_origin') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('na_origin')" class="mt-2" />
					</div>
					<div>
						<label for="kal_origin" class="block text-lg font-medium text-txtl">K<sup>+</sup></label>
						<div class="relative">
							<input type="number" name="kal_origin" id="kal_origin" value="{{ old('kal_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kal_origin') border-red-500 @else border-gray-300 @enderror" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('kal_origin')" class="mt-2" />
					</div>
					<div>
						<label for="gds_origin" class="block text-lg font-medium text-txtl">GDS</label>
						<div class="relative">
							<input type="number" name="gds_origin" id="gds_origin" value="{{ old('gds_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('gds_origin') border-red-500 @else border-gray-300 @enderror" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
						<x-input-error :messages="$errors->get('gds_origin')" class="mt-2" />
					</div>
				</div>
			</div>

			{{-- Radiology --}}
			<div class="bg-white p-8 rounded-xl">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="radiology" class="block text-lg font-medium text-txtl">Radiologi</label>
						<p class="text-sm text-gray-500">CT scan / MRI / USG / RO Thorax</p>
						<input type="text" name="radiology" id="radiology" value="{{ old('radiology') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('radiology') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Radiologi">
						<x-input-error :messages="$errors->get('radiology')" class="mt-2" />
						</div>
						<div>
						<label for="ews" class="block text-lg font-medium text-txtl">Score EWS</label>
						<input type="number" name="ews" id="ews" value="{{ old('ews') }}" class="mt-6 block w-full px-3 py-2 border rounded-md shadow-sm @error('ews') border-red-500 @else border-gray-300 @enderror" placeholder="5">
						<x-input-error :messages="$errors->get('ews')" class="mt-2" />
					</div>
				</div>
				<div>
					<label for="additional_check" class="block text-lg font-medium text-txtl mt-4 mb-2">Pemeriksaan Penunjang Lain</label>
					<x-input-error :messages="$errors->get('additional_check')" class="mt-2" />
					<textarea name="additional_check" id="additional_check" value="{{ old('additional_check') }}" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('additional_check') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan hasil pemeriksaan lain yang relevan"></textarea>
				</div>
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="main_diagnose_origin" class="block text-lg font-medium text-txtl">Diagnosa Utama</label>
						<input type="text" name="main_diagnose_origin" id="main_diagnose_origin" value="{{ old('main_diagnose_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm @error('main_diagnose_origin') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Utama">
						<x-input-error :messages="$errors->get('main_diagnose_origin')" class="mt-2" />
					</div>
					<div>
						<label for="secondary_diagnose_origin" class="block text-lg font-medium text-txtl">Diagnosa Sekunder</label>
						<input type="text" name="secondary_diagnose_origin" id="secondary_diagnose_origin" value="{{ old('secondary_diagnose_origin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('secondary_diagnose_origin') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Sekunder">
						<x-input-error :messages="$errors->get('secondary_diagnose_origin')" class="mt-2" />
					</div>
				</div>

				<div class="flex justify-between items-center mt-16">
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
    document.getElementById('originForm').submit(); // Kirim form
});

    function toggleIntubationFields(show) {
        const intubationFields = document.getElementById("intubation-fields");
        intubationFields.classList.toggle("hidden", !show);
    }

	document.querySelectorAll('input[name="intubation_location"]').forEach(radio => {
		radio.addEventListener('change', function () {
			if (this.value === 'other') {
				document.getElementById('other_location_input').classList.remove('hidden');
			} else {
				document.getElementById('other_location_input').classList.add('hidden');
			}
		});
	});



</script>
@endpush


@endsection

