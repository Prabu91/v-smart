@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1>

    <div class="relative w-full ">
        <!-- Form -->
		<form id="originForm" action="/origin" method="POST" class="space-y-6">
			@csrf
			<div class="bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold my-4">Data Awal Pasien Masuk</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="origin_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Masuk</label>
						<input type="datetime-local" name="origin_room_datetime" id="origin_room_datetime" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
					</div>
					
					<div>
						<label for="origin_room_name" class="block text-md font-medium text-gray-700">Nama/Nomor Ruangan Asal Pasien</label>
						<input type="text" name="origin_room_name" id="origin_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Ruangan">
					</div>
				</div>
				<h2 class="text-xl font-bold my-4">Hasil Lab Awal Masuk ICU</h2>
				<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="hb_origin" class="block text-md font-medium text-gray-700">Hb</label>
						<div class="relative">
							<input type="text" name="hb_origin" id="hb_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="12.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
						</div>
					</div>
					<div>
						<label for="leukosit_origin" class="block text-md font-medium text-gray-700">Leukosit</label>
						<div class="relative">
							<input type="text" name="leukosit_origin" id="leukosit_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="8,000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
					</div>
					<div>
						<label for="pcv_origin" class="block text-md font-medium text-gray-700">PCV</label>
						<div class="relative">
							<input type="text" name="pcv_origin" id="pcv_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div>
					</div>
					<div>
						<label for="trobosit_origin" class="block text-md font-medium text-gray-700">Trombosit</label>
						<div class="relative">
							<input type="text" name="trobosit_origin" id="trobosit_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="250,000">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
						</div>
					</div>
					<div>
						<label for="kreatinin_origin" class="block text-md font-medium text-gray-700">Kreatitin</label>
						<div class="relative">
							<input type="text" name="kreatinin_origin" id="kreatinin_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="1,0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
						</div>
					</div>
				</div>
				<h2 class="text-xl font-bold my-4">AGD</h2>
				<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="ph_origin" class="block text-md font-medium text-gray-700">pH</label>
						<input type="text" name="ph_origin" id="ph_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="7.35">
					</div>
					<div>
						<label for="pco2_origin" class="block text-md font-medium text-gray-700">pCO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="pco2_origin" id="pco2_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
					</div>
					<div>
						<label for="po2_origin" class="block text-md font-medium text-gray-700">pO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="po2_origin" id="po2_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
						</div>
					</div>
					<div>
						<label for="spo2_origin" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="text" name="spo2_origin" id="spo2_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
						</div> 
					</div> 
				</div>
			</div>

			<div class="bg-white p-8 rounded-xl">
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="radiology" class="block text-md font-medium text-gray-700">Radiologi</label>
						<p class="text-sm text-gray-500">CT scan / MRI / USG</p>
						<input type="text" name="radiology" id="radiology" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil Radiologi">
					</div>
					<div>
						<label for="ro_thorax" class="block text-md font-medium text-gray-700 mb-6">RO Thorax</label>
						<input type="text" name="ro_thorax" id="ro_thorax" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil RO Thorax">
					</div>
				</div>
				<div>
					<label for="additional_check" class="block text-md font-medium text-gray-700 mb-2">Pemeriksaan Penunjang Lain</label>
					<textarea name="additional_check" id="additional_check" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm resize-none" placeholder="Masukan hasil pemeriksaan lain yang relevan"></textarea>
				</div>
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="main_diagnose_origin" class="block text-md font-medium text-gray-700">Diagnosa Utama</label>
						<input type="text" name="main_diagnose_origin" id="main_diagnose_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil Diagnosa Utama">
					</div>
					<div>
						<label for="secondary_diagnose_origin" class="block text-md font-medium text-gray-700">Diagnosa Sekunder</label>
						<input type="text" name="secondary_diagnose_origin" id="secondary_diagnose_origin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil Diagnosa Sekunder">
					</div>
				</div>
			</div>

			{{-- Intubasi --}}
			<div class="mt-10 bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold mb-4">Intubasi</h2>
				
				<!-- Confirmation Section -->
				<div class="mb-4">
					<label class="block text-md font-medium text-gray-700">Apakah dilakukan intubasi?</label>
					<div class="flex items-center space-x-4 mt-2">
						<input type="radio" id="intubation_yes" name="intubation_confirm" value="yes" class="h-4 w-4 text-blue-600 border-gray-300" onclick="toggleIntubationFields(true)">
						<label for="intubation_yes" class="text-gray-700">Ya</label>
						
						<input type="radio" id="intubation_no" name="intubation_confirm" value="no" class="h-4 w-4 text-blue-600 border-gray-300" onclick="toggleIntubationFields(false)">
						<label for="intubation_no" class="text-gray-700">Tidak</label>
					</div>
				</div>

				<div id="intubation-fields" class="hidden">
					<!-- Location of Intubation -->
					<div class="my-4">
						<label class="block text-md font-medium text-gray-700">Lokasi Intubasi</label>
						<div class="flex items-center space-x-4 mt-2">
							<input type="radio" id="origin_room" name="intubation_location" value="origin" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="origin_room" class="text-gray-700">Ruangan Asal</label>
							
							<input type="radio" id="er_room" name="intubation_location" value="er" class="h-4 w-4 text-blue-600 border-gray-300">
							<label for="er_room" class="text-gray-700">IGD</label>
						</div>
					</div>

					<!-- Doctor Information Section -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="dr_intubation_name" class="block text-md font-medium text-gray-700">Nama Dokter yang Intubasi</label>
							<input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter">
						</div>
						<div>
							<label for="dr_consultant_name" class="block text-md font-medium text-gray-700">Nama Dokter Konsulan</label>
							<input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter Konsulan">
						</div>
					</div>

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
					
					<!-- TTV -->
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

document.getElementById('confirmButton').addEventListener('click', function() {
    document.getElementById('originForm').submit(); // Kirim form
});

    function toggleIntubationFields(show) {
        const intubationFields = document.getElementById("intubation-fields");
        intubationFields.classList.toggle("hidden", !show);
    }


</script>
@endpush


@endsection

