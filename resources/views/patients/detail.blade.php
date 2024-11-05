@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
	@if(session('success'))
	<div id="successMessage" class="bg-green-500 text-white p-4 rounded-md">
		{{ session('success') }}
	</div>
	@endif

    <h1 class="text-2xl text-center font-bold mb-10">Detail Data Pasien ICU</h1>
	
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
			<a href="{{ route('origin-rooms.create') }}?patient_id={{ $patient->id }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right">
				Tambah Data
			</a>
			
		</div>		
		<p>Data Asal Ruangan Pasien</p>
	</div>
	<div class="bg-white shadow-xl rounded-lg p-6 my-4">
		<h2 class="text-2xl text-left font-bold mb-6">Pasien di Ruang Intensif</h2>
		<p>Data Ruang Intensif</p>
		<div class="bg-slate-100 shadow-md rounded-lg p-6 my-4">
			<h2 class="text-2xl text-left font-bold mb-6">Intubasi 1</h2>
			<p>Data Ruang Intensif</p>
		</div>
		<div class="bg-slate-200 shadow-md rounded-lg p-6 my-4">
			<h2 class="text-2xl text-left font-bold mb-6">Extubasi Pasien</h2>
			<p>Data Extubasi</p>
		</div>
	</div>
	<div class="bg-white shadow-md rounded-lg p-6 my-4">
		<h2 class="text-2xl text-left font-bold mb-6">Pindah Ruangan Pasien</h2>
		<p>Data Pindah Ruangan Pasien</p>
	</div>




</div>

@endsection
