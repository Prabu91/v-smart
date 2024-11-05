@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl text-center font-bold mb-6">Form Observasi Pasien ICU/PICU</h1>

    {{-- Intubasi --}}
			<div class="mt-10 bg-white p-8 rounded-xl">
				<h2 class="text-xl font-bold mb-4">Intubasi</h2>
				<div id="intubation-fields">
					<!-- Therapy and Ventilator Settings Section -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="icu_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu</label>
							<input type="datetime-local" name="icu_room_datetime" id="icu_room_datetime" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
						</div>
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

