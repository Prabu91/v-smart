@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
@php
	use Carbon\Carbon;
@endphp

<nav class="flex" aria-label="Breadcrumb">
	<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
		<li class="inline-flex items-center">
		<a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-grey-900 dark:text-gray-400 dark:hover:text-slate-900">
			<svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
			<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
			</svg>
			Home
		</a>
		</li>
		<li aria-current="page">
		<div class="flex items-center">
			<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
			</svg>
			<span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-grey-900">Detail Data Pasien</span>
		</div>
		</li>
	</ol>
</nav>

<div class="container mx-auto p-4 sm:p-6">
    <h1 class="text-3xl text-center font-bold mb-10">Detail Data Pasien ICU</h1>

    {{-- Data Pasien --}}
    <div class="bg-white shadow-md rounded-lg p-6 my-4">
        <!-- Button Section -->
        @if (($extubation && $extubation->patient_status === 'Meninggal') || ($extubation && $extubation->patient_status !== 'Meninggal' && $transfer))
            <div class="flex justify-end mb-4">
                <a href="{{ route('patients.export-pdf', $patient->id) }}" 
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition">
                    Download PDF
                </a>
            </div>
        @endif
    
        <!-- Patient Section -->
        <div class="relative w-full">
    
			@php
				$canEdit = $patient->created_at->diffInHours(now()) < 24;
			@endphp

			@if($canEdit)
				<a href="{{ route('patients.edit', $patient->id) }}" class="absolute top-4 right-4 bg-btn hover:bg-btnh text-white font-semibold py-2 px-4 rounded-md shadow-sm">
					Edit
				</a>
			@else
				<a href="#" class="absolute top-4 right-4 bg-gray-400 text-white font-semibold py-2 px-4 rounded-md shadow-sm cursor-not-allowed">
					Edit
				</a>
			@endif

			{{-- <h1 class="text-3xl text-center font-bold mb-4">Data Pasien</h1> --}}
			
			<div class="overflow-x-auto">
				<table class="w-1/2 text-left">
					<tbody>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">Nama Pasien</td>
							<td class="p-2">{{ $patient->name }}</td>
						</tr>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">Tanggal Lahir</td>
							<td class="p-2">{{ Carbon::parse($patient->tanggal_lahir)->format('d-m-Y') }}</td>
						</tr>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">Jenis Kelamin</td>
							<td class="p-2">{{ $patient->gender }}</td>
						</tr>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">Nomor SEP</td>
							<td class="p-2">{{ $patient->no_sep ?? '-' }}</td>
						</tr>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">No Kartu JKN</td>
							<td class="p-2">{{ $patient->no_jkn }}</td>
						</tr>
						<tr>
							<td class="font-semibold bg-gray-300 p-2">No Rekam Medis</td>
							<td class="p-2">{{ $patient->no_rm }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>

    {{-- OriginRoom --}}
    <div class="bg-white shadow-md rounded-lg p-6 my-4">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Data Awal Pasien</h2>

				@if(!$origin)
					<a href="{{ route('origin-rooms.create') }}?patient_id={{ $patient->id }}" 
						class="bg-btn hover:bg-btnh text-white font-bold py-2 px-4 rounded">
						Tambah Data
					</a>
				@else
				@php
					$canEdit = $origin->created_at->diffInHours(now()) < 24;
				@endphp
					@if($canEdit)
						<a href="{{ route('origin-rooms.edit', $origin->id) }}" 
							class="bg-btn hover:bg-btnh text-white font-bold py-2 px-4 rounded">
							Edit Data Awal
						</a>
					@else
						<a href="#" class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed">
							Edit Data Awal
						</a>
					@endif
				@endif
        </div>

        @if ($origin)
            <div class="overflow-x-auto">
                <table class="w-1/4 text-left mb-4">
                    <tbody>
                        <tr>
                            <td>Nama Ruangan Asal</td>
                            <td class="px-4">:</td>
                            <td>{{ $origin->origin_room_name ?? 'Tidak ada data' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-2xl font-bold mb-4">Hasil Lab Awal</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left mb-4">
                            <tbody>
                                <tr>
                                    <td>Pemeriksaan Fisik</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->physical_check ?? 'Tidak ada data' }}</td>
                                </tr>
                                <tr>
                                    <td>Hb</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->labResult->hb ?? '0', 1) }} g/dL</td>
                                </tr>
                                <tr>
                                    <td>Leukosit</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->labResult->leukosit ?? '0', 1) }} /µL</td>
                                </tr>
                                <tr>
                                    <td>PCV</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->labResult->pcv ?? '0', 1) }} %</td>
                                </tr>
                                <tr>
                                    <td>Trombosit</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->labResult->trombosit ?? '0'}} /µL</td>
                                </tr>
                                <tr>
                                    <td>Kreatinin</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->labResult->kreatinin ?? '0', 1) }} mg/dL</td>
                                </tr>
                                <tr>
                                    <td>Natrium</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->natrium ?? '0', 1) }} mmol/L</td>
                                </tr>
                                <tr>
                                    <td>Kalium</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->kalium ?? '0', 1) }} mmol/L</td>
                                </tr>
                                <tr>
                                    <td>GDS</td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->gds ?? '0', 1) }} mg/dL</td>
                                </tr>
                                <tr>
                                    <td>Radiologi</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->radiology ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td>Penunjang Lain</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->additional_check ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td>Score EWS</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->ews ?? '0'}}</td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Utama</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->main_diagnose ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Sekunder</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->secondary_diagnose ?? '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Analisis Gas Darah</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <tbody>
                                <tr>
                                    <td>pH</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->agd->ph ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <td>pCO<sub>2</sub></td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->agd->pco2 ?? '0', 1) }} mmHg</td>
                                </tr>
                                <tr>
                                    <td>pO<sub>2</sub></td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->agd->po2 ?? '0', 1) }} mmHg</td>
                                </tr>
                                <tr>
                                    <td>SpO<sub>2</sub></td>
                                    <td class="px-4">:</td>
                                    <td>{{ number_format($origin->agd->spo2 ?? '0', 1) }} %</td>
                                </tr>
                                <tr>
                                    <td>Base Excees</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->agd->base_excees ?? '0' }} %</td>
                                </tr>
                                <tr>
                                    <td>P/F Ratio</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->agd->pf_ratio ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <td>HCO3</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->agd->hco3 ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <td>TCO2</td>
                                    <td class="px-4">:</td>
                                    <td>{{ $origin->agd->tco2 ?? '0' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <p class="text-gray-600">Tidak Ada Data</p>
        @endif
    </div>

	@if ($origin)
		<div class="bg-white shadow-xl rounded-lg p-6 my-4">
			<div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
				<h2 class="text-3xl font-bold mb-4 md:mb-0">Data Ruang Intensif</h2>
				<!-- Container for Buttons -->
				<div class="flex flex-wrap gap-2">

					@if ($origin)
						@if (!$icu && !$intubations)
							<a href="{{ route('intubations.create') }}?patient_id={{ $patient->id }}" 
								class="bg-yellow-500 hover:bg-yellow-700 text-txtd font-bold py-2 px-4 rounded text-center">
								Tambah Data Intubasi
							</a>
						{{-- @elseif ($intubations) --}}
						@elseif (!$extubation || $intubations)
						@php
							$canEdit = $intubations->created_at->diffInHours(now()) < 24;
						@endphp
							@if($canEdit)
								<a href="{{ route('intubations.edit', $intubations->id) }}"
									class="bg-btn hover:bg-btnh text-txtd font-bold py-2 px-4 rounded text-center">
									Edit Data Intubasi
								</a>
							@else
								{{-- Tombol dinonaktifkan secara visual --}}
								<a href="#" class="bg-gray-400 text-txtd font-bold py-2 px-4 rounded text-center cursor-not-allowed">
									Edit Data Intubasi
								</a>
							@endif
						@endif
					@endif
			
					@if ($icu && !$extubation && $ventiReleaseButton === false)
						<a href="{{ route('extubations.create') }}?patient_id={{ $patient->id }}" 
							class="bg-green-500 hover:bg-green-600 text-txtd font-bold py-2 px-4 rounded text-center">
							Tambah Data Extubasi
						</a>
					@endif
				</div>
			</div>
			

			{{-- INTUBATION --}}
			@if ($intubations)
			<div class="p-6 my-4">
				<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
					<div>
						<h2 class="text-2xl font-bold mb-4">
							Intubasi | Ruangan: {{ $intubations->intubation_location }}
						</h2>
						<div class="grid grid-cols-1 gap-4">
							<div>
								<table class="table-auto w-full">
									<tr>
										<td>Waktu Intubasi</td>
										<td class="px-2">:</td>
										<td>{{ Carbon::parse($intubations->intubation_datetime)->format('H:i d/m/Y') }}</td>
									</tr>
									<tr>
										<td>Dokter Intubasi</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->dr_intubation ?? 'Tidak ada data' }}</td>
									</tr>
									<tr>
										<td>Dokter Konsulan</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->dr_consultant ?? 'Tidak ada data' }}</td>
									</tr>
								
									<tr>
										<td>Pre Intubasi</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->pre_intubation ?? 'Tidak ada data' }}</td>
									</tr>
									<tr>
										<td>Post Intubasi</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->post_intubation ?? 'Tidak ada data' }}</td>
									</tr>
									<tr>
										<td>Tipe Intubasi</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->intubation_type ?? 'Tidak ada data' }}</td>
									</tr>
									@if($intubations->intubation_type == 'ETT')
									<tr>
										<td>ETT Diameter / Kedalaman</td>
										<td class="px-2">:</td>
										<td>
											{{ $intubations && $intubations->ett_diameter && $intubations->ett_depth ? $intubations->ett_diameter . ' mm / ' . $intubations->ett_depth . ' cm' : '0 mm / 0 cm' }}
										</td>
									</tr>
									@else
									<tr>
										<td>TC Diameter / Tipe </td>
										<td class="px-2">:</td>
										<td>
											{{ $intubations && $intubations->tc_diameter && $intubations->tc_type ? $intubations->tc_diameter . ' mm / ' . $intubations->tc_type . '' : '0 mm / ' }}
										</td>
									</tr>
									@endif
								</table>
							</div>
						</div>
					</div>

					{{-- Pre Int TTV --}}
					<div>
						<h2 class="text-xl font-bold mb-4">TTV Pre Intubasi</h2>
						<table class="table-auto w-full">
							<tr>
								<td>TD</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations && $intubations->ttvPre && $intubations->ttvPre->sistolik && $intubations->ttvPre->diastolik ? $intubations->ttvPre->sistolik . ' / ' . $intubations->ttvPre->diastolik : '0' }}
								</td>
							</tr>
							<tr>
								<td>Suhu</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->suhu ?? '0'}} °C
								</td>
							</tr>
							<tr>
								<td>Nadi</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->nadi ?? '0'}} bpm
								</td>
							</tr>
							<tr>
								<td>RR</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->rr ?? '0' }} kali per menit
								</td>
							</tr>
							<tr>
								<td>SpO<sub>2</sub></td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->spo2 ?? '0'}} %
								</td>
							</tr>
							<tr>
								<td>Kesadaran</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->consciousness ?? '0'}}
								</td>
							</tr>
						</table>
					</div>

					{{-- Post Int TTV --}}
					<div>
						<h2 class="text-xl font-bold mb-4">TTV Post Intubasi</h2>
						<table class="table-auto w-full">
							<tr>
								<td>TD</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations && $intubations->ttvPost && $intubations->ttvPost->sistolik && $intubations->ttvPost->diastolik ? $intubations->ttvPost->sistolik . ' / ' . $intubations->ttvPost->diastolik : '0' }}
								</td>
							</tr>
							<tr>
								<td>Suhu</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPost->suhu ?? '0'}} °C
								</td>
							</tr>
							<tr>
								<td>Nadi</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPost->nadi ?? '0'}} bpm
								</td>
							</tr>
							<tr>
								<td>RR</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPost->rr ?? '0' }} kali per menit
								</td>
							</tr>
							<tr>
								<td>SpO<sub>2</sub></td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPost->spo2 ?? '0'}} %
								</td>
							</tr>
							<tr>
								<td>Kesadaran</td>
								<td class="px-2">:</td>
								<td>
									{{ $intubations->ttvPre->consciousness ?? '0'}}
								</td>
							</tr>
						</table>
					</div>

				</div>

				{{-- Cek Extubation --}}
				@if ($intubations->extubation)
				<p class="mt-4">Waktu Extubasi: 
					{{ Carbon::parse($intubations->intubation_datetime)->diffForHumans(Carbon::parse($intubations->extubation->extubation_datetime), true) }}
				</p>
				@endif
			</div>
			@endif
		</div>
	@endif

			
	{{-- Data Intensif --}}
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="relative pb-4 flex justify-end">
			@if ($origin)
				@if (!$extubation || $intubations)
					<a href="{{ route('icu-rooms.create') }}?patient_id={{ $patient->id }}" 
						class="bg-btn hover:bg-btnh text-txtd font-bold py-2 px-4 rounded text-center">
						Tambah Data Ruang Intensif
					</a>
				@endif
			@endif
		</div>
		<div class="overflow-x-auto">
			<table id="icu-table" class="table-auto w-full text-left">
				<thead class="bg-gray-200">
					<tr>
						<th class="px-4 py-2">No</th>
						<th class="px-4 py-2">Tanggal dan Waktu Periksa</th>
						<th class="px-4 py-2">Ruangan/Bed</th>
						<th class="px-4 py-2">Action</th>
					</tr>
				</thead>
			</table>
		</div>

		<h2 class="text-2xl font-bold my-10">Data Ventilator</h2>
		<div class="overflow-x-auto">
			<table id="venti-table" class="table-auto w-full text-left">
				<thead class="bg-gray-200">
					<tr>
						<th class="px-4 py-2">No</th>
						<th class="px-4 py-2">Tanggal dan Waktu Mulai</th>
						<th class="px-4 py-2">Mode Ventilator</th>
						<th class="px-4 py-2">Durasi Penggunaan Venti</th>
						<th class="px-4 py-2">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	{{-- End Data Intensif --}}

	{{-- EXTUBATION --}}
	@if ($extubation)
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="relative pb-4 flex justify-between">
			<h2 class="text-2xl font-bold">Extubasi Pasien</h2>
			@php
				$canEdit = $extubation->created_at->diffInHours(now()) < 24;
			@endphp
			@if ($extubation)
				@if($canEdit)
					<a href="{{ route('extubations.edit', $extubation->id) }}"
						class="bg-btn hover:bg-btnh text-txtd font-bold py-2 px-4 rounded text-center">
						Edit Data Extubasi
					</a>
				@else
					{{-- Tombol dinonaktifkan secara visual --}}
					<a href="#" class="bg-gray-400 text-txtd font-bold py-2 px-4 rounded text-center cursor-not-allowed">
						Edit Data Extubasi
					</a>
				@endif
			@endif
		</div>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<div>
				<table class="my-4 w-full">
					<tr>
						<td class="font-semibold">Tanggal dan Waktu Extubasi</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->extubation_datetime)
								{{ Carbon::parse($extubation->extubation_datetime)->format('H:i d/m/Y') }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Kondisi Pasien</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->patient_status)
								{{ $extubation->patient_status }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Therapi Persiapan Ekstubasi</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->preparation_extubation_therapy)
								{{ $extubation->preparation_extubation_therapy }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Tindakan Ekstubasi</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->extubation)
								{{ $extubation->extubation }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Nebulizer</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->nebulizer)
								{{ $extubation->nebulizer }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Keterangan Tambahan</td>
						<td class="px-4">:</td>
						<td>
							@if($extubation && $extubation->extubation_notes)
								{{ $extubation->extubation_notes }}
							@else
								Tidak ada data
							@endif
						</td>
					</tr>
				</table>
			</div>

			@if($extubation->ttv)
			<div>
				<h2 class="text-xl font-bold mb-4">TTV</h2>
				<table class="w-full">
					<tr>
						<td class="font-semibold">TD</td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation && $extubation->ttv->sistolik && $extubation->ttv->diastolik ? $extubation->ttv->sistolik . ' / ' . $extubation->ttv->diastolik : '0' }}
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Suhu</td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation->ttv->suhu ?? '0'}} °C
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Nadi</td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation->ttv->nadi ?? '0'}} bpm
						</td>
					</tr>
					<tr>
						<td class="font-semibold">RR</td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation->ttv->rr ?? '0' }} kali per menit
						</td>
					</tr>
					<tr>
						<td class="font-semibold">SpO<sub>2</sub></td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation->ttv->spo2 ?? '0'}} %
						</td>
					</tr>
					<tr>
						<td class="font-semibold">Kesadaran</td>
						<td class="px-2">:</td>
						<td>
							{{ $extubation->ttv->consciousness ?? 'Tidak Ada Data'}}
						</td>
					</tr>
				</table>
			</div>
			@endif
		</div>
	</div>
	@endif


	@if ($extubation)
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
			<h2 class="text-2xl text-left font-bold mb-4 md:mb-0">Pindah Ruangan Pasien</h2>

			@if ($extubation->patient_status === 'Tidak Meninggal' && !$transfer)
				<a href="{{ route('transfer-rooms.create') }}?patient_id={{ $patient->id }}" 
				class="bg-btn hover:bg-btnh text-txtd font-bold py-2 px-4 rounded">
					Tambah Data Pindah Ruangan
				</a>
			@elseif ($transfer)
			@php
				$canEdit = $transfer->created_at->diffInHours(now()) < 24;
			@endphp
				@if($canEdit)
					<a href="{{ route('transfer-rooms.edit', $transfer->id) }}"
						class="bg-btn hover:bg-btnh text-txtd font-bold py-2 px-4 rounded text-center">
						Edit Data Pindah Ruangan
					</a>
				@else
					{{-- Tombol dinonaktifkan secara visual --}}
					<a href="#" class="bg-gray-400 text-txtd font-bold py-2 px-4 rounded text-center cursor-not-allowed">
						Edit Data Pindah Ruangan
					</a>
				@endif
			@endif
		</div>

		@if ($transfer)
		<div class="overflow-x-auto">
			<table class="table-auto w-1/2 mb-4">
				<tbody>
					<tr>
						<td class="font-semibold">Waktu dan Tanggal Pindah Ruangan</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->transfer_room_datetime ? Carbon::parse($transfer->transfer_room_datetime)->format('H:i d/m/Y') : 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td class="font-semibold">Nama Ruangan</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->transfer_room_name ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td class="font-semibold">Diagnosa Utama</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->main_diagnose ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td class="font-semibold">Diagnosa Sekunder</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->secondary_diagnose ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td class="font-semibold">Hasil Lab Kultur</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->lab_culture_data ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td class="font-semibold">Keterangan Tambahan</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->notes ?? 'Tidak ada data' }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<div>
				<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
				<div class="overflow-x-auto">
					<table class="table-auto w-full">
						<tbody>
							<tr>
								<td class="font-semibold">Hb</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->hb ?? 'Tidak ada data' }} g/dL</td>
							</tr>
							<tr>
								<td class="font-semibold">Leukosit</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->leukosit ?? 'Tidak ada data' }} /µL</td>
							</tr>
							<tr>
								<td class="font-semibold">PCV</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->pcv ?? 'Tidak ada data' }} %</td>
							</tr>
							<tr>
								<td class="font-semibold">Trombosit</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->trombosit ?? 'Tidak ada data' }} /µL</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div>
				<h2 class="text-xl font-bold my-4">TTV</h2>
				<div class="overflow-x-auto">
					<table class="table-auto w-full">
						<tbody>
							<tr>
								<td class="font-semibold">TD</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->sistolik ?? '-' }} / {{ $transfer->ttv->diastolik ?? '-' }}</td>
							</tr>
							<tr>
								<td class="font-semibold">Suhu</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->suhu ?? 'Tidak ada data' }} °C</td>
							</tr>
							<tr>
								<td class="font-semibold">Nadi</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->nadi ?? 'Tidak ada data' }} bpm</td>
							</tr>
							<tr>
								<td class="font-semibold">RR</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->rr ?? 'Tidak ada data' }} kali per menit</td>
							</tr>
							<tr>
								<td class="font-semibold">SpO<sub>2</sub></td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->spo2 ?? 'Tidak ada data' }} %</td>
							</tr>
							<tr>
								<td class="font-semibold">Kesadaran</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->ttv->consciousness ?? 'Tidak ada data' }} </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@else
		<p class="text-center text-gray-500">Tidak Ada Data</p>
		@endif
	</div>
	@endif

	<div class="flex justify-between items-center mt-12">
		<a href="{{ url()->previous() }}" 
		class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
			Kembali
		</a>
	</div>

	<!-- Modal -->
	<div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
		<div class="bg-white rounded-lg shadow-lg p-6">
			<h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
			<p>Apakah Anda yakin ingin menyimpan data <span class="font-bold">Lepas Venti?</span></p>
			<div class="flex justify-end mt-4">
				<button id="cancelButton" class="mr-2 px-4 py-2 bg-btn hover:bg-btnh text-txtd rounded-md">Batal</button>
				<button id="confirmButton" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md">Ya, Lepas</button>
			</div>
		</div>
	</div>

