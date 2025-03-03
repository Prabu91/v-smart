@extends('layouts.app')

@section('title', 'Detail Intensif')

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
		<li>
		<div class="flex items-center">
			<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
			</svg>
			<a href="{{ route('patients.show', $icuRecords->patient_id) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-grey-900 md:ml-2 dark:text-gray-400 dark:hover:text-slate-900">Detail Pasien</a>
		</div>
		</li>
		<li aria-current="page">
		<div class="flex items-center">
			<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
			</svg>
			<span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-grey-900">Detail Data Intensif</span>
		</div>
		</li>
	</ol>
</nav>

<div class="container mx-auto p-6">
	<h1 class="text-3xl text-center mb-2">Detail Data Intensif</span></h1>
	<h2 class="text-2xl text-center font-bold mb-2">{{ Carbon::parse($icuRecords->icu_room_datetime)->format('d/m/Y') }}</h2>
	<h2 class="text-xl text-center mb-10">Ruang : {{ $icuRecords->icu_room_name }}</h2>

	<div class="bg-white shadow-xl rounded-lg p-6 my-4">
		<div class="grid grid-cols-4 gap-4">
			<div>
				<h2 class="text-xl font-bold my-4">Hasil Lab</h2>
				<table>
					<tr>
						<td>Hb</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->hb ?? '0' }} g/dL
						</td>
					</tr>
					<tr>
						<td>Leukosit</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->leukosit ?? '0' }} /µL
						</td>
					</tr>
					<tr>
						<td>PCV</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->pcv ?? '0' }} %
						</td>
					</tr>
					<tr>
						<td>Trombosit</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->trombosit ?? '0' }} /µL
						</td>
					</tr>
					<tr>
						<td>Kreatinin</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->kreatinin ?? '0' }} mg/dL
						</td>
					</tr>
					<tr>
						<td>Albumin</td>
						<td class="px-4">:</td>
						<td>
							{{  number_format($icuRecords->labResult->albumin ?? '0', 1) }} g/dL
						</td>
					</tr>
					<tr>
						<td>Laktat</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->laktat ?? '0' }} mmol/L
						</td>
					</tr>
					<tr>
						<td>SBUT</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->sbut ?? '0' }} mmol/L
						</td>
					</tr>
					<tr>
						<td>Ureum</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->labResult->ureum ?? '0' }} mg/dL
						</td>
					</tr>
				</table>
			</div>

			<div>
				<h2 class="text-xl font-bold my-4">Elektrolit</h2>
				<table>
					<tr>
						<td>Na<sup>+</sup></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->elektrolit->natrium ?? '0' }} mmol/L
						</td>
					</tr>
					<tr>
						<td>K<sub>+</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ number_format($icuRecords->elektrolit->kalium ?? '0', 1) }} mmol/L
						</td>
					</tr>
					<tr>
						<td>Ca<sub>2+</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->elektrolit->calsium ?? '0' }} mg/dL
						</td>
					</tr>
					<tr>
						<td>Mg<sub>2+</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->elektrolit->magnesium ?? '0'}} mg/dL
						</td>
					</tr>
					<tr>
						<td>Cl<sub></sub></td>
						<td class="px-4">:</td>
						<td>
							{{ number_format($icuRecords->elektrolit->clorida ?? '0', 1)}} mmol/L
						</td>
					</tr>
				</table>
			</div>

			<div>
				<h2 class="text-xl font-bold my-4">Analisis Gas Darah</h2>
				<table>
					<tr>
						<td>pH</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->ph ?? '0' }}
						</td>
					</tr>
					<tr>
						<td>pCO<sub>2</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->pco2 ?? '0' }} mmHg
						</td>
					</tr>
					<tr>
						<td>pO<sub>2</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->po2 ?? '0' }} mmHg
						</td>
					</tr>
					<tr>
						<td>SpO<sub>2</sub></td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->spo2 ?? '0'}} %
						</td>
					</tr>
					<tr>
						<td>Base Excees</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->base_excees ?? '0'}} mmol/L
						</td>
					</tr>
					<tr>
						<td>SBPT</td>
						<td class="px-4">:</td>
						<td>
							{{ $icuRecords->agd->sbpt ?? '0'}} mmol/L
						</td>
					</tr>
				</table>
			</div>

			<div>
				<h2 class="text-xl text-left font-bold my-4">TTV</h2>
				<table>
					<tr>
						<td>TD</td>
						<td class="px-2">:</td>
						<td>
							{{ $icuRecords && $icuRecords->ttv->sistolik && $icuRecords->ttv->diastolik ? $icuRecords->ttv->sistolik . ' / ' . $icuRecords->ttv->diastolik : '0' }}
						</td>
					</tr>
					<tr>
						<td>Suhu</td>
						<td class="px-2">:</td>
						<td>
							{{ $icuRecords->ttv->suhu ?? '0'}} °C
						</td>
					</tr>
					<tr>
						<td>Nadi</td>
						<td class="px-2">:</td>
						<td>
							{{ $icuRecords->ttv->nadi ?? '0'}} bpm
						</td>
					</tr>
					<tr>
						<td>RR</td>
						<td class="px-2">:</td>
						<td>
							{{ $icuRecords->ttv->rr ?? '0' }} kali per menit
						</td>
					</tr>
					<tr>
						<td>SpO<sub>2</sub></td>
						<td class="px-2">:</td>
						<td>
							{{ $icuRecords->ttv->spo2 ?? '0'}} %
						</td>
					</tr>
				</table>
			</div>

		</div>

		<div>
			<table class="my-4">
				<tr>
					<td>RO</td>
					<td class="px-4">:</td>
					<td>
						{{ $icuRecords->ro }}
					</td>
				</tr>
				<tr>
					<td>RO Thorax</td>
					<td class="px-4">:</td>
					<td>
						{{ $icuRecords->ro_post_intubation ?? 'Tidak ada data' }}
					</td>
				</tr>
				<tr>
					<td>Kultur Darah</td>
					<td class="px-4">:</td>
					<td>
						{{ $icuRecords->blood_culture ?? 'Tidak ada data' }}
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="bg-white shadow-xl rounded-lg p-6 my-4">
		<div>
			<h2 class="text-xl font-bold my-4">Ventilator</h2>
			<div>
				@if ($ventilators->isNotEmpty())
					<table class="w-full text-center">
						<thead>
							<tr>
								<th class="px-4 py-2">No</th>
								<th class="px-4 py-2">Tanggal dan Waktu</th>
								<th class="px-4 py-2">Mode Venti</th>
								<th class="px-4 py-2">IPL</th>
								<th class="px-4 py-2">PEEP</th>
								<th class="px-4 py-2">FiO<sub>2</sub></th>
								<th class="px-4 py-2">RR</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($ventilators as $index => $venti)
								<tr>
									<td class="px-4 py-2">{{ $index + 1 }}</td>
									<td class="px-4 py-2">
										{{ \Carbon\Carbon::parse($venti->venti_datetime)->format('H:i d/m/Y') ?? 'Tidak ada data' }}
									</td>
									<td class="px-4 py-2">{{ $venti->mode_venti ?? 'Tidak ada data' }}</td>
									<td class="px-4 py-2">{{ $venti->ipl ?? '0' }} cmH<sub>2</sub>O</td>
									<td class="px-4 py-2">{{ $venti->peep ?? '0' }} cmH<sub>2</sub>O</td>
									<td class="px-4 py-2">{{ $venti->fio2 ?? '0' }} %</td>
									<td class="px-4 py-2">{{ $venti->rr ?? '0' }} Kali per menit</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<p class="text-gray-500">Tidak ada data ventilator</p>
				@endif
			</div>
		</div>
	</div>	

	<div class="flex justify-between items-center mt-12">
		<a href="{{ url()->previous() }}" 
		class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
			Kembali
		</a>
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
    
</script>
@endpush

@endsection
