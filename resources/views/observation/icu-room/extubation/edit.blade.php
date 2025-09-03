@extends('layouts.app')

@section('title', 'extubasi')

@section('content')

<div class="container mx-auto p-6">
    
    <div class="relative w-full ">
        <!-- Form -->
        <form id="extubationForm" action="{{ route('extubations.update', $extubation->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            
            <div class="bg-white p-8 rounded-xl">
                <h2 class="text-3xl font-bold mb-8 text-center">Edit Data Extubasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="extubation_datetime" class="block text-md font-bold text-txtl">Tanggal dan Waktu Extubasi</label>
                        <input type="datetime-local" name="extubation_datetime" id="extubation_datetime" 
                                value="{{ old('extubation_datetime', \Carbon\Carbon::parse($extubation->extubation_datetime)->format('Y-m-d\TH:i')) }}"
                                class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('extubation_datetime') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
                        <x-input-error :messages="$errors->get('extubation_datetime')" class="mt-2" />
                    </div>              
                    <div>
                        <label for="patient_status" class="block text-md font-bold text-txtl">Kondisi Pasien</label>
                        <div class="relative">
                            <select name="patient_status" id="patient_status" 
                                    class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('patient_status') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
                                <option value="" disabled>Pilih Kondisi Pasien</option>
                                <option value="Meninggal" {{ old('patient_status', $extubation->patient_status) == 'Meninggal' ? 'selected' : '' }}>Pasien Meninggal</option>
                                <option value="Tidak Meninggal" {{ old('patient_status', $extubation->patient_status) == 'Tidak Meninggal' ? 'selected' : '' }}>Pasien Tidak Meninggal</option>
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('patient_status')" class="mt-2" />
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="extubation" class="block text-md font-bold text-txtl mt-4 mb-2">Tindakan Extubasi</label>
                        <textarea name="extubation" id="extubation" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('extubation') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan extubasi">{{ old('extubation', $extubation->extubation) }}</textarea>
                        <x-input-error :messages="$errors->get('extubation')" class="mt-2" />
                    </div>
                    <div>
                        <label for="nebulizer" class="block text-md font-bold text-txtl mt-4 mb-2">Nebulizer</label>
                        <x-input-error :messages="$errors->get('nebulizer')" class="mt-2" />
                        <textarea name="nebulizer" id="nebulizer" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('nebulizer') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Nebulizer">{{ old('nebulizer', $extubation->nebulizer) }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="preparation_extubation_therapy" class="block text-md font-bold text-txtl mt-4 mb-2">Therapy Persiapan Extubasi</label>
                        <x-input-error :messages="$errors->get('preparation_extubation_therapy')" class="mt-2" />
                        <textarea name="preparation_extubation_therapy" id="preparation_extubation_therapy" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('preparation_extubation_therapy') border-red-500 @else border-gray-300 @enderror" placeholder="Masukan Therapy Persiapan Extubasi">{{ old('preparation_extubation_therapy', $extubation->preparation_extubation_therapy) }}</textarea>
                    </div>
                    <div>
                        <label for="extubation_notes" class="block text-md font-bold text-txtl mt-4 mb-2">Notes</label>
                        <x-input-error :messages="$errors->get('extubation_notes')" class="mt-2" />
                        <textarea name="extubation_notes" id="extubation_notes" rows="8" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm resize-none @error('extubation_notes') border-red-500 @else border-gray-300 @enderror" placeholder="Keterangan Tambahan">{{ old('extubation_notes', $extubation->extubation_notes) }}</textarea>
                    </div>
                </div>
            
                {{-- TTV --}}
                <div id="ttv-section">
                    <h2 class="text-xl font-bold mb-6 mt-10 ">TTV</h2>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-6 gap-4">
                        <div>
                            <label for="td" class="block text-md font-bold text-txtl">TD</label>
                            <div class="flex space-x-2">
                                <input type="number" name="sistolik" id="sistolik" value="{{ old('sistolik', $ttv->sistolik ?? '') }}" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border rounded-md shadow-sm" placeholder="110" min="0">
                                <span class="flex items-center text-lg">/</span>
                                <input type="number" name="diastolik" id="diastolik" value="{{ old('diastolik', $ttv->diastolik ?? '') }}" class="text-black font-semibold mt-1 block w-1/2 px-3 py-2 border rounded-md shadow-sm" placeholder="70" min="0">
                            </div>
                        </div>
                        <div>
                            <label for="suhu" class="block text-md font-medium text-txtl">S.</label>
                            <div class="relative">
                                <input type="number" name="suhu" id="suhu" value="{{ old('suhu', $ttv->suhu ?? '') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="38.5">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
                            </div>
                        </div>
                        <div>
                            <label for="nadi" class="block text-md font-medium text-txtl">N.</label>
                            <div class="relative">
                                <input type="number" name="nadi" id="nadi" value="{{ old('nadi', $ttv->nadi ?? '') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="80">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
                            </div>
                        </div>
                        <div>
                            <label for="rr_ttv" class="block text-md font-medium text-txtl">RR</label>
                            <div class="relative">
                                <input type="number" name="rr_ttv" id="rr_ttv" value="{{ old('rr_ttv', $ttv->rr ?? '') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="18">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                            </div>
                        </div>
                        <div>
                            <label for="spo2" class="block text-md font-medium text-txtl">SpO<sub>2</sub></label>
                            <div class="relative">
                                <input type="number" name="spo2" id="spo2" value="{{ old('spo2', $ttv->spo2 ?? '') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border rounded-md shadow-sm" placeholder="95">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                            </div>
                        </div>
                        <div>
                            <label for="consciousness" class="block text-md font-medium text-txtl">Kesadaran</label>
                            <input type="text" name="consciousness" id="consciousness" value="{{ old('consciousness', $ttv->consciousness ?? '') }}" class="text-black font-semibold mt-1 block w-full px-3 py-2 border @error('consciousness') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm" placeholder="">
                            <x-input-error :messages="$errors->get('consciousness')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-16">
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
    document.addEventListener('DOMContentLoaded', function () {
        const selectPatientStatus = document.getElementById('patient_status');
        const ttvSection = document.getElementById('ttv-section');

        // Initial check on page load
        if (selectPatientStatus.value === 'Tidak Meninggal') {
            ttvSection.classList.remove('hidden');
        } else {
            ttvSection.classList.add('hidden');
        }

        selectPatientStatus.addEventListener('change', function () {
            if (this.value === 'Tidak Meninggal') {
                ttvSection.classList.remove('hidden'); 
            } else {
                ttvSection.classList.add('hidden'); 
            }
        });
    });

    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    });

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.add('hidden');
    });
    

    document.getElementById('confirmButton').addEventListener('click', function() {
        document.getElementById('extubationForm').submit(); 
    });
</script>
@endpush
@endsection
