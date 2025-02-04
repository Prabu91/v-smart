@extends('layouts.app')

@section('title', 'Intubations')

@section('content')

<div class="container mx-auto">
	
	{{-- Intubasi --}}
	<div class="relative w-full">
		<form id="intubationForm" method="POST" action="{{ route('intubations.store') }}" class="space-y-6">
			@csrf
			<input type="hidden" name="patient_id" value="{{ request()->get('patient_id') }}">
			
			<div class="bg-white p-8 rounded-xl">
				<h1 class="text-2xl text-center font-bold mb-8">Data Intubasi</h1>

				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="intubation_datetime" class="block text-md font-medium text-txtl">Tanggal dan Waktu Masuk</label>
						<input type="datetime-local" name="intubation_datetime" id="intubation_datetime" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('intubation_datetime', $intubation->intubation_datetime ?? '') }}" {{ $intubation ? 'disabled' : '' }}>
						<x-input-error :messages="$errors->get('intubation_datetime')" class="mt-2" />

					</div>
					<div>
						<label for="intubation_location" class="block text-md font-medium text-txtl">Lokasi Intubasi</label>
						<select name="intubation_location" 
								id="intubation_location" 
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('intubation_location') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror" {{ $intubation ? 'disabled' : '' }}>
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
							<label for="intubation_location_other" class="block text-txtl">Masukkan Lokasi Lainnya:</label>
							<input type="text" id="intubation_location_other" name="intubation_location_other" class="text-black font-semibold mt-1 p-2 border rounded w-full" placeholder="Masukkan lokasi..." value="{{ old('intubation_location_other', $intubation->intubation_location_other ?? '') }}">
						</div>
					
						<x-input-error :messages="$errors->get('intubation_location')" class="mt-2" />
					</div>
					
				</div>
				<!-- Doctor Information Section -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="dr_intubation_name" class="block text-md font-medium text-txtl">Nama Dokter yang Intubasi</label>
						<input type="text" name="dr_intubation_name" id="dr_intubation_name" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('dr_intubation_name') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('dr_intubation_name', $intubation->dr_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Masukan Nama Dokter">
						<x-input-error :messages="$errors->get('dr_intubation_name')" class="mt-2" />

					</div>
					<div>
						<label for="dr_consultant_name" class="block text-md font-medium text-txtl">Nama Dokter Konsulan</label>
						<input type="text" name="dr_consultant_name" id="dr_consultant_name" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('dr_consultant_name') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('dr_consultant_name', $intubation->dr_consultant ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="Masukan Nama Dokter Konsulan">
						<x-input-error :messages="$errors->get('dr_consultant_name')" class="mt-2" />

					</div>
				</div>
			</div>
			<div class="bg-white p-8 rounded-xl">
				<h1 class="text-2xl text-center font-bold mb-8">Pre Intubasi</h1>

				<!-- ETT -->
				<div>
					<label for="ett_depth" class="block text-md font-medium text-txtl">ETT/Kedalaman</label>
					<div class="flex space-x-2">
						<div class="relative w-1/2">
							<input type="number" name="diameter" id="diameter" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('diameter') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('diameter', $intubation->diameter ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="7.5" min="0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
						</div>
						
						<span class="flex items-center text-lg">/</span>
						
						<div class="relative w-1/2">
							<input type="number" name="depth" id="depth" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('depth') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('depth', $intubation->depth ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="22" min="0">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
						</div>
						<x-input-error :messages="$errors->get('diameter' || 'depth')" class="mt-2" />
					</div>
				</div>

				<!-- Pre-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="preintubation" class="block text-lg font-medium text-txtl">Pre-Intubasi</label>
						<textarea name="preintubation" id="preintubation" value="{{ old('preintubation', $intubation->pre_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('preintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan pre-intubation	"></textarea>
						<x-input-error :messages="$errors->get('preintubation')" class="mt-2" />
					</div>
				</div>

				<!-- PRE TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV Pre Intubasi</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="td" class="block text-md font-medium text-txtl">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="pre_sistolik" id="pre_sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('pre_sistolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_sistolik', $intubation->ttv->sistolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="pre_diastolik" id="pre_diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('pre_diastolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_diastolik', $intubation->ttv->diastolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="70" min="0">
							<x-input-error :messages="$errors->get('pre_sistolik' || 'pre_diastolik')" class="mt-2" />

						</div>
					</div>
					
					<div>
						<label for="pre_suhu" class="block text-md font-medium text-txtl">S.</label>
						<div class="relative">
							<input type="number" name="pre_suhu" id="pre_suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_suhu') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_suhu', $intubation->ttv->suhu ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							<x-input-error :messages="$errors->get('pre_suhu')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="pre_nadi" class="block text-md font-medium text-txtl">N.</label>
						<div class="relative">
							<input type="number" name="pre_nadi" id="pre_nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_nadi') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_nadi', $intubation->ttv->nadi ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							<x-input-error :messages="$errors->get('pre_nadi')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="pre_rr_ttv" class="block text-md font-medium text-txtl">RR</label>
						<div class="relative">
							<input type="number" name="pre_rr_ttv" id="pre_rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_rr_ttv') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_rr_ttv', $intubation->ttv->rr ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							<x-input-error :messages="$errors->get('pre_rr_ttv')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="pre_spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="pre_spo2" id="pre_spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_spo2') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('pre_spo2', $intubation->ttv->spo2 ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							<x-input-error :messages="$errors->get('pre_spo2')" class="mt-2" />

						</div> 
					</div>
				</div>
			</div>

			<div class="bg-white p-8 rounded-xl">
				<h1 class="text-2xl text-center font-bold mb-8">Post Intubasi</h1>

				<!-- Post-Intubation -->
				<div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
					<div>
						<label for="postintubation" class="block text-lg font-medium text-txtl">Post-Intubasi</label>
						<textarea name="postintubation" id="postintubation" value="{{ old('postintubation', $intubation->post_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('postintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan post-intubation	"></textarea>
						<x-input-error :messages="$errors->get('postintubation')" class="mt-2" />
					</div>
				</div>

				<!-- Post TTV -->
				<h2 class="text-xl font-bold mb-6 mt-10 ">TTV Post Intubasi</h2>
				<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
					<div>
						<label for="td" class="block text-md font-medium text-txtl">TD</label>
						<div class="flex space-x-2">
							<input type="number" name="post_sistolik" id="post_sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('post_sistolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_sistolik', $intubation->ttv->sistolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="110" min="0">
							<span class="flex items-center text-lg">/</span>
							<input type="number" name="post_diastolik" id="post_diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('post_diastolik') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_diastolik', $intubation->ttv->diastolik ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="70" min="0">
							<x-input-error :messages="$errors->get('post_sistolik' || 'post_diastolik')" class="mt-2" />

						</div>
					</div>
					
					<div>
						<label for="post_suhu" class="block text-md font-medium text-txtl">S.</label>
						<div class="relative">
							<input type="number" name="post_suhu" id="post_suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_suhu') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_suhu', $intubation->ttv->suhu ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="38.5">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
							<x-input-error :messages="$errors->get('post_suhu')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="post_nadi" class="block text-md font-medium text-txtl">N.</label>
						<div class="relative">
							<input type="number" name="post_nadi" id="post_nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_nadi') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_nadi', $intubation->ttv->nadi ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="80">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
							<x-input-error :messages="$errors->get('post_nadi')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="post_rr_ttv" class="block text-md font-medium text-txtl">RR</label>
						<div class="relative">
							<input type="number" name="post_rr_ttv" id="post_rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_rr_ttv') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_rr_ttv', $intubation->ttv->rr ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="18">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
							<x-input-error :messages="$errors->get('post_rr_ttv')" class="mt-2" />

						</div> 
					</div>
					<div>
						<label for="post_spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
						<div class="relative">
							<input type="number" name="post_spo2" id="post_spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_spo2') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" value="{{ old('post_spo2', $intubation->ttv->spo2 ?? '') }}" {{ $intubation ? 'disabled' : '' }} placeholder="95">
							<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							<x-input-error :messages="$errors->get('post_spo2')" class="mt-2" />

						</div> 
					</div>
				</div>

				{{-- Venti --}}
				<div class="my-10 bg-white rounded-xl">
					<h2 class="text-3xl font-bold mb-6 mt-2 ">Ventilator</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="venti_datetime" class="block text-md font-medium text-txtl">Tanggal dan Waktu</label>
							<input 
								type="datetime-local" 
								name="venti_datetime" 
								id="venti_datetime" 
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('venti_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
							<x-input-error :messages="$errors->get('venti_datetime')" class="mt-2" />
						</div>
						<div>
							<label for="mode_venti" class="block text-md font-medium text-txtl">Mode Venti</label>
							<input type="text" name="mode_venti" id="mode_venti" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Mode Venti">
							<x-input-error :messages="$errors->get('mode_venti')" class="mt-2" />
						</div>
					</div>
					<!-- Additional Ventilation Settings -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="ipl" class="block text-md font-medium text-txtl">IPL</label>
							<div class="relative">
								<input type="number" name="ipl" id="ipl" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('ipl') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="15">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('ipl')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="peep" class="block text-md font-medium text-txtl">PEEP</label>
							<div class="relative">
								<input type="number" name="peep" id="peep" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('peep') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('peep')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="fio2" class="block text-md font-medium text-txtl">FiO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="fio2" id="fio2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('fio2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="40">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
								<x-input-error :messages="$errors->get('fio2')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="rr" class="block text-md font-medium text-txtl">RR</label>
							<div class="relative">
								<input type="number" name="rr" id="rr" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('rr') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="20">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
								<x-input-error :messages="$errors->get('rr')" class="mt-2" />

							</div>
						</div>
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