</div>

{{-- SWAL --}}
@if (session('success'))
<script>
	Swal.fire({
		toast: true,
		position: 'top-end',
		icon: 'success',
		title: '{{ session('success') }}',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
	});
</script>
@endif

@if (session('error'))
<script>
	Swal.fire({
		toast: true,
		position: 'top-end',
		icon: 'error',
		title: '{{ session('error') }}',
		showConfirmButton: true,
		timer: 5000,
		timerProgressBar: true,
	});
</script>
@endif

<!-- Tambahkan script untuk DataTables -->
@push('scripts')
<script>
    $(document).ready(function() {
		$('#icu-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
					url: '{{ route('patients.show', ['patient' => $patient->id]) }}',
					data: { type: 'icu' }
				},
			columns: [
				{ data: 'id', name: 'id', className: 'text-center', render: function (data, type, row, meta) {
					return meta.row + 1;
				}},
				{ data: 'icu_room_datetime', name: 'icu_room_datetime', className: 'text-center'},
				{ data: 'icu_room_name', name: 'icu_room_name', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'action', name: 'action', orderable: false, searchable: false}
			],
			language: {
				emptyTable: "Belum Ada Data",
			},
		});

		$('#venti-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
						url: '{{ route('patients.show', ['patient' => $patient->id]) }}',
						data: { type: 'venti' }
					},
			columns: [
				{ data: 'id', name: 'id', className: 'text-center', render: function (data, type, row, meta) {
					return meta.row + 1;
				}},
				{ data: 'venti_datetime', name: 'venti_datetime', className: 'text-center'},
				{ data: 'mode_venti', name: 'icu_room_name', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'venti_duration', name: 'venti_duration', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'action', name: 'action', orderable: false, searchable: false}
			],
			language: {
				emptyTable: "Belum Ada Data",
			},
		});

		// Event Listener for "Lepas Venti" Button
        $(document).ready(function () {
			$(document).on('click', '.release-venti', function (e) {
				e.preventDefault(); // Mencegah reload halaman

				const ventiId = $(this).data('id'); // Ambil ID dari atribut data-id
				$('#confirmationModal').removeClass('hidden').addClass('flex'); // Tampilkan modal

				// Konfirmasi aksi
				$('#confirmButton').off('click').on('click', function () {
					$.ajax({
						url: `/ventilators/${ventiId}/release`, // Endpoint backend
						type: 'POST',
						data: {
							_token: '{{ csrf_token() }}', // Sertakan CSRF token
						},
						success: function (response) {
							alert(response.message); // Tampilkan pesan sukses
							location.reload(); // Reload halaman untuk update data
						},
						error: function (xhr) {
							alert(xhr.responseJSON.message || 'Terjadi kesalahan.');
						}
					});

					$('#confirmationModal').removeClass('flex').addClass('hidden'); // Sembunyikan modal setelah konfirmasi
				});

				// Batalkan aksi
				$('#cancelButton').off('click').on('click', function () {
					$('#confirmationModal').removeClass('flex').addClass('hidden'); // Sembunyikan modal
				});
			});
		});

    });
</script>
@endpush

@endsection
