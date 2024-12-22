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
    <div class="header">
        {{-- <img src="public\images\vsmart.png" alt="V-SMART"> --}}
    </div>

    <h2 class="header">Data Pasien</h2>
    <table>
        <tr>
            <th>Nama</th>
            <td>{{ $patient->name }}</td>
        </tr>
        <tr>
            <th>No JKN</th>
            <td>{{ $patient->no_jkn }}</td>
        </tr>
        <tr>
            <th>No Rekam Medis</th>
            <td>{{ $patient->no_rm }}</td>
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
            <td>{{ $patient->originRoom->labResult->hb ?? '-' }}</td>
        </tr>
        <tr>
            <th>Leukosit</th>
            <td>{{ $patient->originRoom->labResult->leukosit ?? '-' }}</td>
        </tr>
        <tr>
            <th>PCV</th>
            <td>{{ $patient->originRoom->labResult->pcv ?? '-' }}</td>
        </tr>
        <tr>
            <th>Trombosit</th>
            <td>{{ $patient->originRoom->labResult->trombosit ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kreatinin</th>
            <td>{{ $patient->originRoom->labResult->kreatinin ?? '-' }}</td>
        </tr>
        <tr>
            <th>Natrium</th>
            <td>{{ $patient->originRoom->natrium ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kalium</th>
            <td>{{ $patient->originRoom->kalium ?? '-' }}</td>
        </tr>
        <tr>
            <th>GDS</th>
            <td>{{ $patient->originRoom->gds ?? '-' }}</td>
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
            <td>{{ $patient->originRoom->agd->pco2 ?? '-' }}</td>
        </tr>
        <tr>
            <th>Po2</th>
            <td>{{ $patient->originRoom->agd->po2 ?? '-' }}</td>
        </tr>
        <tr>
            <th>SPO2</th>
            <td>{{ $patient->originRoom->agd->spo2 ?? '-' }}</td>
        </tr>
        <tr>
            <th>Base Excees</th>
            <td>{{ $patient->originRoom->agd->base_excees ?? '-' }}</td>
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
            <td>{{ $patient->intubation->intubation_datetime }}</td>
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
            <th>Therapy</th>
            <td>{{ $patient->intubation->therapy_type }}</td>
        </tr>
        <tr>
            <th>ETT/Kedalaman</th>
            <td>{{ $patient->intubation->diameter }} / {{ $patient->intubation->depth }}</td>
        </tr>
    </table>

</body>
</html>
