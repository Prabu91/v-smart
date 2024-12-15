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

    <h1>Data Awal Pasien</h1>
    <p>Nama Ruangan Asal : {{ $patient->originRoom->origin_room_name }}</p>
    <h3>Data Hasil Lab Awal</h3>
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

    <h3>Analisis Gas Darah</h3>
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

    <h1>Data Intubasi</h1>
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

    <h3>Detail Data Intensif</h3>

    @foreach ($icuRoomsByDate as $date => $icuRooms)
    <h4>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h4>

        @foreach ($icuRooms as $icuRoom)
            <p><strong>Ruang:</strong> {{ $icuRoom->icu_room_name ?? '-' }}</p>

            <h5>Hasil Lab</h5>
            <table>
                <tr>
                    <th>Hb</th>
                    <td>{{ $icuRoom->labResult->hb ?? '-' }} g/dL</td>
                </tr>
                <tr>
                    <th>Leukosit</th>
                    <td>{{ $icuRoom->labResult->leukosit ?? '-' }} /µL</td>
                </tr>
                <tr>
                    <th>PCV</th>
                    <td>{{ $icuRoom->labResult->pcv ?? '-' }} %</td>
                </tr>
                <tr>
                    <th>Trombosit</th>
                    <td>{{ $icuRoom->labResult->trombosit ?? '-' }} /µL</td>
                </tr>
                <tr>
                    <th>Kreatinin</th>
                    <td>{{ $icuRoom->labResult->kreatinin ?? '-' }} mg/dL</td>
                </tr>
                <tr>
                    <th>Albumin</th>
                    <td>{{ $icuRoom->labResult->albumin ?? '-' }} g/dL</td>
                </tr>
                <tr>
                    <th>Laktat</th>
                    <td>{{ $icuRoom->labResult->laktat ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>SBUT</th>
                    <td>{{ $icuRoom->labResult->sbut ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>Ureum</th>
                    <td>{{ $icuRoom->labResult->ureum ?? '-' }} mg/dL</td>
                </tr>
            </table>

            <h5>Elektrolit</h5>
            <table>
                <tr>
                    <th>Na+</th>
                    <td>{{ $icuRoom->elektrolit->natrium ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>K+</th>
                    <td>{{ $icuRoom->elektrolit->kalium ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>Ca2+</th>
                    <td>{{ $icuRoom->elektrolit->calsium ?? '-' }} mg/dL</td>
                </tr>
                <tr>
                    <th>Mg2+</th>
                    <td>{{ $icuRoom->elektrolit->magnesium ?? '-' }} mg/dL</td>
                </tr>
                <tr>
                    <th>Cl</th>
                    <td>{{ $icuRoom->elektrolit->clorida ?? '-' }} mmol/L</td>
                </tr>
            </table>

            <h5>Analisis Gas Darah</h5>
            <table>
                <tr>
                    <th>pH</th>
                    <td>{{ $icuRoom->agd->ph ?? '-' }}</td>
                </tr>
                <tr>
                    <th>pCO2</th>
                    <td>{{ $icuRoom->agd->pco2 ?? '-' }} mmHg</td>
                </tr>
                <tr>
                    <th>pO2</th>
                    <td>{{ $icuRoom->agd->po2 ?? '-' }} mmHg</td>
                </tr>
                <tr>
                    <th>SpO2</th>
                    <td>{{ $icuRoom->agd->spo2 ?? '-' }} %</td>
                </tr>
                <tr>
                    <th>Base Excees</th>
                    <td>{{ $icuRoom->agd->base_excees ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>SBPT</th>
                    <td>{{ $icuRoom->agd->sbpt ?? '-' }} mmol/L</td>
                </tr>
                <tr>
                    <th>RO</th>
                    <td>{{ $icuRoom->ro ?? '-' }}</td>
                </tr>
                <tr>
                    <th>RO Thorax</th>
                    <td>{{ $icuRoom->ro_post_intubation ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kultur Darah</th>
                    <td>{{ $icuRoom->blood_culture ?? '-' }}</td>
                </tr>
            </table>

            <h5>TTV</h5>
            <table>
                <tr>
                    <th>TD</th>
                    <td>{{ $icuRoom->ttv->sistolik ?? '-' }} / {{ $icuRoom->ttv->diastolik ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Suhu</th>
                    <td>{{ $icuRoom->ttv->suhu ?? '-' }} °C</td>
                </tr>
                <tr>
                    <th>Nadi</th>
                    <td>{{ $icuRoom->ttv->nadi ?? '-' }} bpm</td>
                </tr>
                <tr>
                    <th>RR</th>
                    <td>{{ $icuRoom->ttv->rr ?? '-' }} kali per menit</td>
                </tr>
                <tr>
                    <th>SpO2</th>
                    <td>{{ $icuRoom->venti->venti_datetime ?? '-' }} %</td>
                </tr>
            </table>
            <hr>
        @endforeach
    @endforeach
            
        <h4>Ventilator:</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal dan Waktu</th>
                    <th>Mode Venti</th>
                    <th>IPL</th>
                    <th>PEEP</th>
                    <th>FiO2</th>
                    <th>RR</th>
                    <th>Waktu Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patient->venti as $index => $venti)
                    <tr>
                        <td>{{ $index + 1 }}</td>  <!-- Nomor urut -->
                        <td>{{ \Carbon\Carbon::parse($venti->venti_datetime)->format('H:i d/m/Y') ?? '-' }}</td>
                        <td>{{ $venti->mode_venti ?? '-' }}</td>
                        <td>{{ $venti->ipl ?? '-' }} cmH2O</td>
                        <td>{{ $venti->peep ?? '-' }} cmH2O</td>
                        <td>{{ $venti->fio2 ?? '-' }} %</td>
                        <td>{{ $venti->rr ?? '-' }} kali per menit</td>
                        <td>{{ $venti->usage_time ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <h2>Data Extubation</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tindakan</th>
                <th>Therapy</th>
                <th>Nebulizer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->extubation->extubation_datetime }}</td>
                <td>{{ $patient->extubation->extubation }}</td>
                <td>{{ $patient->extubation->preparation_extubation_therapy }}</td>
                <td>{{ $patient->extubation->nebulizer }}</td>
                <td>{{ $patient->extubation->patient_status }}</td>
            </tr>
        </tbody>
    </table>
    @if ($patient->transferRoom)
    <h2>Data Extubation</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tindakan</th>
                <th>Therapy</th>
                <th>Nebulizer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->extubation->extubation_datetime }}</td>
                <td>{{ $patient->extubation->extubation }}</td>
                <td>{{ $patient->extubation->preparation_extubation_therapy }}</td>
                <td>{{ $patient->extubation->nebulizer }}</td>
                <td>{{ $patient->extubation->patient_status }}</td>
            </tr>
        </tbody>
    </table>
    @endif


</body>
</html>
