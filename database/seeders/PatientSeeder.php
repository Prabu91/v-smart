<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Ttv;
use App\Models\Ventilator;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    public function run()
{
    // Daftar pasien dengan data yang lebih terstruktur
    $patients = [
        [
            'name' => 'Saip',
            'no_jkn' => '0045657687321',
            'no_rm' => 'RM00001',
            'user_id' => 2,
        ],
        [
            'name' => 'Rispal',
            'no_jkn' => '0044567867655',
            'no_rm' => 'RM00002',
            'user_id' => 2,
        ],
        [
            'name' => 'Jibar',
            'no_jkn' => '0075643347332',
            'no_rm' => 'RM00003',
            'user_id' => 3,
        ],
        [
            'name' => 'Hilman',
            'no_jkn' => '0076875384943',
            'no_rm' => 'RM00004',
            'user_id' => 4,
        ],
        [
            'name' => 'Nabil',
            'no_jkn' => '0019824895574',
            'no_rm' => 'RM00005',
            'user_id' => 3,
        ],
        [
            'name' => 'Ramlan',
            'no_jkn' => '123456789006',
            'no_rm' => 'RM00006',
            'user_id' => 3,
        ]
    ];

    // Loop untuk membuat 6 data pasien
    foreach ($patients as $patientData) {
        $patient = Patient::create($patientData);

        // Membuat data lab result terkait pasien
        $labResult = LabResult::create([
            'patient_id' => $patient->id,
            'user_id' => 1,
            'hb' => 12.5,
            'leukosit' => 5.0,
            'pcv' => 35,
            'trombosit' => 150000,
            'kreatinin' => 0.9
        ]);

        // Membuat data AGD terkait pasien
        $agd = Agd::create([
            'patient_id' => $patient->id,
            'user_id' => 1,
            'ph' => 7.35,
            'pco2' => 35.0,
            'po2' => 80.0,
            'spo2' => 98.0
        ]);
        

        // Membuat data OriginRoom terkait pasien
        OriginRoom::create([
            'user_id' => 1,
            'origin_room_datetime' => now(),
            'origin_room_name' => 'ICU',
            'radiology' => 'X-Ray',
            'ro_thorax' => 'Normal',
            'additional_check' => 'No additional check',
            'main_diagnose' => 'Pneumonia',
            'secondary_diagnose' => 'Bronchitis',
            'labresult_id' => $labResult->id,
            'agd_id' => $agd->id,
            'intubation_id' => null, // Intubation kosong
            'patient_id' => $patient->id
        ]);

        // Membuat data ICU Room
        $icuRoom = IcuRoom::create([
            'user_id' => $patient->user_id,
            'icu_room_datetime' => now(),
            'icu_room_name' => 'ICU Room ' . rand(1, 3),
            'icu_room_bednum' => rand(1, 5),
            'ro' => 'Normal',
            'ro_post_intubation' => 'Improved',
            'blood_culture' => 'Negative',
            'labresult_id' => $labResult->id,
            'agd_id' => $agd->id,
            'patient_id' => $patient->id,
        ]);

        // Membuat data TTV (Tanda-Tanda Vital)
        $ttv = Ttv::create([
            'patient_id' => $patient->id,
            'user_id' => $patient->user_id,
            'sistolik' => rand(100, 120),
            'diastolik' => rand(60, 80),
            'suhu' => rand(36, 37),
            'nadi' => rand(70, 90),
            'rr' => rand(12, 20),
            'spo2' => rand(95, 100),
        ]);

        // Membuat data Intubation
        $intubation = Intubation::create([
            'patient_id' => $patient->id,
            'user_id' => $patient->user_id,
            'intubation_datetime' => now(),
            'intubation_location' => 'ICU Room ' . rand(1, 3),
            'dr_intubation' => 'Dr. ' . ['Smith', 'Johnson', 'Brown'][rand(0, 2)],
            'dr_consultant' => 'Dr. ' . ['Taylor', 'Williams', 'Jones'][rand(0, 2)],
        ]);

        // Membuat data Ventilator pertama
        $ventilator1 = Ventilator::create([
            'patient_id' => $patient->id,
            'user_id' => $patient->user_id,
            'ttv_id' => $ttv->id,
            'intubation_id' => $intubation->id,
            'venti_datetime' => now(),
            'therapy_type' => 'Mechanical Ventilation',
            'mode_venti' => 'Assist-Control',
            'diameter' => 8.0,
            'depth' => 22.0,
            'ipl' => 20,
            'peep' => 5,
            'fio2' => 0.5,
            'rr' => rand(12, 18),
        ]);
        
        // Membuat data Ventilator kedua
        $ventilator2 = Ventilator::create([
            'patient_id' => $patient->id,
            'user_id' => $patient->user_id,
            'ttv_id' => $ttv->id,
            'intubation_id' => $intubation->id,
            'venti_datetime' => now()->addHours(4), // Ventilator kedua dengan waktu berbeda
            'therapy_type' => 'Non-Invasive Ventilation',
            'mode_venti' => 'CPAP',
            'diameter' => 8.5,
            'depth' => 21.5,
            'ipl' => 22,
            'peep' => 6,
            'fio2' => 0.6,
            'rr' => rand(14, 20),
        ]);
    }
}

}

