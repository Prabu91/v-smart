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
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>Detail Patient</h1>
    </div>

    <h2>Data Pasien</h2>
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
    </table>

    <h2>Data TTV</h2>
    <table>
        <thead>
            <tr>
                <th>TD</th>
                <th>Suhu</th>
                <th>Nadi</th>
                <th>RR</th>
                <th>SpO2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->originRoom->origin_room_name }}</td>
                <td>{{ $patient->intubation->intubation_location }}</td>
                {{-- <td>{{ $patient->ttv->suhu ?? '-' }}</td>
                <td>{{ $patient->ttv->nadi ?? '-' }}</td>
                <td>{{ $patient->ttv->rr ?? '-' }}</td>
                <td>{{ $patient->ttv->spo2 ?? '-' }}</td> --}}
            </tr>
        </tbody>
    </table>

    {{-- <h2>Data Extubation</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Therapy</th>
                <th>Nebulizer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->extubations as $extubation)
                <tr>
                    <td>{{ $extubation->extubation_datetime }}</td>
                    <td>{{ $extubation->preparation_extubation_therapy }}</td>
                    <td>{{ $extubation->nebulizer }}</td>
                    <td>{{ $extubation->patient_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>
</html>
