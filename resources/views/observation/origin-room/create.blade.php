@extends($layout)

@section('content')

<div class="container mx-auto p-6">
    {{-- <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1> --}}
	<h1 class="text-3xl font-bold mb-6 text-center">Data Ruang Asal Pasien</h1>


    <div class="relative w-full ">
        <!-- Form -->
		<form id="originForm" action="{{ route('origin-rooms.store') }}" method="POST" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ $patient_id }}">
			<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
			<div class="bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold my-4">Data Awal Pasien Masuk</h2>
				<div>
					<label for="origin_room_name" class="block text-lg font-medium text-gray-700">Nama/Nomor Ruangan Asal Pasien</label>
					<input type="text" name="origin_room_name" id="origin_room_name" value="{{ old('origin_room_name') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('origin_room_name') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Nama Ruangan">
					<x-input-error :messages="$errors->get('origin_room_name')" class="mt-2" />
				</div>
				<div>
					<label for="physical_check" class="block text-lg font-medium text-gray-700 mt-4">Pemeriksaan Fisik</label>
					<x-input-error :messages="$errors->get('physical_check')" class="mt-2" />
					<textarea name="physical_check" id="physical_check" value="{{ old('physical_check') }}" rows="2" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('physical_check') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan hasil pemeriksaan fisik	"></textarea>
				</div>

				<h2 class="text-xl font-bold my-4">Hasil Lab Awal Masuk</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="hb_origin" class="block text-lg font-medium text-gray-700">Hb</label>
						<div class="relative">
							<input type="number" name="hb_origin" id="hb_origin" value="{{ old('hb_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_origin') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
						<x-input-error :messages="$errors->get('hb_origin')" class="mt-2" />

					</div>
					<div>
						<label for="leukosit_origin" class="block text-lg font-medium text-gray-700">Leukosit</label>
						<div class="relative">
							<input type="number" name="leukosit_origin" id="leukosit_origin" value="{{ old('leukosit_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_origin') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('leukosit_origin')" class="mt-2" />

					</div>
					<div>
						<label for="pcv_origin" class="block text-lg font-medium text-gray-700">PCV</label>
						<div class="relative">
							<input type="number" name="pcv_origin" id="pcv_origin" value="{{ old('pcv_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_origin') border-red-500 @else border-gray-300 @enderror" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						<x-input-error :messages="$errors->get('pcv_origin')" class="mt-2" />

					</div>
					<div>
						<label for="trombosit_origin" class="block text-lg font-medium text-gray-700">Trombosit</label>
						<div class="relative">
							<input type="number" name="trombosit_origin" id="trombosit_origin" value="{{ old('trombosit_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_origin') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
						<x-input-error :messages="$errors->get('trombosit_origin')" class="mt-2" />

					</div>
					<div>
						<label for="kreatinin_origin" class="block text-lg font-medium text-gray-700">Kreatitin</label>
						<div class="relative">
							<input type="number" name="kreatinin_origin" id="kreatinin_origin" value="{{ old('kreatinin_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kreatinin_origin') border-red-500 @else border-gray-300 @enderror" placeholder="1,0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
						<x-input-error :messages="$errors->get('kreatinin_origin')" class="mt-2" />

					</div>
				</div>

				<h2 class="text-xl font-bold my-4">AGD</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="ph_origin" class="block text-lg font-medium text-gray-700">pH</label>
						<input type="number" name="ph_origin" id="ph_origin" value="{{ old('ph_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ph_origin') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
						<x-input-error :messages="$errors->get('ph_origin')" class="mt-2" />
					</div>
					<div>
						<label for="pco2_origin" class="block text-lg font-medium text-gray-700">pCO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="pco2_origin" id="pco2_origin" value="{{ old('pco2_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pco2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
						<x-input-error :messages="$errors->get('pco2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="po2_origin" class="block text-lg font-medium text-gray-700">pO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="po2_origin" id="po2_origin" value="{{ old('po2_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('po2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
						<x-input-error :messages="$errors->get('po2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="spo2_origin" class="block text-lg font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2_origin" id="spo2_origin" value="{{ old('spo2_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('spo2_origin') border-red-500 @else border-gray-300 @enderror" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
						<x-input-error :messages="$errors->get('spo2_origin')" class="mt-2" />
					</div>
					<div>
						<label for="be_origin" class="block text-lg font-medium text-gray-700">Base Excees</label>
						<div class="relative">
							<input type="number" name="be_origin" id="be_origin" value="{{ old('be_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('be_origin') border-red-500 @else border-gray-300 @enderror" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('be_origin')" class="mt-2" />
					</div>
					
				</div>

				<div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8">
					<div>
						<label for="na_origin" class="block text-lg font-medium text-gray-700">Na<sup>+</sup></label>
						<div class="relative">
							<input type="number" name="na_origin" id="na_origin" value="{{ old('na_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('na_origin') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('na_origin')" class="mt-2" />
					</div>
					<div>
						<label for="kal_origin" class="block text-lg font-medium text-gray-700">K<sup>+</sup></label>
						<div class="relative">
							<input type="number" name="kal_origin" id="kal_origin" value="{{ old('kal_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kal_origin') border-red-500 @else border-gray-300 @enderror" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
						</div>
						<x-input-error :messages="$errors->get('kal_origin')" class="mt-2" />
					</div>
					<div>
						<label for="gds_origin" class="block text-lg font-medium text-gray-700">GDS</label>
						<div class="relative">
							<input type="number" name="gds_origin" id="gds_origin" value="{{ old('gds_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('gds_origin') border-red-500 @else border-gray-300 @enderror" placeholder="80">
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
						<label for="radiology" class="block text-lg font-medium text-gray-700">Radiologi</label>
						<p class="text-sm text-gray-500">CT scan / MRI / USG / RO Thorax</p>
						<input type="text" name="radiology" id="radiology" value="{{ old('radiology') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('radiology') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Radiologi">
						<x-input-error :messages="$errors->get('radiology')" class="mt-2" />
						</div>
						<div>
						<label for="ews" class="block text-lg font-medium text-gray-700">Score EWS</label>
						<input type="number" name="ews" id="ews" value="{{ old('ews') }}" class="mt-6 block w-full px-3 py-2 border rounded-md shadow-sm @error('ews') border-red-500 @else border-gray-300 @enderror" placeholder="5">
						<x-input-error :messages="$errors->get('ews')" class="mt-2" />
					</div>
				</div>
				<div>
					<label for="additional_check" class="block text-lg font-medium text-gray-700 mt-4 mb-2">Pemeriksaan Penunjang Lain</label>
					<x-input-error :messages="$errors->get('additional_check')" class="mt-2" />
					<textarea name="additional_check" id="additional_check" value="{{ old('additional_check') }}" rows="4" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('additional_check') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan hasil pemeriksaan lain yang relevan"></textarea>
				</div>
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="main_diagnose_origin" class="block text-lg font-medium text-gray-700">Diagnosa Utama</label>
						<input type="text" name="main_diagnose_origin" id="main_diagnose_origin" value="{{ old('main_diagnose_origin') }}" class="mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm @error('main_diagnose_origin') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Utama">
						<x-input-error :messages="$errors->get('main_diagnose_origin')" class="mt-2" />
					</div>
					<div>
						<label for="secondary_diagnose_origin" class="block text-lg font-medium text-gray-700">Diagnosa Sekunder</label>
						<input type="text" name="secondary_diagnose_origin" id="secondary_diagnose_origin" value="{{ old('secondary_diagnose_origin') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('secondary_diagnose_origin') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Hasil Diagnosa Sekunder">
						<x-input-error :messages="$errors->get('secondary_diagnose_origin')" class="mt-2" />
					</div>
				</div>
			</div>

			{{-- Intubasi --}}
			<div class="mt-10 bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold mb-4">Intubasi</h2>
				
				<!-- Confirmation Section -->
				<div class="mb-4">
					<label class="block text-lg font-medium text-gray-700">Apakah dilakukan intubasi?</label>
					<div class="flex items-center space-x-4 mt-2">
						<input type="radio" id="intubation_yes" value="yes" name="intConf" class="h-4 w-4 text-blue-600 border-gray-300" onclick="toggleIntubationFields(true)">
						<label for="intubation_yes" class="text-gray-700">Ya</label>
						
						<input type="radio" id="intubation_no" value="no" name="intConf" class="h-4 w-4 text-blue-600 border-gray-300" onclick="toggleIntubationFields(false)">
						<label for="intubation_no" class="text-gray-700">Tidak</label>
					</div>
				</div>

				<div id="intubation-fields" class="hidden">
					<!-- Location of Intubation -->
					<div class="my-4">
						<label class="block text-lg font-medium text-gray-700">Lokasi Intubasi</label>
						<div class="flex items-center space-x-4 mt-2">
							<input type="radio" id="intubation_location" name="intubation_location" value="IGD" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">IGD</label>
							
							<input type="radio" id="intubation_location" name="intubation_location" value="ICU" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">ICU</label>
					
							<input type="radio" id="intubation_location" name="intubation_location" value="PICU" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">PICU</label>
					
							<input type="radio" id="intubation_location" name="intubation_location" value="NICU" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">NICU</label>
					
							<input type="radio" id="intubation_location" name="intubation_location" value="OK" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">OK</label>
					
							<input type="radio" id="intubation_location" name="intubation_location" value="other" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="intubation_location" class="text-gray-700">Lainnya</label>
						</div>
					
						<!-- Input teks untuk lokasi lainnya -->
						<div id="other_location_input" class="mt-2 hidden">
							<label for="intubation_location_other" class="block text-gray-700">Masukkan Lokasi Lainnya:</label>
							<input type="text" id="intubation_location_other" name="intubation_location_other" class="mt-1 p-2 border rounded w-full" placeholder="Masukkan lokasi...">
						</div>
						<x-input-error :messages="$errors->get('intubation_location')" class="mt-2" />
					</div>
					
					<!-- Doctor Information Section -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
						<div>
							<label for="intubation_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Intubasi</label>
							<input type="datetime-local" name="intubation_datetime" id="intubation_datetime" class="mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
							<x-input-error :messages="$errors->get('intubation_datetime')" class="mt-2" />

						</div>
						<div>
							<label for="dr_intubation_name" class="block text-lg font-medium text-gray-700">Nama Dokter yang Intubasi</label>
							<input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter">
							<x-input-error :messages="$errors->get('dr_intubation_name')" class="mt-2" />

						</div>
						<div>
							<label for="dr_consultant_name" class="block text-lg font-medium text-gray-700">Nama Dokter Konsulan</label>
							<input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter Konsulan">
							<x-input-error :messages="$errors->get('dr_consultant_name')" class="mt-2" />

						</div>
					</div>
					
					<!-- Pre-Intubation -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
						<div>
							<label for="preintubation" class="block text-lg font-medium text-gray-700">Pre-Intubation</label>
							<input type="text" name="preintubation" id="preintubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="">
							<x-input-error :messages="$errors->get('preintubation')" class="mt-2" />
						</div>
					</div>

					<!-- Therapy and Ventilator Settings Section -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="therapy_type_origin" class="block text-lg font-medium text-gray-700">Therapy</label>
							<input type="text" name="therapy_type_origin" id="therapy_type_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Therapy">
							<x-input-error :messages="$errors->get('therapy_type_origin')" class="mt-2" />
						</div>
						<div>
							<label for="ett_depth_origin" class="block text-lg font-medium text-gray-700">ETT/Kedalaman</label>
							<div class="flex space-x-2">
								<div class="relative w-1/2">
									<input type="number" name="diameter_origin" id="diameter_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="7.5" min="0">
									<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
								</div>
								
								<span class="flex items-center text-lg">/</span>
								
								<div class="relative w-1/2">
									<input type="number" name="depth_origin" id="depth_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="22" min="0">
									<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
								</div>
								<x-input-error :messages="$errors->get('ett_depth_origin')" class="mt-2" />
							</div>
						</div>
					</div>

					<!-- TTV -->
					<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="td" class="block text-lg font-medium text-gray-700">TD</label>
							<div class="flex space-x-2">
								<input type="number" name="sistolik" id="sistolik" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="110" min="0">
								<span class="flex items-center text-lg">/</span>
								<input type="number" name="diastolik" id="diastolik" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="70" min="0">
								<x-input-error :messages="$errors->get('td')" class="mt-2" />
							</div>
						</div>
						
						<div>
							<label for="suhu" class="block text-lg font-medium text-gray-700">S.</label>
							<div class="relative">
								<input type="number" name="suhu" id="suhu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38.5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
								<x-input-error :messages="$errors->get('suhu')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="nadi" class="block text-lg font-medium text-gray-700">N.</label>
							<div class="relative">
								<input type="number" name="nadi" id="nadi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
								<x-input-error :messages="$errors->get('nadi')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="rr_ttv" class="block text-lg font-medium text-gray-700">RR</label>
							<div class="relative">
								<input type="number" name="rr_ttv" id="rr_ttv" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="18">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
								<x-input-error :messages="$errors->get('rr_ttv')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="spo2" class="block text-lg font-medium text-gray-700">SpO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="spo2" id="spo2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
								<x-input-error :messages="$errors->get('spo2')" class="mt-2" />
							</div> 
						</div>
					</div>

					<!-- Post-Intubation -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
						<div>
							<label for="postintubation" class="block text-lg font-medium text-gray-700">Post-Intubation</label>
							<input type="text" name="postintubation" id="postintubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="">
							<x-input-error :messages="$errors->get('postintubation')" class="mt-2" />
						</div>
					</div>
				</div>
				
				<div class="flex justify-between items-center mt-16">
					<!-- Tombol Back -->
					<a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
						Kembali
					</a>
				
					<!-- Tombol Simpan Data -->
					<button type="button" id="openModalButton" 
							class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
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

