@extends($layout)

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-6">Tambah Data Intubasi</h1>

    {{-- Intubasi --}}
	<div class="mt-10 bg-white p-8 rounded-xl">
		<h2 class="text-xl font-bold mb-4">Intubasi</h2>
		<div id="intubation-fields">
			<form id="intubationForm" method="POST" action="{{ route('intubations.store') }}" class="space-y-6">
				@csrf
				<input type="hidden" name="patient_id" value="{{ $patient_id }}">
				<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

				<!-- Location of Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="intubation_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu Masuk</label>
						<input type="datetime-local" name="intubation_datetime" id="intubation_datetime" class="mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
						@error('intubation_datetime')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="intubation_location" class="block text-md font-medium text-gray-700">Ruangan</label>
						<select name="intubation_location" id="intubation_location" class="mt-1 block w-full px-3 py-2 border @error('intubation_location') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
							<option value="">Pilih Ruangan</option>
							<option value="ICU">ICU</option>
							<option value="PICU">PICU</option>
							<option value="NICU">NICU</option>
							<option value="IGD">IGD</option>
							<option value="OK">OK</option>
						</select>
						@error('intubation_room_name')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>
				<!-- Doctor Information Section -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="dr_intubation_name" class="block text-md font-medium text-gray-700">Nama Dokter yang Intubasi</label>
						<input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border @error('dr_intubation_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Nama Dokter">
						@error('dr_intubation_name')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="dr_consultant_name" class="block text-md font-medium text-gray-700">Nama Dokter Konsulan</label>
						<input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border @error('dr_consultant_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Nama Dokter Konsulan">
						@error('dr_consultant_name')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<!-- Pre-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="preintubation" class="block text-lg font-medium text-gray-700">Pre-Intubation</label>
						<input type="text" name="preintubation" id="preintubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="">
						@error('preintubation')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<!-- Therapy and Ventilator Settings Section -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="therapy_type" class="block text-md font-medium text-gray-700">Therapy</label>
						<input type="text" name="therapy_type" id="therapy_type" class="mt-1 block w-full px-3 py-2 border @error('therapy_type') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Therapy">
						@error('therapy_type')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label for="ett_depth" class="block text-md font-medium text-gray-700">ETT/Kedalaman</label>
						<div class="flex space-x-2">
							<div class="relative w-1/2">
								<input type="number" name="diameter" id="diameter" class="mt-1 block w-full px-3 py-2 border @error('diameter') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="7.5" min="0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
							</div>
							
							<span class="flex items-center text-lg">/</span>
							
							<div class="relative w-1/2">
								<input type="number" name="depth" id="depth" class="mt-1 block w-full px-3 py-2 border @error('depth') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="22" min="0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
							</div>
							@error('diameter' || 'depth')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
				</div>
				
				<!-- TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="td" class="block text-md font-medium text-gray-700">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="sistolik" id="sistolik" class="mt-1 block w-1/2 px-3 py-2 border @error('sistolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="diastolik" id="diastolik" class="mt-1 block w-1/2 px-3 py-2 border @error('diastolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="70" min="0">
							@error('td')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					
					<div>
						<label for="suhu" class="block text-md font-medium text-gray-700">S.</label>
						<div class="relative">
							<input type="number" name="suhu" id="suhu" class="mt-1 block w-full px-3 py-2 border @error('suhu') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							@error('suhu')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="nadi" class="block text-md font-medium text-gray-700">N.</label>
						<div class="relative">
							<input type="number" name="nadi" id="nadi" class="mt-1 block w-full px-3 py-2 border @error('nadi') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							@error('nadi')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="rr_ttv" class="block text-md font-medium text-gray-700">RR</label>
						<div class="relative">
							<input type="number" name="rr_ttv" id="rr_ttv" class="mt-1 block w-full px-3 py-2 border @error('rr_ttv') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							@error('rr_ttv')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
					<div>
						<label for="spo2" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="spo2" id="spo2" class="mt-1 block w-full px-3 py-2 border @error('spo2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							@error('spo2')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div> 
					</div>
				</div>

				<!-- Post-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="postintubation" class="block text-lg font-medium text-gray-700">Post-Intubation</label>
						<input type="text" name="postintubation" id="postintubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="">
						@error('postintubation')
							<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<h2 class="text-xl font-bold mb-6 mt-10 ">Ventilator</h2>
				<div class="my-4">
					<label for="mode_venti" class="block text-md font-medium text-gray-700">Mode Venti</label>
					<input type="text" name="mode_venti" id="mode_venti" class="mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Mode Venti">
					@error('mode_venti')
						<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
					@enderror
				</div>
				<!-- Additional Ventilation Settings -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="ipl" class="block text-md font-medium text-gray-700">IPL</label>
						<div class="relative">
							<input type="number" name="ipl" id="ipl" class="mt-1 block w-full px-3 py-2 border @error('ipl') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="15">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
							@error('ipl')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					<div>
						<label for="peep" class="block text-md font-medium text-gray-700">PEEP</label>
						<div class="relative">
							<input type="number" name="peep" id="peep" class="mt-1 block w-full px-3 py-2 border @error('peep') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
							@error('peep')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					<div>
						<label for="fio2" class="block text-md font-medium text-gray-700">FiO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="fio2" id="fio2" class="mt-1 block w-full px-3 py-2 border @error('fio2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							@error('fio2')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>
					</div>
					<div>
						<label for="rr" class="block text-md font-medium text-gray-700">RR</label>
						<div class="relative">
							<input type="number" name="rr" id="rr" class="mt-1 block w-full px-3 py-2 border @error('rr') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="20">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							@error('rr')
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
		document.getElementById('intubationForm').submit(); 
	});
</script>
@endpush
@endsection

