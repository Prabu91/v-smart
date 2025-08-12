<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Patient</title>
    <style>
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
    <h2 class="header">Data Extubation</h2>
	<table class="mt-4">
		<tr>
			<th>Tanggal</th>
			<td>{{ $patient->extubation->extubation_datetime ?? '-' }}</td>
		</tr>
		<tr>
			<th>Tindakan</th>
			<td>{{ $patient->extubation->extubation ?? '-' }}</td>
		</tr>
		<tr>
			<th>Therapy</th>
			<td>{{ $patient->extubation->preparation_extubation_therapy ?? '-' }}</td>
		</tr>
		<tr>
			<th>Nebulizer</th>
			<td>{{ $patient->extubation->nebulizer ?? '-' }}</td>
		</tr>
		<tr>
			<th>Keterangan Tambahan</th>
			<td>{{ $patient->extubation->extubation_notes ?? '-' }}</td>
		</tr>
		<tr>
			<th>Status</th>
			<td>{{ $patient->extubation->patient_status ?? '-' }}</td>
		</tr>
	</table>


    @if ($patient->transferRoom)
	<h2 class="header">Data Transfer Room</h2>
	<table class="mt-4">
		<tr>
			<th>Tanggal Pindah</th>
			<td>{{ $patient->transferRoom->transfer_room_datetime ?? '-' }}</td>
		</tr>
		<tr>
			<th>Nama Ruangan</th>
			<td>{{ $patient->transferRoom->transfer_room_name ?? '-' }}</td>
		</tr>
		<tr>
			<th>Diagnosa Utama</th>
			<td>{{ $patient->transferRoom->main_diagnose ?? '-' }}</td>
		</tr>
		<tr>
			<th>Diagnosa Sekunder</th>
			<td>{{ $patient->transferRoom->secondary_diagnose ?? '-' }}</td>
		</tr>
		<tr>
			<th>Hasil Lab Kultur</th>
			<td>{{ $patient->transferRoom->lab_culture_data ?? '-' }}</td>
		</tr>
		<tr>
			<th>Keterangan Tambahan</th>
			<td>{{ $patient->transferRoom->notes ?? '-' }}</td>
		</tr>
	</table>
	

        <h3 class="my-4 header">Hasil Lab Akhir</h3>
        <table class="mt-4">
            <tr>
                <th>Hb</th>
                <td>{{ $patient->transferRoom->labResult->hb ?? '-' }}</td>
            </tr>
            <tr>
                <th>Leukosit</th>
                <td>{{ $patient->transferRoom->labResult->leukosit ?? '-' }}</td>
            </tr>
            <tr>
                <th>PCV</th>
                <td>{{ $patient->transferRoom->labResult->pcv ?? '-' }}</td>
            </tr>
            <tr>
                <th>Trombosit</th>
                <td>{{ $patient->transferRoom->labResult->trombosit ?? '-' }}</td>
            </tr>
        </table>

        <h3 class="header">TTV</h3>
        <table>
            <tr>
                <th>TD</th>
                <td>{{ $patient->transferRoom->ttv->sistolik ?? '-' }} / {{ $patient->transferRoom->ttv->diastolik ?? '-' }}</td>
            </tr>
            <tr>
                <th>Suhu</th>
                <td>{{ $patient->transferRoom->ttv->suhu ?? '-' }} °C</td>
            </tr>
            <tr>
                <th>Nadi</th>
                <td>{{ $patient->transferRoom->ttv->nadi ?? '-' }} bpm</td>
            </tr>
            <tr>
                <th>RR</th>
                <td>{{ $patient->transferRoom->ttv->rr ?? '-' }} kali per menit</td>
            </tr>
            <tr>
                <th>SpO2</th>
                <td>{{ $patient->transferRoom->ttv->spo2 ?? '-' }} %</td>
            </tr>
            <tr>
                <th>Kesadaran</th>
                <td>{{ $patient->transferRoom->ttv->consciousness ?? '-' }} </td>
            </tr>
        </table>
    @endif

	<table style="width: 100%; margin-top: 50px; border: none;">
		<tr>
			<td style="text-align: right; padding: 20px 0; border: none;">
				<p>Dokter Penanggung Jawab</p>
			</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 20px 0; border: none;">
				<p>...............................................</p>
			</td>
		</tr>
	</table>
	
	
</body>
</html>
