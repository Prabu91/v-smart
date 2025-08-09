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
                            class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('intubation_datetime') border-red-500 @else {{ $intubation ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'border-gray-300' }} @enderror rounded-md shadow-sm" 
                            value="{{ old('intubation_datetime', $intubation->intubation_datetime ?? '') }}" 
                            {{ $intubation ? 'disabled' : '' }} 
                            min="{{ $minDate }}" 
                            max="{{ $maxDate }}">
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
                    
                        <div id="other_location_input" class="mt-2 {{ old('intubation_location', $intubation->intubation_location ?? '') === 'other' ? '' : 'hidden' }}">
                            <label for="intubation_location_other" class="block text-txtl">Masukkan Lokasi Lainnya:</label>
                            <input type="text" id="intubation_location_other" name="intubation_location_other" class="text-black font-semibold mt-1 p-2 border rounded w-full" placeholder="Masukkan lokasi..." value="{{ old('intubation_location_other', $intubation->intubation_location_other ?? '') }}">
                        </div>
                    
                        <x-input-error :messages="$errors->get('intubation_location')" class="mt-2" />
                    </div>
                    
                </div>
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
                <h1 class="text-2xl text-center font-bold mb-8">Informasi Tabung Intubasi</h1>
                
                {{-- Select Option ETT atau TC --}}
                <div class="mb-4">
                    <label for="intubation_type" class="block text-md font-medium text-txtl">Jenis Intubasi</label>
                    <select name="intubation_type" id="intubation_type" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm">
                        <option value="ETT" {{ old('intubation_type') == 'ETT' ? 'selected' : '' }}>ETT (Endotracheal Tube)</option>
                        <option value="TC" {{ old('intubation_type') == 'TC' ? 'selected' : '' }}>TC (Tracheostomy Tube)</option>
                    </select>
                </div>
                
                {{-- Container untuk input ETT (default) --}}
                <div id="ett_fields">
                    <div>
                        <label for="ett_diameter" class="block text-md font-medium text-txtl">Diameter ETT</label>
                        <div class="relative">
                            <input type="number" name="ett_diameter" id="ett_diameter" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ett_diameter') border-red-500 @else border-gray-300 @enderror" placeholder="7.5" value="{{ old('ett_diameter') }}" min="0" step="any">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
                        </div>
                        <x-input-error :messages="$errors->get('ett_diameter')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="ett_depth" class="block text-md font-medium text-txtl">Kedalaman ETT</label>
                        <div class="relative">
                            <input type="number" name="ett_depth" id="ett_depth" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('ett_depth') border-red-500 @else border-gray-300 @enderror" placeholder="22" value="{{ old('ett_depth') }}" min="0" step="any">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm</span>
                        </div>
                        <x-input-error :messages="$errors->get('ett_depth')" class="mt-2" />
                    </div>
                </div>

                {{-- Container untuk input TC (hidden by default) --}}
                <div id="tc_fields" class="hidden">
                    <div>
                        <label for="tc_diameter" class="block text-md font-medium text-txtl">Diameter TC</label>
                        <div class="relative">
                            <input type="number" name="tc_diameter" id="tc_diameter" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('tc_diameter') border-red-500 @else border-gray-300 @enderror" placeholder="8.0" value="{{ old('tc_diameter') }}" min="0" step="any">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mm</span>
                        </div>
                        <x-input-error :messages="$errors->get('tc_diameter')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="tc_type" class="block text-md font-medium text-txtl">Jenis TC</label>
                        <input type="text" name="tc_type" id="tc_type" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm @error('tc_type') border-red-500 @else border-gray-300 @enderror" placeholder="Masukkan jenis TC" value="{{ old('tc_type') }}">
                        <x-input-error :messages="$errors->get('tc_type')" class="mt-2" />
                    </div>
                </div>

            </div>
            
            <div class="bg-white p-8 rounded-xl">
                <h1 class="text-2xl text-center font-bold mb-8">Pre Intubasi</h1>

                <div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
                    <div>
                        <label for="preintubation" class="block text-lg font-medium text-txtl">Pre-Intubasi</label>
                        <textarea name="preintubation" id="preintubation" value="{{ old('preintubation', $intubation->pre_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('preintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan pre-intubation    ">{{ old('preintubation', $intubation->pre_intubation ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('preintubation')" class="mt-2" />
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-6 mt-10 ">TTV Pre Intubasi</h2>
                <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
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
					<div>
						<label for="pre_consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
						<input type="text" name="pre_consciousness" id="pre_consciousness" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('pre_consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('pre_consciousness', $intubation->ttv->pre_consciousness ?? '') }}" placeholder="">
						<x-input-error :messages="$errors->get('pre_consciousness')" class="mt-2" />
					</div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl">
                <h1 class="text-2xl text-center font-bold mb-8">Post Intubasi</h1>

                <div class="my-4 grid grid-cols-1 md:grid-cols-1 gap-4">
                    <div>
                        <label for="postintubation" class="block text-lg font-medium text-txtl">Post-Intubasi</label>
                        <textarea name="postintubation" id="postintubation" value="{{ old('postintubation', $intubation->post_intubation ?? '') }}" {{ $intubation ? 'disabled' : '' }} rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('postintubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan post-intubation  ">{{ old('postintubation', $intubation->post_intubation ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('postintubation')" class="mt-2" />
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-6 mt-10 ">TTV Post Intubasi</h2>
                <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
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
					<div>
						<label for="post_consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
						<input type="text" name="post_consciousness" id="post_consciousness" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('post_consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" value="{{ old('post_consciousness', $intubation->ttv->post_consciousness ?? '') }}" placeholder="">
						<x-input-error :messages="$errors->get('post_consciousness')" class="mt-2" />
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
                                class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('venti_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                                value="{{ old('venti_datetime') }}"> <x-input-error :messages="$errors->get('venti_datetime')" class="mt-2" />
                        </div>
                        <div>
                            <label for="mode_venti" class="block text-md font-medium text-txtl">Mode Venti</label>
                            <input 
                                type="text" 
                                name="mode_venti" 
                                id="mode_venti" 
                                class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('mode_venti') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" 
                                placeholder="Masukan Mode Venti"
                                value="{{ old('mode_venti') }}"> <x-input-error :messages="$errors->get('mode_venti')" class="mt-2" />
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
                                    value="{{ old('ipl') }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
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
                                    value="{{ old('peep') }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH₂O</span>
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
                                    value="{{ old('fio2') }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
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
                                    value="{{ old('rr') }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
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
                                    value="{{ old('ps') }}"> <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cmH2O</span>
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
                                    value="{{ old('trigger') }}"> <x-input-error :messages="$errors->get('trigger')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-16">
                    <a href="{{ url()->previous() }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Kembali
                    </a>
                    <button 
                        type="button" 
                        id="openModalButton" 
                        class="inline-flex items-center px-4 py-2 bg-btn text-white font-semibold rounded-md shadow-sm hover:bg-btnh focus:outline-none focus:ring-2 focus:ring-btn focus:ring-offset-2">
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
        

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
</script>
@endpush
@endsection