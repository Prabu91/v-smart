@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 pl-8">Form Observasi Pasien ICU/PICU</h1>

    <!-- Slide Container -->
    <div class="relative w-full ">
        <form id="observasiForm" action="/observation" method="POST" class="space-y-6">
            @csrf
            <!-- Slide 1: Data Asal Ruangan -->
            <div id="slide1" class="form-slide">
                <input type="hidden" name="room_type_origin" value="origin">
                <div class="bg-white p-8 rounded-xl">
                    <h2 class="text-xl font-bold mb-4">Data Asal Ruangan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="origin_room_date" class="block text-md font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="origin_room_date" id="origin_room_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            
                        </div>
                        <div>
                            <label for="origin_room_name" class="block text-md font-medium text-gray-700">Nama Ruangan</label>
                            <input type="text" name="origin_room_name" id="origin_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Ruangan">
                        </div>
                        <div>
                            <label for="patient_name" class="block text-md font-medium text-gray-700">Nama Pasien</label>
                            <input type="text" name="patient_name" id="patient_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Pasien">
                        </div>
                        <div>
                            <label for="no_cm" class="block text-md font-medium text-gray-700">No Catatan Medis</label>
                            <input type="text" name="no_cm" id="no_cm" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan No Catatan Medis">
                        </div>
                    </div>
                    <h2 class="text-xl font-bold my-4">Hasil Lab</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    </div>
                    <h2 class="text-xl font-bold my-4">AGD</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    </div>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="radiology" class="block text-md font-medium text-gray-700">Radiologi</label>
                            <input type="text" name="radiology" id="radiology" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil Radiologi">
                        </div>
                        <div>
                            <label for="ro_thorax" class="block text-md font-medium text-gray-700">RO Thorax</label>
                            <input type="text" name="ro_thorax" id="ro_thorax" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hasil RO Thorax">
                        </div>
                    </div>
                </div>
                <div class="mt-10 bg-white p-8 rounded-xl">
                    <h2 class="text-xl font-bold mb-4">Intubasi</h2>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="dr_intubation_name" class="block text-md font-medium text-gray-700">Nama Dokter yang Intubasi</label>
                            <input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter">
                        </div>
                        <div>
                            <label for="dr_consultant_name" class="block text-md font-medium text-gray-700">Nama Dokter Konsulan</label>
                            <input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter Konsultan">
                        </div>
                    </div>
                    
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="dr_intubation_name" class="block text-md font-medium text-gray-700">Nama Dokter yang Intubasi</label>
                            <input type="text" name="dr_intubation_name" id="dr_intubation_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter">
                        </div>
                        <div>
                            <label for="dr_consultant_name" class="block text-md font-medium text-gray-700">Nama Dokter Konsulan</label>
                            <input type="text" name="dr_consultant_name" id="dr_consultant_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Dokter Konsultan">
                        </div>
                    </div>

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
                </div>
                <!-- Button Next -->
                <button type="button" id="next1" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Next</button>
            </div>

            <!-- Slide 2: Data Asal Ruangan -->
            <div id="slide2" class="form-slide hidden">
                <input type="hidden" name="room_type_icu" value="icu">
                <div class="bg-white p-8 rounded-xl">
                    <h2 class="text-xl font-bold mb-4">Data Ruangan ICU/PICU</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="icu_room_date" class="block text-md font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" name="icu_room_date" id="icu_room_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            
                        </div>
                        <div>
                            <label for="icu_room_name" class="block text-md font-medium text-gray-700">Nama Ruangan</label>
                            <input type="text" name="icu_room_name" id="icu_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Ruangan">
                        </div>
                    </div>
                    <h2 class="text-xl font-bold my-4">Hasil Lab</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    </div>
                    <h2 class="text-xl font-bold my-4">AGD</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                <!-- Card untuk Venti dan TTV -->
                <div id="venti-ttv-card-container">
                    <div class="venti-ttv-card bg-white p-8 rounded-xl mb-6">
                        <!-- Mode Venti -->
                        <div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="therapy" class="block text-md font-medium text-gray-700">Therapy</label>
                                <input type="text" name="therapy_icu" id="therapy" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Change Day">
                            </div>
                            <div>
                                <label for="mode_venti" class="block text-md font-medium text-gray-700">Mode Venti</label>
                                <input type="text" name="ventilators[][mode_venti]" id="mode_venti" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Mode Venti">
                            </div>
                            <div>
                                <label for="ett_kedalaman" class="block text-md font-medium text-gray-700">ETT/Kedalaman</label>
                                <input type="text" name="ventilators[][ett_kedalaman]" id="ett_kedalaman" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan ETT/Kedalaman">
                            </div>
                        </div>
                        <div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="ipl" class="block text-md font-medium text-gray-700">IPL</label>
                                <div class="relative">
                                    <input type="text" name="ventilators[][ipl]" id="ipl" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="12">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
                                </div>
                            </div>
                            <div>
                                <label for="peep" class="block text-md font-medium text-gray-700">PEEP</label>
                                <div class="relative">
                                    <input type="text" name="ventilators[][peep]" id="peep" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="4">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
                                </div>                            </div>
                            <div>
                                <label for="fio2" class="block text-md font-medium text-gray-700">FiO₂</label>
                                <div class="relative">
                                    <input type="text" name="ventilators[][fio2]" id="fio2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="35">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                                </div>                             
                            </div>
                            <div>
                                <label for="rr" class="block text-md font-medium text-gray-700">RR</label>
                                <div class="relative">
                                    <input type="text" name="ventilators[][rr]" id="rr" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="15">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                                </div> 
                            </div>
                        </div>

                        <!-- TTV -->
                        <h2 class="text-xl font-bold mb-4">TTV</h2>
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
                </div>
                <!-- Button untuk menambah data Venti -->
                <div class="flex justify-end mt-4">
                    <button type="button" id="addVentiBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Data Venti
                    </button>
                </div>

                <div class="my-10 bg-white p-8 rounded-xl mb-6">
                    <h2 class="text-xl font-bold mb-4">Data Persiapan Extubasi</h2>
                    <div class="bg-white p-8 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="excubation_date" class="block text-sm font-medium text-gray-700">Tanggal Extubasi</label>
                                <input type="date" name="excubation_date" id="excubation_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="preparation_extubation_therapy" class="block text-sm font-medium text-gray-700">Therapi Persiapan Ekstubasi</label>
                                <input type="text" name="preparation_extubation_therapy" id="preparation_extubation_therapy" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Dexamethasone, Nebu Adrenaline">
                            </div>
                            <div>
                                <label for="excubation" class="block text-sm font-medium text-gray-700">Tindakan Ekstubasi</label>
                                <input type="text" name="excubation" id="excubation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Sukses, Tanpa Komplikasi">
                            </div>
                        </div>
                        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nebu_adrenalin" class="block text-sm font-medium text-gray-700">Nebu Adrenalin</label>
                                <div class="relative">
                                    <input type="text" name="nebu_adrenalin" id="nebu_adrenalin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="2">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mL</span>
                                </div>
                            </div>
                            <div>
                                <label for="dexamethasone" class="block text-sm font-medium text-gray-700">Dexamethasone</label>
                                <div class="relative">
                                    <input type="text" name="dexamethasone" id="dexamethasone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="5">
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">mg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Next -->
                <div class="flex justify-between mt-4">
                    <button type="button" id="prev2" class="bg-gray-500 text-white px-4 py-2 rounded-md">Previous</button>
                    <button type="button" id="next2" class="bg-blue-500 text-white px-4 py-2 rounded-md">Next</button>
                </div>
            </div>
            

            <!-- Slide 3: Data Pindah ke Ruangan -->
            <div id="slide3" class="form-slide hidden"> 
                <input type="hidden" name="room_type_transfer" value="transfer">
                <div class="bg-white p-8 rounded-xl">
                    <h2 class="text-xl font-bold mb-4">Data Pindah Ruangan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="transfer_room_date" class="block text-md font-medium text-gray-700">Tanggal Keluar</label>
                            <input type="date" name="transfer_room_date" id="transfer_room_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="transfer_room_name" class="block text-md font-medium text-gray-700">Nama Ruangan</label>
                            <input type="text" name="transfer_room_name" id="transfer_room_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Nama Ruangan">
                        </div>
                    </div>
                    <h2 class="text-xl font-bold my-4">Hasil Lab</h2>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="hb_transfer_room" class="block text-md font-medium text-gray-700">Hb</label>
                            <input type="text" name="hb_transfer_room" id="hb_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Hb">
                        </div>
                        <div>
                            <label for="leukosit_transfer_room" class="block text-md font-medium text-gray-700">Leukosit</label>
                            <input type="text" name="leukosit_transfer_room" id="leukosit_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Leukosit">
                        </div>
                        <div>
                            <label for="pcv_transfer_room" class="block text-md font-medium text-gray-700">PCV</label>
                            <input type="text" name="pcv_transfer_room" id="pcv_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan PCV">
                        </div>
                        <div>
                            <label for="trobosit_transfer_room" class="block text-md font-medium text-gray-700">Trombosit</label>
                            <input type="text" name="trobosit_transfer_room" id="trobosit_transfer_room" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Trombosit">
                        </div>
                        {{-- <div>
                            <label for="no_cm" class="block text-md font-medium text-gray-700">Hasil Lab Kultur</label>
                            <input type="text" name="no_cm" id="no_cm" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Trombosit">
                        </div> --}}
                    </div>

                    <!-- TTV -->
                    <h2 class="text-xl font-bold my-4">TTV</h2>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="transfer_room_td" class="block text-md font-medium text-gray-700">TD</label>
                            <input type="text" name="transfer_room_td" id="transfer_room_td" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan TD">
                        </div>
                        <div>
                            <label for="transfer_room_saturasi" class="block text-md font-medium text-gray-700">S.</label>
                            <input type="text" name="transfer_room_saturasi" id="transfer_room_saturasi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan S.">
                        </div>
                        <div>
                            <label for="transfer_room_nadi" class="block text-md font-medium text-gray-700">N.</label>
                            <input type="text" name="transfer_room_nadi" id="transfer_room_nadi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan N.">
                        </div>
                        <div>
                            <label for="transfer_room_rr" class="block text-md font-medium text-gray-700">RR</label>
                            <input type="text" name="transfer_room_rr" id="transfer_room_rr" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan RR">
                        </div>
                        <div>
                            <label for="transfer_room_spo2" class="block text-md font-medium text-gray-700">SPO2</label>
                            <input type="text" name="transfer_room_spo2" id="transfer_room_spo2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan SPO2">
                        </div>
                    </div>
                    
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button type="button" id="prev3" class="bg-gray-500 text-white px-4 py-2 rounded-md">Previous</button>
                    <button type="submit" id="next3" class="bg-green-500 text-white px-4 py-2 rounded-md">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script for Slide Navigation -->
