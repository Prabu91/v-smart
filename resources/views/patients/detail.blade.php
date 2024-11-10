@extends('layouts.app')

@section('content')
@php
	use Carbon\Carbon;

@endphp

<div class="container mx-auto p-6">
	@if(session('success'))
	<div id="successMessage" class="bg-green-500 text-white p-4 rounded-md">
		{{ session('success') }}
	</div>
	@endif

    <h1 class="text-3xl text-center font-bold mb-10">Detail Data Pasien ICU</h1>
	
	{{-- Data Pasien --}}
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<h2 class="text-2xl text-left font-bold mb-6">Pasien ICU</h2>
		<table>
			<tr>
				<td>Nama Pasien</td>
				<td class="px-4">:</td>
				<td>{{ $patient->name }}</td>
			</tr>
			<tr>
				<td>No Kartu JKN</td>
				<td class="px-4">:</td>
				<td>{{ $patient->no_jkn }}</td>
			</tr>
		</table>
	</div>
	
	{{-- OriginRoom --}}
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="flex items-center justify-between mb-6">
			<h2 class="text-2xl font-bold">Asal Ruangan Pasien</h2>
			@if(!$origin)
				<a href="{{ route('origin-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right">
					Tambah Data
				</a>
			@endif

		</div>		
		@if ($origin)
			<table>
				<tr>
					<td>Waktu dan Tanggal Masuk Ruangan Asal</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->origin_room_datetime)
							{{ Carbon::parse($origin->origin_room_datetime)->format('H:i d/m/Y') }}
						@else
							Tidak ada data
						@endif
					</td>			
				</tr>
				<tr>
					<td>Nama Ruangan Asal</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->origin_room_name)
						{{ $origin->origin_room_name }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
			</table>
			<h2 class="text-xl font-bold my-4">Hasil Lab Awal</h2>
			<table>
				<tr>
					<td>Hb</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->labResult->hb)
						{{ $origin->labResult->hb }} g/dL
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Leukosit</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->labResult->leukosit)
						{{ $origin->labResult->leukosit }} /µL
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>PCV</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->labResult->pcv)
						{{ $origin->labResult->pcv }} %
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Trombosit</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->labResult->trombosit)
						{{ $origin->labResult->trombosit }} /µL
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Kreatinin</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->labResult->kreatinin)
						{{ $origin->labResult->kreatinin }} mg/dL
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
			</table>

			<h2 class="text-xl font-bold my-4">Analisis Gas Darah</h2>
			<table>
				<tr>
					<td>pH</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->agd->ph)
						{{ $origin->agd->ph }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>pCO<sub>2</sub></td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->agd->pco2)
						{{ $origin->agd->pco2 }} mmHg
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>pO<sub>2</sub></td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->agd->po2)
						{{ $origin->agd->po2 }} mmHg
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>SpO<sub>2</sub></td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->agd->spo2)
						{{ $origin->agd->spo2 }} %
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
			</table>

			<table class="my-4">
				<tr>
					<td>Radiologi (CT scan / MRI / USG)</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->radiology)
						{{ $origin->radiology }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>RO Thorax</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->ro_thorax)
						{{ $origin->ro_thorax }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Penunjang Lain</td>
					<td class="px-4">:</td>
					<td class="py-4  ">
						@if($origin && $origin->additional_check)
						{{ $origin->additional_check }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Diagnosa Utama</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->main_diagnose)
						{{ $origin->main_diagnose }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Diagnosa Sekunder</td>
					<td class="px-4">:</td>
					<td>
						@if($origin && $origin->secondary_diagnose)
						{{ $origin->secondary_diagnose }}
						@else
						Tidak ada data
						@endif
					</td>
				</tr>
			</table>
		@else
		<p>Tidak Ada Data</p>
		@endif

	</div>
	<div class="bg-white shadow-xl rounded-lg p-6 my-4">
		<div class="flex items-center justify-between mb-6">
			<h2 class="text-2xl font-bold mb-6">Pasien di Ruang Intensif</h2>
			{{-- Container for Buttons --}}
			<div class="flex space-x-4 ml-auto">
				{{-- button Intensif --}}
				@if(!$icu && $origin)
					<a href="{{ route('icu-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
						Tambah Data Ruang Intensif
					</a>
				@elseif(!$extubation && $icu)
					<a href="{{ route('extubations.create') }}?patient_id={{ $patient->id }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
						Tambah Data Extubasi
					</a>
					<a href="{{ route('intubation.create') }}?patient_id={{ $patient->id }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
						Tambah Data Intubasi
					</a>
				@endif
				{{-- End Button Intensif --}}
			</div>
		</div>
		

		{{-- Data Intensif --}}
		@if ($icu)
		<table>
			<tr>
				<td>Waktu dan Tanggal Masuk Ruangan Intensif</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->icu_room_datetime)
						{{ Carbon::parse($icu->icu_room_datetime)->format('H:i d/m/Y') }}
					@else
						Tidak ada data
					@endif
				</td>			
			</tr>
			<tr>
				<td>Nama Ruangan Intensif</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->icu_room_name)
					{{ $icu->icu_room_name }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>
		<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
		<table>
			<tr>
				<td>Hb</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->labResult->hb)
					{{ $icu->labResult->hb }} g/dL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Leukosit</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->labResult->leukosit)
					{{ $icu->labResult->leukosit }} /µL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>PCV</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->labResult->pcv)
					{{ $icu->labResult->pcv }} %
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Trombosit</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->labResult->trombosit)
					{{ $icu->labResult->trombosit }} /µL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Kreatinin</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->labResult->kreatinin)
					{{ $icu->labResult->kreatinin }} mg/dL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>

		<h2 class="text-xl font-bold my-4">Analisis Gas Darah</h2>
		<table>
			<tr>
				<td>pH</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->agd->ph)
					{{ $icu->agd->ph }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>pCO<sub>2</sub></td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->agd->pco2)
					{{ $icu->agd->pco2 }} mmHg
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>pO<sub>2</sub></td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->agd->po2)
					{{ $icu->agd->po2 }} mmHg
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>SpO<sub>2</sub></td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->agd->spo2)
					{{ $icu->agd->spo2 }} %
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>

		<table class="my-4">
			<tr>
				<td>RO</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->ro)
					{{ $icu->ro }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>RO Thorax</td>
				<td class="px-4">:</td>
				<td>
					@if($icu && $icu->ro_post_intubation)
					{{ $icu->ro_post_intubation }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Kultur Darah</td>
				<td class="px-4">:</td>
				<td class="py-4  ">
					@if($icu && $icu->blood_culture)
					{{ $icu->blood_culture }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>
		@else
			<p>Tidak Ada Data</p>
		@endif
		{{-- End Data Intensif --}}

		{{-- INTUBATION --}}
		@if ($intubations)
			@foreach ($intubations as $index => $intubation)
				<div class="bg-slate-100 shadow-md rounded-lg p-6 my-4">
					<h2 class="text-2xl text-left font-bold mb-6">
						Intubasi {{ $index + 1 }} | {{ $intubation->intubation_location }}
                
						@php
							// Cek apakah ada intubasi berikutnya
							$nextIntubation = $intubations->get($index + 1);
							$timeDifference = null;

							if ($nextIntubation) {
								$diff = Carbon::parse($intubation->intubation_datetime)->diff(Carbon::parse($nextIntubation->intubation_datetime));
							} elseif ($extubation && $index === $intubations->count() - 1) {
								// Jika tidak ada intubasi berikutnya, cek extubasi untuk intubasi terakhir
								$diff = Carbon::parse($intubation->intubation_datetime)->diff(Carbon::parse($extubation->extubation_datetime));
							}

							if (isset($diff)) {
								$timeDifference = sprintf('%d jam %d menit', $diff->h, $diff->i);

								// Tambahkan informasi hari jika ada
								if ($diff->d > 0) {
									$timeDifference = sprintf('%d hari %s', $diff->d, $timeDifference);
								}
							}
						@endphp

						@if ($timeDifference)
							| Waktu Intubasi: {{ $timeDifference }}
						@endif
					</h2>
					
					<div class="flex flex-wrap">
						<!-- Kolom Kiri -->
						<div class="w-1/4 pr-4 mr-32">
							<table class="w-full">
								<tr>
									<td>Waktu Intubasi</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->intubation_datetime)
										{{ Carbon::parse($intubation->intubation_datetime)->format('H:i d/m/Y') }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>Lokasi Intubasi</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->intubation_location)
										{{ $intubation->intubation_location }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>Nama Dokter Intubasi</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->dr_intubation)
										{{ $intubation->dr_intubation }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>Nama Dokter Konsulan</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->dr_consultant)
										{{ $intubation->dr_consultant }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>Therapy</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->therapy_type)
										{{ $intubation->therapy_type }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>Mode Venti</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->mode_venti)
										{{ $intubation->mode_venti }}
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
							</table>
						</div>

						<!-- Kolom Kanan -->
						<div class="w-1/4 pl-4">
							<table class="w-full">
								<tr>
									<td>ETT/Kedalaman</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->diameter && $intubation->depth)
										{{ $intubation->diameter }} mm / {{ $intubation->depth }} cm
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>IPL</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->ipl)
										{{ $intubation->ipl }} cmH₂O
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>PEEP</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->peep)
										{{ $intubation->peep }} cmH₂O
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>FiO<sub>2</sub></td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->fio2)
										{{ $intubation->fio2 }} %
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
								<tr>
									<td>RR</td>
									<td class="px-2">:</td>
									<td>
										@if($intubation && $intubation->rr)
										{{ $intubation->rr }} kali per menit
										@else
										Tidak ada data
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>

					<h2 class="text-xl text-left font-bold mt-6">TTV</h2>
					<table>
						<tr>
							<td>TD</td>
							<td class="px-2">:</td>
							<td>
								@if($intubation && $intubation->ttv->sistolik && $intubation->ttv->diastolik)
								{{ $intubation->ttv->sistolik }} / {{ $intubation->ttv->diastolik }}
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>Suhu</td>
							<td class="px-2">:</td>
							<td>
								@if($intubation && $intubation->ttv->suhu)
								{{ $intubation->ttv->suhu }} °C
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>Nadi</td>
							<td class="px-2">:</td>
							<td>
								@if($intubation && $intubation->ttv->nadi)
								{{ $intubation->ttv->nadi }} bpm
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>RR</td>
							<td class="px-2">:</td>
							<td>
								@if($intubation && $intubation->ttv->rr)
								{{ $intubation->ttv->rr }} kali per menit
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>SpO<sub>2</sub></td>
							<td class="px-2">:</td>
							<td>
								@if($intubation && $intubation->ttv->spo2)
								{{ $intubation->ttv->spo2 }} %
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
					</table>
				</div>
			@endforeach
		@endif

		{{-- EXTUBATION --}}
		@if ($extubation)
		<div class="bg-slate-200 shadow-md rounded-lg p-6 my-4">
			<h2 class="text-2xl text-left font-bold mb-6">Extubasi Pasien</h2>
			<table class="my-4">
				<tr>
					<td>Tanggal dan Waktu Extubasi</td>
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
					<td>Therapi Persiapan Ekstubasi</td>
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
					<td>Tindakan Ekstubasi</td>
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
					<td>Nebu Adrenalin</td>
					<td class="px-4">:</td>
					<td>
						@if($extubation && $extubation->nebu_adrenalin)
							{{ $extubation->nebu_adrenalin }} mL
						@else
							Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Dexamethasone</td>
					<td class="px-4">:</td>
					<td>
						@if($extubation && $extubation->dexamethasone)
							{{ $extubation->dexamethasone }} mg
						@else
							Tidak ada data
						@endif
					</td>
				</tr>
				<tr>
					<td>Kondisi Pasien</td>
					<td class="px-4">:</td>
					<td>
						@if($extubation && $extubation->patient_status)
							{{ $extubation->patient_status }}
						@else
							Tidak ada data
						@endif
					</td>
				</tr>
			</table>
			
		</div>
		@endif
	</div>

	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="flex items-center justify-between mb-6">
			<h2 class="text-2xl text-left font-bold mb-6">Pindah Ruangan Pasien</h2>
			@if($extubation && $extubation->patient_status === 'Tidak Meninggal' && !$transfer)
				<a href="{{ route('transfer-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right mx-4">
					Tambah Data Pindah Ruangan
				</a>
			@endif
		</div>

		@if ($transfer)
		<table>
			<tr>
				<td>Waktu dan Tanggal Pindah Ruangan</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->transfer_room_date)
						{{ Carbon::parse($transfer->transfer_room_date)->format('H:i d/m/Y') }}
					@else
						Tidak ada data
					@endif
				</td>			
			</tr>
			<tr>
				<td>Nama Ruangan</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->transfer_room_name)
					{{ $transfer->transfer_room_name }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Diagnosa Utama</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->main_diagnose)
					{{ $transfer->main_diagnose }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Diagnosa Sekunder</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->secondary_diagnose)
					{{ $transfer->secondary_diagnose }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Hasil Lab Kultur</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->lab_culture_data)
					{{ $transfer->lab_culture_data }}
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>

		<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
		<table>
			<tr>
				<td>Hb</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->labResult->hb)
					{{ $transfer->labResult->hb }} g/dL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Leukosit</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->labResult->leukosit)
					{{ $transfer->labResult->leukosit }} /µL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>PCV</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->labResult->pcv)
					{{ $transfer->labResult->pcv }} %
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Trombosit</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->labResult->trombosit)
					{{ $transfer->labResult->trombosit }} /µL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
			<tr>
				<td>Kreatinin</td>
				<td class="px-4">:</td>
				<td>
					@if($transfer && $transfer->labResult->kreatinin)
					{{ $transfer->labResult->kreatinin }} mg/dL
					@else
					Tidak ada data
					@endif
				</td>
			</tr>
		</table>

		<h2 class="text-xl text-left font-bold mt-6">TTV</h2>
					<table>
						<tr>
							<td>TD</td>
							<td class="px-2">:</td>
							<td>
								@if($transfer && $transfer->ttv->sistolik && $transfer->ttv->diastolik)
								{{ $transfer->ttv->sistolik }} / {{ $transfer->ttv->diastolik }}
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>Suhu</td>
							<td class="px-2">:</td>
							<td>
								@if($transfer && $transfer->ttv->suhu)
								{{ $transfer->ttv->suhu }} °C
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>Nadi</td>
							<td class="px-2">:</td>
							<td>
								@if($transfer && $transfer->ttv->nadi)
								{{ $transfer->ttv->nadi }} bpm
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>RR</td>
							<td class="px-2">:</td>
							<td>
								@if($transfer && $transfer->ttv->rr)
								{{ $transfer->ttv->rr }} kali per menit
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
						<tr>
							<td>SpO<sub>2</sub></td>
							<td class="px-2">:</td>
							<td>
								@if($transfer && $transfer->ttv->spo2)
								{{ $transfer->ttv->spo2 }} %
								@else
								Tidak ada data
								@endif
							</td>
						</tr>
					</table>
		@else
		<p>Tidak Ada Data</p>
		@endif
	</div>




</div>

@endsection
