@extends($layout)

@section('content')

<div class="container mx-auto p-6">
	<h1 class="text-3xl text-center font-bold mb-6">Tambah Data Pemakaian Ventilator</h1>
	
	<div class="relatif w-full">
		<div id="ventilator-fields">
			<form id="ventilatorForm" action="{{ route('ventilators.store') }}" method="POST" class="space-y-6">
				@csrf
				<input type="hidden" name="patient_id"  value="{{ request()->get('patient_id') }}">
				<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

				{{-- Venti --}}
				<div class="my-10 bg-white p-8 rounded-xl">
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="venti_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu</label>
							<input 
								type="datetime-local" 
								name="venti_datetime" 
								id="venti_datetime" 
								class="mt-1 block w-full px-3 py-2 border @error('venti_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
							<x-input-error :messages="$errors->get('venti_datetime')" class="mt-2" />
						</div>
						<div>
							<label for="mode_venti" class="block text-md font-medium text-gray-700">Mode Venti</label>
							<input type="text" name="mode_venti" id="mode_venti" class="mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Mode Venti">
							<x-input-error :messages="$errors->get('mode_venti')" class="mt-2" />
						</div>
					</div>
					<!-- Additional Ventilation Settings -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="ipl" class="block text-md font-medium text-gray-700">IPL</label>
							<div class="relative">
								<input type="number" name="ipl" id="ipl" class="mt-1 block w-full px-3 py-2 border @error('ipl') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="15">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('ipl')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="peep" class="block text-md font-medium text-gray-700">PEEP</label>
							<div class="relative">
								<input type="number" name="peep" id="peep" class="mt-1 block w-full px-3 py-2 border @error('peep') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('peep')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="fio2" class="block text-md font-medium text-gray-700">FiO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="fio2" id="fio2" class="mt-1 block w-full px-3 py-2 border @error('fio2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="40">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							<x-input-error :messages="$errors->get('fio2')" class="mt-2" />

						</div>
					</div>
					<div>
						<label for="rr" class="block text-md font-medium text-gray-700">RR</label>
						<div class="relative">
							<input type="number" name="rr" id="rr" class="mt-1 block w-full px-3 py-2 border @error('rr') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="20">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							<x-input-error :messages="$errors->get('rr')" class="mt-2" />	
						</div>
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
		document.getElementById('ventilatorForm').submit(); 
	});
</script>
@endpush
@endsection