@push('scripts')
<script>

$(document).ready(function() {
    let maxAdd = 2; // Maksimal penambahan 2 kali
    let count = 0; // Counter untuk jumlah elemen yang telah ditambahkan

    $('#addVentiBtn').on('click', function() {
        if (count < maxAdd) { // Cek apakah sudah mencapai batas maksimal
            let newCard = `
            <div id="venti-ttv-card-container">
                <div class="venti-ttv-card bg-white p-8 rounded-xl mb-6">
                    <div class="my-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="change_day_${count}" class="block text-md font-medium text-gray-700">Hari Ganti Mode</label>
                            <input type="text" name="change_day[${count}]" id="change_day_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="3">
                        </div>
                        <div>
                            <label for="mode_venti_${count}" class="block text-md font-medium text-gray-700">Mode Venti</label>
                            <input type="text" name="mode_venti[${count}]" id="mode_venti_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan Mode Venti">
                        </div>
                        <div>
                            <label for="ett_kedalaman_${count}" class="block text-md font-medium text-gray-700">ETT/Kedalaman</label>
                            <input type="text" name="ett_kedalaman[${count}]" id="ett_kedalaman_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Masukan ETT/Kedalaman">
                        </div>
                    </div>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="ipl_${count}" class="block text-md font-medium text-gray-700">IPL</label>
                            <div class="relative">
                                <input type="text" name="ipl[${count}]" id="ipl_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="12">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
                            </div>
                        </div>
                        <div>
                            <label for="peep_${count}" class="block text-md font-medium text-gray-700">PEEP</label>
                            <div class="relative">
                                <input type="text" name="peep[${count}]" id="peep_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="4">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">cm H₂O</span>
                            </div>
                        </div>
                        <div>
                            <label for="fio2_${count}" class="block text-md font-medium text-gray-700">FiO₂</label>
                            <div class="relative">
                                <input type="text" name="fio2[${count}]" id="fio2_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="35">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                            </div>                             
                        </div>
                        <div>
                            <label for="rr_${count}" class="block text-md font-medium text-gray-700">RR</label>
                            <div class="relative">
                                <input type="text" name="rr[${count}]" id="rr_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="15">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                            </div> 
                        </div>
                    </div>

                    <!-- TTV -->
                    <h2 class="text-xl font-bold mb-4">TTV</h2>
                    <div class="my-4 grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="td_${count}" class="block text-md font-medium text-gray-700">TD</label>
                            <input type="text" name="td[${count}]" id="td_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="110/70">
                        </div>
                        <div>
                            <label for="saturasi_${count}" class="block text-md font-medium text-gray-700">S.</label>
                            <div class="relative">
                                <input type="text" name="saturasi[${count}]" id="saturasi_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="38.5">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">°C</span>
                            </div> 
                        </div>
                        <div>
                            <label for="nadi_${count}" class="block text-md font-medium text-gray-700">N.</label>
                            <div class="relative">
                                <input type="text" name="nadi[${count}]" id="nadi_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="80">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">bpm</span>
                            </div> 
                        </div>
                        <div>
                            <label for="rr_ttv_${count}" class="block text-md font-medium text-gray-700">RR</label>
                            <div class="relative">
                                <input type="text" name="rr_ttv[${count}]" id="rr_ttv_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="18">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">kali per menit</span>
                            </div> 
                        </div>
                        <div>
                            <label for="spo2_${count}" class="block text-md font-medium text-gray-700">SpO<sub>2</sub></label>
                            <div class="relative">
                                <input type="text" name="spo2[${count}]" id="spo2_${count}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="95">
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-grey-500">%</span>
                            </div> 
                        </div>
                    </div>

                </div>
            </div>
            `;
            $('#venti-ttv-card-container').append(newCard); // Tambah elemen baru
            count++; // Tambah counter
        
            if (count >= maxAdd) { // Jika sudah mencapai batas maksimal
                $('#addVentiBtn').hide(); // Sembunyikan tombol tambah
            }
        }
    });
});



    document.getElementById('next1').addEventListener('click', function () {
        document.getElementById('slide1').classList.add('hidden');
        document.getElementById('slide2').classList.remove('hidden');
    });

    document.getElementById('next2').addEventListener('click', function () {
        document.getElementById('slide2').classList.add('hidden');
        document.getElementById('slide3').classList.remove('hidden');
    });

    document.getElementById('prev2').addEventListener('click', function () {
        document.getElementById('slide2').classList.add('hidden');
        document.getElementById('slide1').classList.remove('hidden');
    });

    document.getElementById('prev3').addEventListener('click', function () {
        document.getElementById('slide3').classList.add('hidden');
        document.getElementById('slide2').classList.remove('hidden');
    });
    // Tombol submit untuk slide terakhir
    document.getElementById('next3').addEventListener('click', function () {
        document.getElementById('observasiForm').submit(); // Submit form setelah slide 4
    });

    
</script>
@endpush


@endsection

