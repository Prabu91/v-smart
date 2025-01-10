@extends($layout)

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

<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-10">Detail Data Pasien ICU</h1>
	{{-- Data Pasien --}}
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<!-- Button Section -->
		@if (($extubation && $extubation->patient_status === 'Meninggal') || ($extubation && $extubation->patient_status !== 'Meninggal' && $transfer))
			<div class="flex justify-end mb-4">
				<a href="{{ route('patients.export-pdf', $patient->id) }}" 
					class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
					Download PDF
				</a>
			</div>
		@endif
	
		<!-- Table Section -->
		<table>
			<tr>
				<td class="font-semibold">Nama Pasien</td>
				<td class="px-4">:</td>
				<td>{{ $patient->name }}</td>
			</tr>
			<tr>
				<td class="font-semibold">No Kartu JKN</td>
				<td class="px-4">:</td>
				<td>{{ $patient->no_jkn }}</td>
			</tr>
			<tr>
				<td class="font-semibold">No Rekam Medis</td>
				<td class="px-4">:</td>
				<td>{{ $patient->no_rm }}</td>
			</tr>
		</table>
	</div>
	
	
	{{-- OriginRoom --}}
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<div class="flex items-center justify-between mb-6">
			<h2 class="text-3xl font-bold">Data Awal Pasien</h2>
			@if(!$origin)
				<a href="{{ route('origin-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right">
					Tambah Data
				</a>
			@endif

		</div>		
		@if ($origin)
			<table>
				<tr>
					<td>Nama Ruangan Asal</td>
					<td class="px-4">:</td>
					<td>
						{{ $origin->origin_room_name ?? 'Tidak ada data' }}
					</td>
				</tr>
			</table>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<h2 class="text-xl font-bold my-4">Hasil Lab Awal</h2>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<table>
								<tr>
									<td>Pemeriksaan Fisik</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->physical_check ?? 'Tidak ada data' }}
									</td>
								</tr>
								<tr>
									<td>Hb</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->labResult->hb ?? '0' }} g/dL
									</td>
								</tr>
								<tr>
									<td>Leukosit</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->labResult->leukosit ?? '0' }} /µL
									</td>
								</tr>
								<tr>
									<td>PCV</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->labResult->pcv ?? '0' }} %
									</td>
								</tr>
								<tr>
									<td>Trombosit</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->labResult->trombosit ?? '0'}} /µL
									</td>
								</tr>
							</table>
						</div>
						<div>
							<table>
								<tr>
									<td>Kreatinin</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->labResult->kreatinin ?? '0' }} mg/dL
									</td>
								</tr>
								<tr>
									<td>Natrium (Na<sup>+</sup>)</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->natrium ?? '0' }} mmol/L
									</td>
								</tr>
								<tr>
									<td>Kalium (K<sup>+</sup>)</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->kalium ?? '0' }} mmol/L
									</td>
								</tr>
								<tr>
									<td>GDS</td>
									<td class="px-4">:</td>
									<td>
										{{ $origin->gds ?? '0' }} mg/dL
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div>
					<h2 class="text-xl font-bold my-4">Analisis Gas Darah</h2>
					<table>
						<tr>
							<td>pH</td>
							<td class="px-4">:</td>
							<td>
								{{ $origin->agd->ph ?? '0' }}
							</td>
						</tr>
						<tr>
							<td>pCO<sub>2</sub></td>
							<td class="px-4">:</td>
							<td>
								{{ $origin->agd->pco2 ?? '0' }} mmHg
							</td>
						</tr>
						<tr>
							<td>pO<sub>2</sub></td>
							<td class="px-4">:</td>
							<td>
								{{ $origin->agd->po2 ?? '0'}} mmHg
							</td>
						</tr>
						<tr>
							<td>SpO<sub>2</sub></td>
							<td class="px-4">:</td>
							<td>
								{{ $origin->agd->spo2 ?? '0' }} %
							</td>
						</tr>
						<tr>
							<td>Base Excees</td>
							<td class="px-4">:</td>
							<td>
								{{ $origin->agd->base_excees ?? '0' }} %
							</td>
						</tr>
					</table>
				</div>
			</div>

			<table class="my-10">
				<tr>
					<td>Radiologi<br>CT scan / MRI / USG / RO Thorax</td>
					<td class="px-4">:</td>
					<td  class="py-2">
						{{ $origin->radiology ?? 'Tidak ada data'}}
					</td>
				</tr>
				<tr>
					<td>Penunjang Lain</td>
					<td class="px-4">:</td>
					<td class="py-4">
						{{ $origin->additional_check ?? 'Tidak ada data'}}
					</td>
				</tr>
				<tr>
					<td>Score EWS</td>
					<td class="px-4">:</td>
					<td>
						{{ $origin->ews ?? 'Tidak ada data' }}
					</td>
				</tr>
				<tr>
					<td>Diagnosa Utama</td>
					<td class="px-4">:</td>
					<td>
						{{ $origin->main_diagnose ?? 'Tidak ada data' }}
					</td>
				</tr>
				<tr>
					<td>Diagnosa Sekunder</td>
					<td class="px-4">:</td>
					<td>
						{{ $origin->secondary_diagnose ?? 'Tidak ada data' }}
					</td>
				</tr>
			</table>
		@else
		<p>Tidak Ada Data</p>
		@endif

	</div>

	@if ($origin)
		<div class="bg-white shadow-xl rounded-lg p-6 my-4">
			<div class="flex items-center justify-between mb-6">
				<h2 class="text-3xl font-bold mb-6">Data Ruang Intensif</h2>
				{{-- Container for Buttons --}}
				<div class="flex space-x-4 ml-auto">
					@if ($origin)
						@if(!$icu && !$intubations)
						<a href="{{ route('intubations.create') }}?patient_id={{ $patient->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
							Tambah Data Intubasi
						</a>	
						@elseif(!$extubation)
						<a href="{{ route('icu-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
							Data Ruang Intensif
						</a>
						@endif
					@endif

					@if ($icu && !$extubation && $ventiReleaseButton === false)
						<a href="{{ route('extubations.create') }}?patient_id={{ $patient->id }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
							Tambah Data Extubasi
						</a>
					@endif
				</div>
			</div>

			{{-- INTUBATION --}}
			@if ($intubations)
			<div class="bg-slate-100 shadow-md rounded-lg p-6 my-4">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<h2 class="text-2xl font-bold mb-4">
							Intubasi | Ruangan : {{ $intubations->intubation_location }}
						</h2>
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<table>
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
								</table>
							</div>
							<div>
								<table>
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
										<td>Therapy</td>
										<td class="px-2">:</td>
										<td>{{ $intubations->therapy_type ?? 'Tidak ada data' }}</td>
									</tr>
									<tr>
										<td>ETT / Kedalaman</td>
										<td class="px-2">:</td>
										<td>
											{{ $intubations && $intubations->diameter && $intubations->depth ? $intubations->diameter . ' mm / ' . $intubations->depth . ' cm' : '0 mm / 0 cm' }}
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div>
						<h2 class="text-xl text-left font-bold mb-4">TTV</h2>
							<table>
								<tr>
									<td>TD</td>
									<td class="px-2">:</td>
									<td>
										{{ $intubations && $intubations->ttv->sistolik && $intubations->ttv->diastolik ? $intubations->ttv->sistolik . ' / ' . $intubations->ttv->diastolik : '0' }}
									</td>
								</tr>
								<tr>
									<td>Suhu</td>
									<td class="px-2">:</td>
									<td>
										{{ $intubations->ttv->suhu ?? '0'}} °C
									</td>
								</tr>
								<tr>
									<td>Nadi</td>
									<td class="px-2">:</td>
									<td>
										{{ $intubations->ttv->nadi ?? '0'}} bpm
									</td>
								</tr>
								<tr>
									<td>RR</td>
									<td class="px-2">:</td>
									<td>
										{{ $intubations->ttv->rr ?? '0' }} kali per menit
									</td>
								</tr>
								<tr>
									<td>SpO<sub>2</sub></td>
									<td class="px-2">:</td>
									<td>
										{{ $intubations->ttv->spo2 ?? '0'}} %
									</td>
								</tr>
							</table>
					</div>
				</div>

				{{-- Cek Extubation --}}
				@if ($intubations->extubation)
					<p>Waktu Extubasi: 
						{{ Carbon::parse($intubations->intubation_datetime)->diffForHumans(Carbon::parse($intubations->extubation->extubation_datetime), true) }}
					</p>
				@endif

			</div>
			@endif
			
			{{-- Data Intensif --}}
			{{-- @if ($icu) --}}
			<div class="bg-slate-100 shadow-md rounded-lg p-6 my-4">
				<table id="icu-table" class="table-auto w-full text-left">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal dan Waktu Periksa</th>
							<th>Ruangan/Bed</th>
							<th>Elektrolit</th>
							<th>Hb/Leukosit</th>
							<th>Albumin/Laktat</th>
							<th>AGD<br>(ph/pCO2)</th>
							<th>TTV<br>(TD, Nadi)</th>
							<th>Action</th>
						</tr>
					</thead>
				</table> 

				<h2 class="text-2xl font-bold my-10">Data Ventilator</h2>
				<table id="venti-table" class="table-auto w-full text-left">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal dan Waktu Mulai</th>
							<th>Mode Ventilator</th>
							<th>Parameter<br>FiO<sub>2</sub> , PEEP</th>
							<th>Durasi Penggunaan Venti</th>
							<th>Action</th>
						</tr>
					</thead>
				</table> 
			</div>
			{{-- @endif --}}
			{{-- End Data Intensif --}}

			{{-- EXTUBATION --}}
			@if ($extubation)
			<div class="bg-slate-200 shadow-md rounded-lg p-6 my-4">
				<h2 class="text-2xl text-left font-bold mb-6">Extubasi Pasien</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
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
								<td>Nebulizer</td>
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

					@if($extubation->ttv)
					<div>
						<h2 class="text-xl text-left font-bold mb-4">TTV</h2>
							<table>
								<tr>
									<td>TD</td>
									<td class="px-2">:</td>
									<td>
										{{ $extubation && $extubation->ttv->sistolik && $extubation->ttv->diastolik ? $extubation->ttv->sistolik . ' / ' . $extubation->ttv->diastolik : '0' }}
									</td>
								</tr>
								<tr>
									<td>Suhu</td>
									<td class="px-2">:</td>
									<td>
										{{ $extubation->ttv->suhu ?? '0'}} °C
									</td>
								</tr>
								<tr>
									<td>Nadi</td>
									<td class="px-2">:</td>
									<td>
										{{ $extubation->ttv->nadi ?? '0'}} bpm
									</td>
								</tr>
								<tr>
									<td>RR</td>
									<td class="px-2">:</td>
									<td>
										{{ $extubation->ttv->rr ?? '0' }} kali per menit
									</td>
								</tr>
								<tr>
									<td>SpO<sub>2</sub></td>
									<td class="px-2">:</td>
									<td>
										{{ $extubation->ttv->spo2 ?? '0'}} %
									</td>
								</tr>
							</table>
					</div>
					@endif
				</div>
				
			</div>
			@endif
		</div>
	@endif

	@if ($extubation )	
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
						<td>{{ $transfer->transfer_room_datetime ? Carbon::parse($transfer->transfer_room_datetime)->format('H:i d/m/Y') : 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td>Nama Ruangan</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->transfer_room_name ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td>Diagnosa Utama</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->main_diagnose ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td>Diagnosa Sekunder</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->secondary_diagnose ?? 'Tidak ada data' }}</td>
					</tr>
					<tr>
						<td>Hasil Lab Kultur</td>
						<td class="px-4">:</td>
						<td>{{ $transfer->lab_culture_data ?? 'Tidak ada data' }}</td>
					</tr>
				</table>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
						<table>
							<tr>
								<td>Hb</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->hb ?? 'Tidak ada data' }} g/dL</td>
							</tr>
							<tr>
								<td>Leukosit</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->leukosit ?? 'Tidak ada data' }} /µL</td>
							</tr>
							<tr>
								<td>PCV</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->pcv ?? 'Tidak ada data' }} %</td>
							</tr>
							<tr>
								<td>Trombosit</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->trombosit ?? 'Tidak ada data' }} /µL</td>
							</tr>
							<tr>
								<td>Kreatinin</td>
								<td class="px-4">:</td>
								<td>{{ $transfer->labResult->kreatinin ?? 'Tidak ada data' }} mg/dL</td>
							</tr>
						</table>
					</div>

					<div>
						<h2 class="text-xl text-left font-bold mt-6">TTV</h2>
						<table>
							<tr>
								<td>TD</td>
								<td class="px-2">:</td>
								<td>{{ ($transfer->ttv->sistolik ?? '-') }} / {{ ($transfer->ttv->diastolik ?? '-') }}</td>
							</tr>
							<tr>
								<td>Suhu</td>
								<td class="px-2">:</td>
								<td>{{ $transfer->ttv->suhu ?? 'Tidak ada data' }} °C</td>
							</tr>
							<tr>
								<td>Nadi</td>
								<td class="px-2">:</td>
								<td>{{ $transfer->ttv->nadi ?? 'Tidak ada data' }} bpm</td>
							</tr>
							<tr>
								<td>RR</td>
								<td class="px-2">:</td>
								<td>{{ $transfer->ttv->rr ?? 'Tidak ada data' }} kali per menit</td>
							</tr>
							<tr>
								<td>SpO<sub>2</sub></td>
								<td class="px-2">:</td>
								<td>{{ $transfer->ttv->spo2 ?? 'Tidak ada data' }} %</td>
							</tr>
						</table>
					</div>
				</div>
			@else
				<p>Tidak Ada Data</p>
			@endif

		</div>
	@endif

	{{-- back utton --}}
	<div class="flex justify-between items-center mt-12 ml-4">
		<a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
			Kembali
		</a>
	</div>


	<!-- Modal -->
	<div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
		<div class="bg-white rounded-lg shadow-lg p-6">
			<h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>	
			<p>Apakah Anda yakin ingin menyimpan data <span class="font-bold">Lepas Venti?</span></p>
			<div class="flex justify-end mt-4">
				<button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</button>
				<button id="confirmButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ya, Simpan</button>
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
				{ data: 'elektrolit', name: 'elektrolit', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'lb1', name: 'lb1', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'lb2', name: 'lb2', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'agd', name: 'agd', defaultContent: 'Tidak ada data', className: 'text-center' },
				{ data: 'ttv', name: 'ttv', defaultContent: 'Tidak ada data', className: 'text-center' },
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
				{ data: 'parameters', name: 'parameters', defaultContent: 'Tidak ada data', className: 'text-center' },
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
