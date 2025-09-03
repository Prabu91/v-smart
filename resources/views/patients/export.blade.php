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

    @php
        use Carbon\Carbon;
    @endphp

</head>
<body>
    <div class="header">
        {{-- <img src="public\images\vsmart.png" alt="V-SMART"> --}}
    </div>

    <h2 class="header">Data Pasien</h2>
    <table>
        <tr>
            <th>Nama</th>
            <td id="name">{{ $patient->name }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>**-**-{{  Carbon::parse($patient->tanggal_lahir)->format('Y') }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $patient->gender }}</td>
        </tr>
        <tr>
            <th>Nomor SEP</th>
            <td>{{ $patient->no_sep }}</td>
        </tr>
        <tr>
            <th>No JKN</th>
            <td id="noJkn">{{ $patient->no_jkn }}</td>
        </tr>
        <tr>
            <th>No Rekam Medis</th>
            <td id="noRm">{{ $patient->no_rm }}</td>
        </tr>
        <tr>
            <th>Rumah Sakit</th>
            <td>{{ $patient->user->userDetails->hospital }}</td>
        </tr>
    </table>

    <h2 class="header">Data Awal Pasien</h2>
    <p><b>Nama Ruangan Asal : </b>{{ $patient->originRoom->origin_room_name }}</p>
    <h3 class="header">Data Hasil Lab Awal</h3>
    <table>
        <tr>
            <th>Pemeriksaan Fisik</th>
            <td>{{ $patient->originRoom->physical_check ?? '-' }}</td>
        </tr>
        <tr>
            <th>Hb</th>
            <td>{{ $patient->originRoom->labResult->hb ?? '-' }} g/dL</td>
        </tr>
        <tr>
            <th>Leukosit</th>
            <td>{{ $patient->originRoom->labResult->leukosit ?? '-' }} /µL</td>
        </tr>
        <tr>
            <th>PCV</th>
            <td>{{ $patient->originRoom->labResult->pcv ?? '-' }} %</td>
        </tr>
        <tr>
            <th>Trombosit</th>
            <td>{{ $patient->originRoom->labResult->trombosit ?? '-' }} /µL</td>
        </tr>
        <tr>
            <th>Kreatinin</th>
            <td>{{ $patient->originRoom->labResult->kreatinin ?? '-' }} mg/dL</td>
        </tr>
        <tr>
            <th>Natrium</th>
            <td>{{ isset($patient->originRoom->natrium) ? number_format($patient->originRoom->natrium, 2) : '-' }} mmol/L</td>
        </tr>
        <tr>
            <th>Kalium</th>
            <td>{{ number_format($patient->originRoom->kalium ?? '0', 1) }} mmol/L</td>
        </tr>
        <tr>
            <th>GDS</th>
            <td>{{ $patient->originRoom->gds ?? '-' }} mg/dL</td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td>{{ $patient->originRoom->radiology ?? '-' }}</td>
        </tr>
        <tr>
            <th>Penunjang Lain</th>
            <td>{{ $patient->originRoom->additional_check ?? '-' }}</td>
        </tr>
        <tr>
            <th>Score EWS</th>
            <td>{{ $patient->originRoom->ews ?? '-' }}</td>
        </tr>
        <tr>
            <th>Diagnosa Utama</th>
            <td>{{ $patient->originRoom->main_diagnose ?? '-' }}</td>
        </tr>
        <tr>
            <th>Diagnosa Sekunder</th>
            <td>{{ $patient->originRoom->secondary_diagnose ?? '-' }}</td>
        </tr>
    </table>

    <h3 class="header">Analisis Gas Darah</h3>
    <table>
        <tr>
            <th>pH</th>
            <td>{{ $patient->originRoom->agd->ph ?? '-' }}</td>
        </tr>
        <tr>
            <th>PCO2</th>
            <td>{{ $patient->originRoom->agd->pco2 ?? '-' }} mmHg</td>
        </tr>
        <tr>
            <th>Po2</th>
            <td>{{ $patient->originRoom->agd->po2 ?? '-' }} mmHg</td>
        </tr>
        <tr>
            <th>SPO2</th>
            <td>{{ $patient->originRoom->agd->spo2 ?? '-' }} %</td>
        </tr>
        <tr>
            <th>Base Excees</th>
            <td>{{ $patient->originRoom->agd->base_excees ?? '-' }} %</td>
        </tr>
        <tr>
            <th>SBPT</th>
            <td>{{ $patient->originRoom->agd->sbpt ?? '-' }}</td>
        </tr>
        <tr>
            <th>P/F Ratio</th>
            <td>{{ $patient->originRoom->agd->pf_ratio ?? '-' }}</td>
        </tr>
        <tr>
            <th>HCO3</th>
            <td>{{ $patient->originRoom->agd->hco3 ?? '-' }}</td>
        </tr>
        <tr>
            <th>TCO2</th>
            <td>{{ $patient->originRoom->agd->tco2 ?? '-' }}</td>
        </tr>
    </table>

    <h2 class="header">Data Intubasi</h2>
    <table>
        <tr>
            <th>Ruangan Intubasi</th>
            <td>{{ $patient->intubation->intubation_location }}</td>
        </tr>
        <tr>
            <th>Waktu Intubasi</th>
            <td>{{Carbon::parse($patient->intubation->intubation_datetime)->format('H:i d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Dokter Intubasi</th>
            <td>{{ $patient->intubation->dr_intubation }}</td>
        </tr>
        <tr>
            <th>Dokter Konsulan</th>
            <td>{{ $patient->intubation->dr_consultant }}</td>
        </tr>
        <tr>
            <th>Pre Intubasi</th>
            <td>{{ $patient->intubation->pre_intubation }}</td>
        </tr>
        <tr>
            <th>Post Intubasi</th>
            <td>{{ $patient->intubation->post_intubation }}</td>
        </tr>
        <tr>
            <th>Tipe Intubasi</th>
            <td>{{ $patient->intubation->intubation_type }}</td>
        </tr>
        @if ($patient->intubation->intubation_type == 'ETT')
            <tr>
                <th>Diameter/Kedalaman</th>
                <td>{{ $patient->intubation->ett_diameter }} / {{ $patient->intubation->ett_depth }}</td>
            </tr>
        @else
            <tr>
                <th>Diameter/Tipe</th>
                <td>{{ $patient->intubation->tc_diameter }} / {{ $patient->intubation->tc_type }}</td>
            </tr>
        @endif
    </table>

    <h3 class="header">TTV Pre Intubation</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <th>TD</th>
            <th>Suhu</th>
            <th>Nadi</th>
            <th>RR</th>
            <th>SpO<sub>2</sub></th>
            <th>Kesadaran</th>
        </thead>
        <tbody>
            <td>
                {{ $intubations && $intubations->ttvPre && $intubations->ttvPre->sistolik && $intubations->ttvPre->diastolik ? $intubations->ttvPre->sistolik . ' / ' . $intubations->ttvPre->diastolik : '0' }}
            </td>
            <td>
                {{ $intubations->ttvPre->suhu ?? '0'}} °C
            </td>
            <td>
                {{ $intubations->ttvPre->nadi ?? '0'}} bpm
            </td>
            <td>
                {{ $intubations->ttvPre->rr ?? '0' }} kali per menit
            </td>
            <td>
                {{ $intubations->ttvPre->spo2 ?? '0'}} %
            </td>
            <td>
                {{ $intubations->ttvPre->consciousness ?? '0'}}
            </td>
        </tbody>
    </table>
    
    <h3 class="header">TTV Post Intubation</h3>
	<table border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <th>TD</th>
            <th>Suhu</th>
            <th>Nadi</th>
            <th>RR</th>
            <th>SpO<sub>2</sub></th>
            <th>Kesadaran</th>
        </thead>
        <tbody>
            <td>
                {{ $intubations && $intubations->ttvPost && $intubations->ttvPost->sistolik && $intubations->ttvPost->diastolik ? $intubations->ttvPost->sistolik . ' / ' . $intubations->ttvPost->diastolik : '0' }}
            </td>
            <td>
                {{ $intubations->ttvPost->suhu ?? '0'}} °C
            </td>
            <td>
                {{ $intubations->ttvPost->nadi ?? '0'}} bpm
            </td>
            <td>
                {{ $intubations->ttvPost->rr ?? '0' }} kali per menit
            </td>
            <td>
                {{ $intubations->ttvPost->spo2 ?? '0'}} %
            </td>
            <td>
                {{ $intubations->ttvPost->consciousness ?? '0'}}
            </td>
        </tbody>
    </table>


</body>
</html>
