@extends('layouts.app')

@section('title', 'Intubations')

@section('content')

<div class="container mx-auto">
    
    {{-- Intubasi --}}
    <div class="relative w-full">
    <form id="intubationForm" method="POST" action="{{ route('intubations.update', $intubation->id) }}" class="space-y-6">
    @csrf
    @method('PUT')
    <input type="hidden" name="patient_id" value="{{ $intubation->patient_id }}">
    
    <div class="bg-white p-8 rounded-xl">
        <h1 class="text-2xl text-center font-bold mb-8">Data Intubasi</h1>
    
        <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
                $minDate = now()->subHours(5)->format('Y-m-d\TH:i');
                $maxDate = now()->format('Y-m-d\TH:i');
            @endphp
            <div>
                <label for="intubation_datetime" class="block text-md font-medium text-txtl">Tanggal dan Waktu Masuk</label>
                <input 
                    type="datetime-local" 
                    name="intubation_datetime" 
                    id="intubation_datetime" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    value="{{ old('intubation_datetime', optional($intubation)->intubation_datetime ? \Carbon\Carbon::parse($intubation->intubation_datetime)->format('Y-m-d\TH:i') : '') }}" 
                    min="{{ $minDate }}" 
                    max="{{ $maxDate }}">
                <x-input-error :messages="$errors->get('intubation_datetime')" class="mt-2" />
            </div>
            <div>
                <label for="intubation_location" class="block text-md font-medium text-txtl">Lokasi Intubasi</label>
                <select name="intubation_location" 
                        id="intubation_location" 
                        class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('intubation_location') border-red-500 @else border-gray-300 @enderror">
                    <option value="" {{ old('intubation_location', optional($intubation)->intubation_location) === '' ? 'selected' : '' }}>Pilih Lokasi</option>
                    <option value="IGD" {{ old('intubation_location', optional($intubation)->intubation_location) === 'IGD' ? 'selected' : '' }}>IGD</option>
                    <option value="ICU" {{ old('intubation_location', optional($intubation)->intubation_location) === 'ICU' ? 'selected' : '' }}>ICU</option>
                    <option value="PICU" {{ old('intubation_location', optional($intubation)->intubation_location) === 'PICU' ? 'selected' : '' }}>PICU</option>
                    <option value="NICU" {{ old('intubation_location', optional($intubation)->intubation_location) === 'NICU' ? 'selected' : '' }}>NICU</option>
                    <option value="OK" {{ old('intubation_location', optional($intubation)->intubation_location) === 'OK' ? 'selected' : '' }}>OK</option>
                    <option value="other" {{ old('intubation_location', optional($intubation)->intubation_location) === 'other' || ($intubation && !in_array($intubation->intubation_location, ['IGD', 'ICU', 'PICU', 'NICU', 'OK'])) ? 'selected' : '' }}>Lainnya</option>
                </select>
            
                <div id="other_location_input" class="mt-2 {{ old('intubation_location', optional($intubation)->intubation_location) === 'other' || ($intubation && !in_array($intubation->intubation_location, ['IGD', 'ICU', 'PICU', 'NICU', 'OK'])) ? '' : 'hidden' }}">
                    <label for="intubation_location_other" class="block text-txtl">Masukkan Lokasi Lainnya:</label>
                    <input type="text" id="intubation_location_other" name="intubation_location_other" class="text-black font-semibold mt-1 p-2 border rounded w-full" placeholder="Masukkan lokasi..." value="{{ old('intubation_location_other', optional($intubation)->intubation_location_other) }}">
                </div>
            
                <x-input-error :messages="$errors->get('intubation_location')" class="mt-2" />
            </div>
            
        </div>
        <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="dr_intubation_name" class="block text-md font-medium text-txtl">Nama Dokter yang Intubasi</label>
                <input type="text" name="dr_intubation_name" id="dr_intubation_name" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('dr_intubation_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('dr_intubation_name', optional($intubation)->dr_intubation) }}" placeholder="Masukan Nama Dokter">
                <x-input-error :messages="$errors->get('dr_intubation_name')" class="mt-2" />

            </div>
            <div>
                <label for="dr_consultant_name" class="block text-md font-medium text-txtl">Nama Dokter Konsulan</label>
                <input type="text" name="dr_consultant_name" id="dr_consultant_name" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('dr_consultant_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('dr_consultant_name', optional($intubation)->dr_consultant) }}" placeholder="Masukan Nama Dokter Konsulan">
                <x-input-error :messages="$errors->get('dr_consultant_name')" class="mt-2" />

            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl">
        <h1 class="text-2xl text-center font-bold mb-8">Informasi Tabung Intubasi</h1>
        
        <div class="mb-4">
            <label for="intubation_type" class="block text-md font-medium text-txtl">Jenis Intubasi</label>
            <select name="intubation_type" id="intubation_type" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm">
                <option value="ETT" {{ old('intubation_type', optional($intubation)->intubation_type) == 'ETT' ? 'selected' : '' }}>ETT (Endotracheal Tube)</option>
                <option value="TC" {{ old('intubation_type', optional($intubation)->intubation_type) == 'TC' ? 'selected' : '' }}>TC (Tracheostomy Tube)</option>
            </select>
        </div>
        
        <div id="ett_fields">
            <div>
                <label for="ett_diameter" class="block text-md font-medium text-txtl">Diameter ETT</label>
                <div class="relative">
                    <input type="number" name="ett_diameter" id="ett_diameter" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ett_diameter') border-red-500 @else border-gray-300 @enderror" placeholder="7.5" value="{{ old('ett_diameter', optional($intubation)->ett_diameter) }}" min="0" step="any">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
                </div>
                <x-input-error :messages="$errors->get('ett_diameter')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="ett_depth" class="block text-md font-medium text-txtl">Kedalaman ETT</label>
                <div class="relative">
                    <input type="number" name="ett_depth" id="ett_depth" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ett_depth') border-red-500 @else border-gray-300 @enderror" placeholder="22" value="{{ old('ett_depth', optional($intubation)->ett_depth) }}" min="0" step="any">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
                </div>
                <x-input-error :messages="$errors->get('ett_depth')" class="mt-2" />
            </div>
        </div>

        <div id="tc_fields" class="hidden">
            <div>
                <label for="tc_diameter" class="block text-md font-medium text-txtl">Diameter TC</label>
                <div class="relative">
                    <input type="number" name="tc_diameter" id="tc_diameter" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('tc_diameter') border-red-500 @else border-gray-300 @enderror" placeholder="8.0" value="{{ old('tc_diameter', optional($intubation)->tc_diameter) }}" min="0" step="any">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
                </div>
                <x-input-error :messages="$errors->get('tc_diameter')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="tc_type" class="block text-md font-medium text-txtl">Jenis TC</label>
                <input type="text" name="tc_type" id="tc_type" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('tc_type') border-red-500 @else border-gray-300 @enderror" placeholder="Masukkan jenis TC" value="{{ old('tc_type', optional($intubation)->tc_type) }}">
                <x-input-error :messages="$errors->get('tc_type')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl">
        <h1 class="text-2xl text-center font-bold mb-8">Pre Intubasi</h1>

        <div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
            <div>
                <label for="preintubation" class="block text-lg font-medium text-txtl">Pre-Intubasi</label>
                <textarea name="preintubation" id="preintubation" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('preintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan pre-intubation">{{ old('preintubation', optional($intubation)->pre_intubation) }}</textarea>
                <x-input-error :messages="$errors->get('preintubation')" class="mt-2" />
            </div>
        </div>

        <h2 class="text-xl font-bold mb-6 mt-10 ">TTV Pre Intubasi</h2>
        <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label for="pre_sistolik" class="block text-md font-medium text-txtl">TD</label>
                <div class="flex space-x-2">
                    <input type="number" name="pre_sistolik" id="pre_sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('pre_sistolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_sistolik', optional($intubation->ttvPre)->sistolik) }}" placeholder="110" min="0">
                    <span class="flex items-center text-lg">/</span>
                    <input type="number" name="pre_diastolik" id="pre_diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('pre_diastolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_diastolik', optional($intubation->ttvPre)->diastolik) }}" placeholder="70" min="0">
                    <x-input-error :messages="$errors->get('pre_sistolik' || 'pre_diastolik')" class="mt-2" />
                </div>
            </div>
            
            <div>
                <label for="pre_suhu" class="block text-md font-medium text-txtl">S.</label>
                <div class="relative">
                    <input type="number" name="pre_suhu" id="pre_suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_suhu') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_suhu', optional($intubation->ttvPre)->suhu) }}" placeholder="38.5">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
                    <x-input-error :messages="$errors->get('pre_suhu')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="pre_nadi" class="block text-md font-medium text-txtl">N.</label>
                <div class="relative">
                    <input type="number" name="pre_nadi" id="pre_nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_nadi') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_nadi', optional($intubation->ttvPre)->nadi) }}" placeholder="80">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
                    <x-input-error :messages="$errors->get('pre_nadi')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="pre_rr_ttv" class="block text-md font-medium text-txtl">RR</label>
                <div class="relative">
                    <input type="number" name="pre_rr_ttv" id="pre_rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_rr_ttv') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_rr_ttv', optional($intubation->ttvPre)->rr) }}" placeholder="18">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                    <x-input-error :messages="$errors->get('pre_rr_ttv')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="pre_spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
                <div class="relative">
                    <input type="number" name="pre_spo2" id="pre_spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_spo2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_spo2', optional($intubation->ttvPre)->spo2) }}" placeholder="95">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                    <x-input-error :messages="$errors->get('pre_spo2')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="pre_consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
                <input type="text" name="pre_consciousness" id="pre_consciousness" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_consciousness', optional($intubation->ttvPre)->consciousness) }}" placeholder="">
                <x-input-error :messages="$errors->get('pre_consciousness')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl">
        <h1 class="text-2xl text-center font-bold mb-8">Post Intubasi</h1>

        <div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
            <div>
                <label for="postintubation" class="block text-lg font-medium text-txtl">Post-Intubasi</label>
                <textarea name="postintubation" id="postintubation" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('postintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan post-intubation">{{ old('postintubation', optional($intubation)->post_intubation) }}</textarea>
                <x-input-error :messages="$errors->get('postintubation')" class="mt-2" />
            </div>
        </div>

        <h2 class="text-xl font-bold mb-6 mt-10 ">TTV Post Intubasi</h2>
        <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label for="post_sistolik" class="block text-md font-medium text-txtl">TD</label>
                <div class="flex space-x-2">
                    <input type="number" name="post_sistolik" id="post_sistolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('post_sistolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_sistolik', optional($intubation->ttvPost)->sistolik) }}" placeholder="110" min="0">
                    <span class="flex items-center text-lg">/</span>
                    <input type="number" name="post_diastolik" id="post_diastolik" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border @error('post_diastolik') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_diastolik', optional($intubation->ttvPost)->diastolik) }}" placeholder="70" min="0">
                    <x-input-error :messages="$errors->get('post_sistolik' || 'post_diastolik')" class="mt-2" />
                </div>
            </div>
            
            <div>
                <label for="post_suhu" class="block text-md font-medium text-txtl">S.</label>
                <div class="relative">
                    <input type="number" name="post_suhu" id="post_suhu" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_suhu') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_suhu', optional($intubation->ttvPost)->suhu) }}" placeholder="38.5">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
                    <x-input-error :messages="$errors->get('post_suhu')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="post_nadi" class="block text-md font-medium text-txtl">N.</label>
                <div class="relative">
                    <input type="number" name="post_nadi" id="post_nadi" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_nadi') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_nadi', optional($intubation->ttvPost)->nadi) }}" placeholder="80">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
                    <x-input-error :messages="$errors->get('post_nadi')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="post_rr_ttv" class="block text-md font-medium text-txtl">RR</label>
                <div class="relative">
                    <input type="number" name="post_rr_ttv" id="post_rr_ttv" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_rr_ttv') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_rr_ttv', optional($intubation->ttvPost)->rr) }}" placeholder="18">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                    <x-input-error :messages="$errors->get('post_rr_ttv')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="post_spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
                <div class="relative">
                    <input type="number" name="post_spo2" id="post_spo2" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_spo2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_spo2', optional($intubation->ttvPost)->spo2) }}" placeholder="95">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                    <x-input-error :messages="$errors->get('post_spo2')" class="mt-2" />
                </div> 
            </div>
            <div>
                <label for="post_consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
                <input type="text" name="post_consciousness" id="post_consciousness" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_consciousness', optional($intubation->ttvPost)->consciousness) }}" placeholder="">
                <x-input-error :messages="$errors->get('post_consciousness')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl">
        <h2 class="text-3xl font-bold mb-6 mt-2 ">Ventilator</h2>
        <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="venti_datetime" class="block text-md font-medium text-txtl">Tanggal dan Waktu</label>
                <input 
                type="datetime-local" 
                name="venti_datetime" 
                id="venti_datetime" 
                class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('venti_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                value="{{ old('venti_datetime', optional($intubation->venti)->venti_datetime ? \Carbon\Carbon::parse($intubation->venti->venti_datetime)->format('Y-m-d\TH:i') : '') }}"
                min="{{ $minDate }}" 
                max="{{ $maxDate }}">
                <x-input-error :messages="$errors->get('venti_datetime')" class="mt-2" />
            </div>
            <div>
                <label for="mode_venti" class="block text-md font-medium text-txtl">Mode Venti</label>
                <input 
                type="text" 
                name="mode_venti" 
                id="mode_venti" 
                class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                placeholder="Masukan Mode Venti"
                value="{{ old('mode_venti', optional($intubation->venti)->mode_venti) }}"> <x-input-error :messages="$errors->get('mode_venti')" class="mt-2" />
            </div>
        </div>
        <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label for="ipl" class="block text-md font-medium text-txtl">IPL</label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="ipl" 
                    id="ipl" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('ipl') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder="15"
                    value="{{ old('ipl', optional($intubation->venti)->ipl) }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
                    <x-input-error :messages="$errors->get('ipl')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="peep" class="block text-md font-medium text-txtl">PEEP</label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="peep" 
                    id="peep" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('peep') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder="5"
                    value="{{ old('peep', optional($intubation->venti)->peep) }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
                    <x-input-error :messages="$errors->get('peep')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="fio2" class="block text-md font-medium text-txtl">FiO<sub>2</sub></label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="fio2" 
                    id="fio2" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('fio2') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder="40"
                    value="{{ old('fio2', optional($intubation->venti)->fio2) }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                    <x-input-error :messages="$errors->get('fio2')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="rr" class="block text-md font-medium text-txtl">RR</label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="rr" 
                    id="rr" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('rr') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder="20"
                    value="{{ old('rr', optional($intubation->venti)->rr) }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                    <x-input-error :messages="$errors->get('rr')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="ps" class="block text-md font-medium text-txtl">PS</label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="ps" 
                    id="ps" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('ps') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder="5"
                    value="{{ old('ps', optional($intubation->venti)->ps) }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH2O</span>
                    <x-input-error :messages="$errors->get('ps')" class="mt-2" />
                </div>
            </div>
            <div>
                <label for="trigger" class="block text-md font-medium text-txtl">Trigger</label>
                <div class="relative">
                    <input 
                    type="number" 
                    name="trigger" 
                    id="trigger" 
                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('trigger') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                    placeholder=""
                    value="{{ old('trigger', optional($intubation->venti)->trigger) }}"> <x-input-error :messages="$errors->get('trigger')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
            <div>
                <label for="venti_param" class="block text-lg font-medium text-txtl">Parameter lain : </label>
                <textarea name="venti_param" id="venti_param" rows="4" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('venti_param') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan parameter lain ">{{ old('venti_param', optional($intubation->venti)->venti_param) }}</textarea>
                <x-input-error :messages="$errors->get('venti_param')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="button" id="openModalButton" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Perbarui Data
        </button>
    </div>

</form>

<!-- Modal Konfirmasi -->
<div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Perubahan Data</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin memperbarui data ini?
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmButton" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Konfirmasi
                </button>
                <button id="cancelButton" class="mt-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const intubationLocationSelect = document.getElementById('intubation_location');
        const otherLocationInput = document.getElementById('other_location_input');
        
        const intubationTypeSelect = document.getElementById('intubation_type');
        const ettFields = document.getElementById('ett_fields');
        const tcFields = document.getElementById('tc_fields');

        // Function to toggle other location input
        const toggleOtherLocation = () => {
            if (intubationLocationSelect.value === 'other') {
                otherLocationInput.classList.remove('hidden');
            } else {
                otherLocationInput.classList.add('hidden');
            }
        };

        // Function to toggle ETT and TC fields
        const toggleIntubationTypeFields = () => {
            if (intubationTypeSelect.value === 'ETT') {
                ettFields.classList.remove('hidden');
                tcFields.classList.add('hidden');
            } else if (intubationTypeSelect.value === 'TC') {
                tcFields.classList.remove('hidden');
                ettFields.classList.add('hidden');
            }
        };

        // Initial check on page load
        toggleOtherLocation();
        toggleIntubationTypeFields();

        // Event listeners for changes
        intubationLocationSelect.addEventListener('change', toggleOtherLocation);
        intubationTypeSelect.addEventListener('change', toggleIntubationTypeFields);

        // Modal functionality
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        document.getElementById('confirmButton').addEventListener('click', function() {
            document.getElementById('intubationForm').submit(); 
        });
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const intubationLocationSelect = document.getElementById('intubation_location');
        const otherLocationInput = document.getElementById('other_location_input');
        
        const intubationTypeSelect = document.getElementById('intubation_type');
        const ettFields = document.getElementById('ett_fields');
        const tcFields = document.getElementById('tc_fields');

        // Fungsi untuk mengaktifkan/menyembunyikan input lokasi lainnya
        function toggleOtherLocation() {
            if (intubationLocationSelect.value === 'other') {
                otherLocationInput.classList.remove('hidden');
            } else {
                otherLocationInput.classList.add('hidden');
            }
        }

        // Fungsi untuk mengaktifkan/menyembunyikan bidang ETT dan TC
        function toggleIntubationTypeFields() {
            if (intubationTypeSelect.value === 'ETT') {
                ettFields.classList.remove('hidden');
                tcFields.classList.add('hidden');
            } else if (intubationTypeSelect.value === 'TC') {
                tcFields.classList.remove('hidden');
                ettFields.classList.add('hidden');
            }
        }

        // Jalankan fungsi saat halaman dimuat
        toggleOtherLocation();
        toggleIntubationTypeFields();

        // Tambahkan event listener untuk perubahan
        intubationLocationSelect.addEventListener('change', toggleOtherLocation);
        intubationTypeSelect.addEventListener('change', toggleIntubationTypeFields);

        // Fungsionalitas Modal
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        document.getElementById('confirmButton').addEventListener('click', function() {
            document.getElementById('intubationForm').submit(); 
        });
    });
</script>
@endpush
@endsection