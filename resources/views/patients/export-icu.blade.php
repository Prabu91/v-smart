<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Patient</title>
    <style>
		@page {
			size: A4 landscape;
		}
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;    
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
	<h3 class="header">Hasil Lab</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Waktu</th>
				@foreach ($icuRoomsByDate as $date => $icuRooms)
					<th>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Hb</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->hb ?? '-' }} g/dL</td>
				@endforeach
			</tr>
			<tr>
				<th>Leukosit</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->leukosit ?? '-' }} /µL</td>
				@endforeach
			</tr>
			<tr>
				<th>PCV</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->pcv ?? '-' }} %</td>
				@endforeach
			</tr>
			<tr>
				<th>Trombosit</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->trombosit ?? '-' }} /µL</td>
				@endforeach
			</tr>
			<tr>
				<th>Kreatinin</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->kreatinin ?? '-' }} mg/dL</td>
				@endforeach
			</tr>
			<tr>
				<th>Albumin</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ number_format($icuRooms->first()->labResult->albumin ?? '0', 1) }} g/dL</td>
				@endforeach
			</tr>
			<tr>
				<th>Laktat</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ isset($icuRooms->first()->labResult->laktat) ? number_format($icuRooms->first()->labResult->laktat, 2) : '-' }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>SBUT</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->sbut ?? '-' }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>Ureum</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->labResult->ureum ?? '-' }} mg/dL</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<h3 class="header">Elektrolit</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Waktu</th>
				@foreach ($icuRoomsByDate as $date => $icuRooms)
					<th>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Na+</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->elektrolit->natrium ?? '-' }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>K+</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ number_format($icuRooms->first()->elektrolit->kalium ?? '0', 1) }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>Ca2+</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->elektrolit->calsium ?? '-' }} mg/dL</td>
				@endforeach
			</tr>
			<tr>
				<th>Mg2+</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ isset($icuRooms->first()->elektrolit->magnesium) ? number_format($icuRooms->first()->elektrolit->magnesium, 2) : '-' }} mg/dL</td>
				@endforeach
			</tr>
			<tr>
				<th>Cl</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ number_format($icuRooms->first()->elektrolit->clorida ?? '0', 1) }} mmol/L</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<h3 class="header">Analisis Gas Darah</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Waktu</th>
				@foreach ($icuRoomsByDate as $date => $icuRooms)
					<th>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>pH</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->ph ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>pCO2</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->pco2 ?? '-' }} mmHg</td>
				@endforeach
			</tr>
			<tr>
				<th>pO2</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->po2 ?? '-' }} mmHg</td>
				@endforeach
			</tr>
			<tr>
				<th>SpO2</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->spo2 ?? '-' }} %</td>
				@endforeach
			</tr>
			<tr>
				<th>Base Excees</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->base_excees ?? '-' }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>SBPT</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->agd->sbpt ?? '-' }} mmol/L</td>
				@endforeach
			</tr>
			<tr>
				<th>RO</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ro ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>RO Thorax</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ro_post_intubation ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Kultur Darah</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->blood_culture ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Warna Sputum</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->sputum_color ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Pemeriksaan dikirim ke Lab</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->lab_tests_sent ?? '-' }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<h3 class="header">TTV</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Waktu</th>
				@foreach ($icuRoomsByDate as $date => $icuRooms)
					<th>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>TD</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->sistolik ?? '-' }} / {{ $icuRooms->first()->ttv->diastolik ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Suhu</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->suhu ?? '-' }} °C</td>
				@endforeach
			</tr>
			<tr>
				<th>Nadi</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->nadi ?? '-' }} bpm</td>
				@endforeach
			</tr>
			<tr>
				<th>RR</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->rr ?? '-' }} kali per menit</td>
				@endforeach
			</tr>
			<tr>
				<th>SpO2</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->spo2 ?? '-' }} %</td>
				@endforeach
			</tr>
			<tr>
				<th>Kesadaran</th>
				@foreach ($icuRoomsByDate as $icuRooms)
					<td>{{ $icuRooms->first()->ttv->consciousness ?? '-' }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<h3 class="header">Ventilator</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Waktu</th>
				@foreach ($patient->venti as $venti)
					<th>{{ \Carbon\Carbon::parse($venti->venti_datetime)->format('H:i d/m/Y') }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Mode Venti</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->mode_venti ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>IPL</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->ipl ?? '-' }} cmH2O</td>
				@endforeach
			</tr>
			<tr>
				<th>PEEP</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->peep ?? '-' }} cmH2O</td>
				@endforeach
			</tr>
			<tr>
				<th>FiO2</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->fio2 ?? '-' }} %</td>
				@endforeach
			</tr>
			<tr>
				<th>RR</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->rr ?? '-' }} kali per menit</td>
				@endforeach
			</tr>
			<tr>
				<th>PS</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->ps ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Trigger</th>
				@foreach ($patient->venti as $venti)
					<td>{{ $venti->trigger ?? '-' }}</td>
				@endforeach
			</tr>
			<tr>
				<th>Waktu Pemakaian</th>
				@foreach ($ventiUsageTimes as $usageTime)
					<td>{{ $usageTime }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>


</body>
</html>
