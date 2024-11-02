@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="patientForm" action="/patient" method="POST" class="space-y-6">
			@csrf
			<div class="bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold my-4">Data Ruang Intensif</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="icu_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Masuk</label>
						<input type="datetime-local" name="icu_room_datetime" id="icu_room_datetime" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
					</div>
					
					<div>
						<label for="icu_room_name" class="block text-md font-medium text-gray-700">Nama Ruangan</label>
						<select name="icu_room_name" id="icu_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
							<option value="">Pilih Nama Ruangan</option>
							<option value="ICU_1">ICU 1</option>
							<option value="ICU_2">ICU 2</option>
							<option value="ICU_3">ICU 3</option>
							<option value="PICU">PICU</option>
							<option value="NICU">NICU</option>
							<option value="ICCU">ICCU</option>
						</select>
					</div>
				</div>
				<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="hb_icu" class="block text-md font-medium text-gray-700">Hb</label>
						<div class="relative">
							<input type="text" name="hb_icu" id="hb_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="12.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
					</div>
					<div>
						<label for="leukosit_icu" class="block text-md font-medium text-gray-700">Leukosit</label>
						<div class="relative">
							<input type="text" name="leukosit_icu" id="leukosit_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="8,000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
					</div>
					<div>
						<label for="pcv_icu" class="block text-md font-medium text-gray-700">PCV</label>
						<div class="relative">
							<input type="text" name="pcv_icu" id="pcv_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
					</div>
					<div>
						<label for="trobosit_icu" class="block text-md font-medium text-gray-700">Trombosit</label>
						<div class="relative">
							<input type="text" name="trobosit_icu" id="trobosit_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="250,000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
					</div>
					<div>
						<label for="kreatinin_icu" class="block text-md font-medium text-gray-700">Kreatitin</label>
						<div class="relative">
							<input type="text" name="kreatinin_icu" id="kreatinin_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="1,0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
					</div>
				</div>
				<h2 class="text-xl font-bold my-4">AGD</h2>
				<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="ph_icu" class="block text-md font-medium text-gray-700">pH</label>
						<input type="text" name="ph_icu" id="ph_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="7.35">
					</div>
					<div>
						<label for="pco2_icu" class="block text-md font-medium text-gray-700">pCO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="pco2_icu" id="pco2_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
					</div>
					<div>
						<label for="po2_icu" class="block text-md font-medium text-gray-700">pO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="po2_icu" id="po2_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
					</div>
					<div>
						<label for="spo2_icu" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="spo2_icu" id="spo2_icu" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div> 
					</div> 
				</div>
			</div>

			<div class="my-10 bg-white p-8 rounded-xl">
				<div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
					<div class="mb-4">
						<label for="ro" class="block text-sm font-medium text-gray-700">RO Sudah / Belum</label>
						<select id="ro" name="ro" class="ro block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
							<option value="">Pilih status</option>
							<option value="sudah">Sudah</option>
							<option value="belum">Belum</option>
						</select>
					</div>
						
					<div>
						<label for="ro_post_incubation" class="block text-md font-medium text-gray-700">RO Post Intubasi</label>
						<input type="text" name="ro_post_incubation" id="ro_post_incubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Stabil">
					</div>
					<div>
						<label for="blood_culture" class="block text-md font-medium text-gray-700">Kultur Darah</label>
						<input type="text" name="blood_culture" id="blood_culture" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Negatif">
					</div>
				</div>
			</div>


			{{-- Intubasi --}}
			<div class="mt-10 bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold mb-4">Intubasi</h2>
				<div id="intubation-fields">
					<!-- Therapy and Ventilator Settings Section -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
						<div>
							<label for="therapy_type_origin" class="block text-md font-medium text-gray-700">Therapy</label>
							<input type="text" name="therapy_type_origin" id="therapy_type_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Therapy">
						</div>
						<div>
							<label for="mode_venti_origin" class="block text-md font-medium text-gray-700">Mode Venti</label>
							<input type="text" name="mode_venti_origin" id="mode_venti_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Mode Venti">
						</div>
						<div>
							<label for="ett_depth_origin" class="block text-md font-medium text-gray-700">ETT/Kedalaman</label>
							<input type="text" name="ett_depth_origin" id="ett_depth_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="7.5 mm / 22 cm">
						</div>
					</div>

					<!-- Additional Ventilation Settings -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="ipl_origin" class="block text-md font-medium text-gray-700">IPL</label>
							<div class="relative">
								<input type="text" name="ipl_origin" id="ipl_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="15">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
							</div>
						</div>
						<div>
							<label for="peep_origin" class="block text-md font-medium text-gray-700">PEEP</label>
							<div class="relative">
								<input type="text" name="peep_origin" id="peep_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
							</div>
						</div>
						<div>
							<label for="fio2_origin" class="block text-md font-medium text-gray-700">FiO<sub>2</sub></label>
							<div class="relative">
								<input type="text" name="fio2_origin" id="fio2_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="40">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div>
						</div>
						<div>
							<label for="rr_origin" class="block text-md font-medium text-gray-700">RR</label>
							<div class="relative">
								<input type="text" name="rr_origin" id="rr_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="20">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							</div>
						</div>
					</div>
					<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="td" class="block text-md font-medium text-gray-700">TD</label>
							<input type="text" name="ttv[][td]" id="td" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="110/70">
						</div>
						<div>
							<label for="saturasi" class="block text-md font-medium text-gray-700">S.</label>
							<div class="relative">
								<input type="text" name="ttv[][saturasi]" id="saturasi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38.5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							</div> 
						</div>
						<div>
							<label for="nadi" class="block text-md font-medium text-gray-700">N.</label>
							<div class="relative">
								<input type="text" name="ttv[][nadi]" id="nadi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							</div> 
						</div>
						<div>
							<label for="rr_ttv" class="block text-md font-medium text-gray-700">RR</label>
							<div class="relative">
								<input type="text" name="ttv[][rr]" id="rr_ttv" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="18">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							</div> 
						</div>
						<div>
							<label for="spo2" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
							<div class="relative">
								<input type="text" name="ttv[][spo2]" id="spo2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div> 
						</div>
					</div>
				</div>
				<!-- TTV -->
				
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

