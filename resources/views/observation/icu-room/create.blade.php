@extends('layouts.app')

@section('title', 'ICU')

@section('content')

<div class="container mx-auto">
	
	<div class="relative w-full ">
		<div id="icu-fields">
			<form id="icuForm" method="POST" action="{{ route('icu-rooms.store') }}">
				@csrf
				<input type="hidden" name="patient_id"  value="{{ request()->get('patient_id') }}">
				
				<div class="bg-white p-8 rounded-xl">
					<h1 class="text-3xl font-bold mb-8 text-center">Data Ruang Intensif</h1>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
						@php
							$minDate = now()->format('Y-m-d\TH:i');
							$maxDate = now()->addDay()->endOfDay()->format('Y-m-d\TH:i');
						@endphp

						<div>
							<label for="icu_room_datetime" class="block text-md font-medium text-gray-700">Tanggal dan Waktu</label>
							<input 
								type="datetime-local" 
								name="icu_room_datetime" 
								id="icu_room_datetime"
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('icu_room_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
								value="{{ old('icu_room_datetime') }}"
								min="{{ $minDate }}" 
								max="{{ $maxDate }}">
							<x-input-error :messages="$errors->get('icu_room_datetime')" class="mt-2" />
						</div>
						
						<div>
							<label for="icu_room_name" class="block text-md font-medium text-gray-700">Ruangan</label>
							<select 
								id="icu_room_name" 
								name="icu_room_name"
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('icu_room_name') border-red-500  @enderror rounded-md shadow-sm">
								<option value="">Pilih Ruangan</option>
								<option value="ICU" {{ old('icu_room_name', $icuData->icu_room_name ?? '') == 'ICU' ? 'selected' : '' }}>ICU</option>
								<option value="PICU" {{ old('icu_room_name', $icuData->icu_room_name ?? '') == 'PICU' ? 'selected' : '' }}>PICU</option>
								<option value="NICU" {{ old('icu_room_name', $icuData->icu_room_name ?? '') == 'NICU' ? 'selected' : '' }}>NICU</option>
								<option value="IGD" {{ old('icu_room_name', $icuData->icu_room_name ?? '') == 'IGD' ? 'selected' : '' }}>IGD</option>
							</select>

							<x-input-error :messages="$errors->get('icu_room_name')" class="mt-2" />
						</div>
						
						<div>
							<label for="icu_room_bednum" class="block text-md font-medium text-gray-700">Nomor Bed</label>
							<input 
								type="number" 
								name="icu_room_bednum" 
								id="icu_room_bednum" 
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('icu_room_bednum') border-red-500 @else {{ $icuData ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" 
								placeholder="3"
								value="{{ old('icu_room_bednum', $icuData ? $icuData->icu_room_bednum : '') }}"
								@if($icuData) readonly @endif>
							<x-input-error :messages="$errors->get('icu_room_bednum')" class="mt-2" />
						</div>
						
					</div>
				</div>

				<div class="bg-white my-6 p-8 rounded-xl">
					<h2 class="text-xl font-bold my-4">Elektrolit</h2>
					<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="natrium" class="block text-md font-medium text-gray-700">Na<sup>+</sup></label>
							<div class="relative">
								<input type="number" name="natrium" id="natrium" value="{{ old('natrium') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('natrium') border-red-500 @else border-gray-300 @enderror" placeholder="135">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
							<x-input-error :messages="$errors->get('natrium')" class="mt-2" />

						</div>
						<div>
							<label for="kalium" class="block text-md font-medium text-gray-700">K<sup>+</sup></label>
							<div class="relative">
								<input type="number" name="kalium" id="kalium" value="{{ old('kalium') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kalium') border-red-500 @else border-gray-300 @enderror" placeholder="4,0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
								<x-input-error :messages="$errors->get('kalium')" class="mt-2" />

						</div>
						<div>
							<label for="calsium" class="block text-md font-medium text-gray-700">Ca<sup>2+</sup></label>
							<div class="relative">
								<input type="number" name="calsium" id="calsium" value="{{ old('calsium') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('calsium') border-red-500 @else border-gray-300 @enderror" placeholder="8,5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
							</div>
								<x-input-error :messages="$errors->get('calsium')" class="mt-2" />

						</div>
						<div>
							<label for="magnesium" class="block text-md font-medium text-gray-700">Mg<sup>2+</sup></label>
							<div class="relative">
								<input type="number" name="magnesium" id="magnesium" value="{{ old('magnesium') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('magnesium') border-red-500 @else border-gray-300 @enderror" placeholder="1,7">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
							</div>
								<x-input-error :messages="$errors->get('magnesium')" class="mt-2" />

						</div>
						<div>
							<label for="clorida" class="block text-md font-medium text-gray-700">Cl<sup>-</sup></label>
							<div class="relative">
								<input type="number" name="clorida" id="clorida" value="{{ old('clorida') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('clorida') border-red-500 @else border-gray-300 @enderror" placeholder="97">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
								<x-input-error :messages="$errors->get('clorida')" class="mt-2" />

						</div>
						
					</div>
				</div>

				{{-- Hematologi --}}
				<div class="bg-white my-6 p-8 rounded-xl">
					<h2 class="text-xl font-bold my-4">Hematologi</h2>
					<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="hb_icu" class="block text-md font-medium text-gray-700">Hb</label>
							<div class="relative">
								<input type="number" name="hb_icu" id="hb_icu" value="{{ old('hb_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('hb_icu') border-red-500 @else border-gray-300 @enderror" placeholder="12,5">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
							</div>
							<x-input-error :messages="$errors->get('hb_icu')" class="mt-2" />

						</div>
						<div>
							<label for="leukosit_icu" class="block text-md font-medium text-gray-700">Leukosit</label>
							<div class="relative">
								<input type="number" name="leukosit_icu" id="leukosit_icu" value="{{ old('leukosit_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('leukosit_icu') border-red-500 @else border-gray-300 @enderror" placeholder="8000">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
							</div>
							<x-input-error :messages="$errors->get('leukosit_icu')" class="mt-2" />

						</div>
						<div>
							<label for="pcv_icu" class="block text-md font-medium text-gray-700">PCV</label>
							<div class="relative">
								<input type="number" name="pcv_icu" id="pcv_icu" value="{{ old('pcv_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pcv_icu') border-red-500 @else border-gray-300 @enderror" placeholder="38">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div>
							<x-input-error :messages="$errors->get('pcv_icu')" class="mt-2" />

						</div>
						<div>
							<label for="trombosit_icu" class="block text-md font-medium text-gray-700">Trombosit</label>
							<div class="relative">
								<input type="number" name="trombosit_icu" id="trombosit_icu" value="{{ old('trombosit_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('trombosit_icu') border-red-500 @else border-gray-300 @enderror" placeholder="250000">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">/µL</span>
							</div>
							<x-input-error :messages="$errors->get('trombosit_icu')" class="mt-2" />

						</div>
						<div>
							<label for="kreatinin_icu" class="block text-md font-medium text-gray-700">Kreatitin</label>
							<div class="relative">
								<input type="number" name="kreatinin_icu" id="kreatinin_icu" value="{{ old('kreatinin_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('kreatinin_icu') border-red-500 @else border-gray-300 @enderror" placeholder="1,0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
							</div>
							<x-input-error :messages="$errors->get('kreatinin_icu')" class="mt-2" />

						</div>
					</div>
				</div>

				{{-- Metabolik --}}
				<div class="bg-white my-6 p-8 rounded-xl">
					<h2 class="text-xl font-bold my-4">Metabolik</h2>
					<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
						<div>
							<label for="albumin" class="block text-md font-medium text-gray-700">Albumin</label>
							<div class="relative">
								<input type="number" name="albumin" id="albumin" value="{{ old('albumin') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('albumin') border-red-500 @else border-gray-300 @enderror" placeholder="4,0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">g/dL</span>
							</div>
							<x-input-error :messages="$errors->get('albumin')" class="mt-2" />

						</div>
						<div>
							<label for="laktat" class="block text-md font-medium text-gray-700">Laktat</label>
							<div class="relative">
								<input type="number" name="laktat" id="laktat" value="{{ old('laktat') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('laktat') border-red-500 @else border-gray-300 @enderror" placeholder="0,8">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
							<x-input-error :messages="$errors->get('laktat')" class="mt-2" />

						</div>
						<div>
							<label for="sbut" class="block text-md font-medium text-gray-700">SBUT</label>
							<div class="relative">
								<input type="number" name="sbut" id="sbut" value="{{ old('sbut') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('sbut') border-red-500 @else border-gray-300 @enderror" placeholder="0">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
							<x-input-error :messages="$errors->get('sbut')" class="mt-2" />

						</div>
						<div>
							<label for="ureum" class="block text-md font-medium text-gray-700">Ureum</label>
							<div class="relative">
								<input type="number" name="ureum" id="ureum" value="{{ old('ureum') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ureum') border-red-500 @else border-gray-300 @enderror" placeholder="10">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg/dL</span>
							</div>
							<x-input-error :messages="$errors->get('ureum')" class="mt-2" />

						</div>
					</div>
				</div>

				<div class="bg-white my-6 p-8 rounded-xl">
					<h2 class="text-xl font-bold my-4">AGD</h2>
					<div class="grid grid-cols-1 md:grid-cols-6 gap-4">
						<div>
							<label for="ph_icu" class="block text-md font-medium text-gray-700">pH</label>
							<input type="number" name="ph_icu" id="ph_icu" value="{{ old('ph_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ph_icu') border-red-500 @else border-gray-300 @enderror" placeholder="7,35">
							<x-input-error :messages="$errors->get('ph_icu')" class="mt-2" />

						</div>
						<div>
							<label for="pco2_icu" class="block text-md font-medium text-gray-700">pCO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="pco2_icu" id="pco2_icu" value="{{ old('pco2_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('pco2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="40">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
							</div>
							<x-input-error :messages="$errors->get('pco2_icu')" class="mt-2" />

						</div>
						<div>
							<label for="po2_icu" class="block text-md font-medium text-gray-700">pO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="po2_icu" id="po2_icu" value="{{ old('po2_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('po2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="80">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmHg</span>
							</div>
								<x-input-error :messages="$errors->get('po2_icu')" class="mt-2" />

						</div>
						<div>
							<label for="spo2_icu" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="spo2_icu" id="spo2_icu" value="{{ old('spo2_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('spo2_icu') border-red-500 @else border-gray-300 @enderror" placeholder="95">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
							</div>
							<x-input-error :messages="$errors->get('spo2_icu')" class="mt-2" />

						</div>
						<div>
							<label for="be_icu" class="block text-lg font-medium text-gray-700">Base Excees</label>
							<div class="relative">
								<input type="number" name="be_icu" id="be_icu" value="{{ old('be_icu') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('be_icu') border-red-500 @else border-gray-300 @enderror" placeholder="1">
							</div>
							<x-input-error :messages="$errors->get('be_icu')" class="mt-2" />

						</div>
						<div>
							<label for="sbpt" class="block text-lg font-medium text-gray-700">SBPT</label>
							<div class="relative">
								<input type="number" name="sbpt" id="sbpt" value="{{ old('sbpt') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('sbpt') border-red-500 @else border-gray-300 @enderror" placeholder="22">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mmol/L</span>
							</div>
							<x-input-error :messages="$errors->get('sbpt')" class="mt-2" />
						</div>
					</div>
				</div>

				{{-- RO, Kultur Darah --}}
				<div class="bg-white my-6 p-8 rounded-xl">
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4 pt-6">
						<div class="mb-4">
							<label for="ro" class="block text-md font-medium text-gray-700">RO Sudah / Belum</label>
							<select id="ro" name="ro" class="ro block w-full mt-1 px-3 py-2 border @error('ro') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
								<option value="">Pilih status</option>
								<option value="sudah" {{ old('ro', $icuData ? $icuData->ro : '') == 'sudah' ? 'selected' : '' }}>Sudah</option>
								<option value="belum" {{ old('ro', $icuData ? $icuData->ro : '') == 'belum' ? 'selected' : '' }}>Belum</option>
							</select>
							<x-input-error :messages="$errors->get('ro')" class="mt-2" />

						</div>
						<div>
							<label for="blood_culture" class="block text-md font-medium text-gray-700">Kultur Darah</label>
							<input type="text" name="blood_culture" id="blood_culture" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('blood_culture') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Negatif" value="{{ old('blood_culture') }}">
							<x-input-error :messages="$errors->get('blood_culture')" class="mt-2" />

						</div>
					</div>
					<div>
						<label for="ro_post_intubation" class="block text-md font-medium text-gray-700">RO Post Intubasi</label>
						<input type="text" name="ro_post_intubation" id="ro_post_intubation" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('ro_post_intubtion') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Stabil" value="{{ old('ro_post_intubation') }}">
						<x-input-error :messages="$errors->get('ro_post_intubation')" class="mt-2" />

					</div>
				</div>

				{{-- TTV --}}
				<div class="bg-white my-6 p-8 rounded-xl">
					<h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
						<div>
							<label for="td" class="block text-md font-medium text-gray-700">TD</label>
							<div class="flex space-x-2">
								<input type="number" name="sistolik" id="sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('sistolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="110" min="0" value="{{ old('sistolik', $icuData ? $icuData->sistolik : '') }}">
								<span class="flex items-center text-lg">/</span>
								<input type="number" name="diastolik" id="diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('diastolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="70" min="0" value="{{ old('diastolik', $icuData ? $icuData->diastolik : '') }}">
								<x-input-error :messages="$errors->get('sistolik' || 'diastolik')" class="mt-2" />
							</div>
						</div>
						
						<div>
							<label for="suhu" class="block text-md font-medium text-gray-700">S.</label>
							<div class="relative">
								<input type="number" name="suhu" id="suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('suhu') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="38.5" value="{{ old('suhu', $icuData ? $icuData->suhu : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
								<x-input-error :messages="$errors->get('sistolik' || 'diastolik')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="nadi" class="block text-md font-medium text-gray-700">N.</label>
							<div class="relative">
								<input type="number" name="nadi" id="nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('nadi') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="80" value="{{ old('nadi', $icuData ? $icuData->nadi : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
								<x-input-error :messages="$errors->get('nadi')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="rr_ttv" class="block text-md font-medium text-gray-700">RR</label>
							<div class="relative">
								<input type="number" name="rr_ttv" id="rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('rr_ttv') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="18" value="{{ old('rr_ttv', $icuData ? $icuData->rr_ttv : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
								<x-input-error :messages="$errors->get('rr_ttv')" class="mt-2" />
							</div> 
						</div>
						<div>
							<label for="spo2" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="spo2" id="spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('spo2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="95" value="{{ old('spo2', $icuData ? $icuData->spo2 : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
								<x-input-error :messages="$errors->get('spo2')" class="mt-2" />
							</div> 
						</div>
					</div>
				</div>

				{{-- Venti --}}
				<div class="my-10 bg-white p-8 rounded-xl">
					<h2 class="text-3xl font-bold mb-6 mt-2 ">Ventilator</h2>
					<div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="venti_datetime" class="block text-md font-semibold text-txtl">Tanggal dan Waktu</label>
							<input 
								type="datetime-local" 
								name="venti_datetime" 
								id="venti_datetime" 
								class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('venti_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('venti_datetime', $icuData ? $icuData->venti_datetime : '') }}">
							<x-input-error :messages="$errors->get('venti_datetime')" class="mt-2" />
						</div>
						<div>
							<label for="mode_venti" class="block text-md font-semibold text-txtl">Mode Venti</label>
							<input type="text" name="mode_venti" id="mode_venti" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="Masukan Mode Venti" value="{{ old('mode_venti', $icuData ? $icuData->mode_venti : '') }}">
							<x-input-error :messages="$errors->get('mode_venti')" class="mt-2" />
						</div>
					</div>
					<!-- Additional Ventilation Settings -->
					<div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
						<div>
							<label for="ipl" class="block text-md font-semibold text-txtl">IPL</label>
							<div class="relative">
								<input type="number" name="ipl" id="ipl" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('ipl') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="15" value="{{ old('ipl', $icuData ? $icuData->ipl : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('ipl')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="peep" class="block text-md font-semibold text-txtl">PEEP</label>
							<div class="relative">
								<input type="number" name="peep" id="peep" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('peep') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="5" value="{{ old('peep', $icuData ? $icuData->peep : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
								<x-input-error :messages="$errors->get('peep')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="fio2" class="block text-md font-semibold text-txtl">FiO<sub>2</sub></label>
							<div class="relative">
								<input type="number" name="fio2" id="fio2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('fio2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="40" value="{{ old('fio2', $icuData ? $icuData->fio2 : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
								<x-input-error :messages="$errors->get('fio2')" class="mt-2" />

							</div>
						</div>
						<div>
							<label for="rr" class="block text-md font-semibold text-txtl">RR</label>
							<div class="relative">
								<input type="number" name="rr" id="rr" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('rr') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="20" value="{{ old('rr', $icuData ? $icuData->rr : '') }}">
								<span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
								<x-input-error :messages="$errors->get('rr')" class="mt-2" />

							</div>
						</div>
					</div>
				</div>


				<div class="flex justify-between items-center">
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
				
			</form>
		</div>
			
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
		document.getElementById('icuForm').submit(); 
	});

	//venti datetime
    // document.addEventListener("DOMContentLoaded", function() {
    //     let now = new Date();
    //     let oneHoursAgo = new Date(now.getTime() - (1 * 60 * 60 * 1000));

    //     document.getElementById("venti_datetime").max = now.toISOString().slice(0,16);
    //     document.getElementById("venti_datetime").min = oneHoursAgo.toISOString().slice(0,16);
    // });

</script>
@endpush


@endsection

