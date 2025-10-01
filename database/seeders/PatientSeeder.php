<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\LabResult;
use App\Models\Agd;
use App\Models\Elektrolit;
use App\Models\IcuRoom;
use App\Models\Intubation;
use App\Models\OriginRoom;
use App\Models\Ttv;
use App\Models\User;
use App\Models\Ventilator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Tambahkan ini untuk Str::random() atau Str::uuid()

class PatientSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user yang ada di database
        $users = User::where('role', 'user')->pluck('id')->toArray(); 

        $patients = [
            ['name' => 'Saipudding Rahman Hakim', 'no_jkn' => '0045777687321', 'no_rm' => 'RM00001', 'no_sep' => '0120R0150225V000001', 'gender' => 'L', 'tanggal_lahir' => '1990-05-15'],
            ['name' => 'Rispal Mahendra Putra', 'no_jkn' => '0015567867655', 'no_rm' => 'RM00002', 'no_sep' => '0120R0150225V000001', 'gender' => 'L', 'tanggal_lahir' => '1985-08-22'],
            ['name' => 'Jibar Alfarizi Faiz', 'no_jkn' => '0075444347332', 'no_rm' => 'RM00003', 'no_sep' => '0120R0150225V000002', 'gender' => 'L', 'tanggal_lahir' => '1992-11-10'],
            ['name' => 'Hilman Saputra Cendana', 'no_jkn' => '0012375384943', 'no_rm' => 'RM00004', 'no_sep' => '0120R0150225V000003', 'gender' => 'L', 'tanggal_lahir' => '1988-07-30'],
            ['name' => 'Nabil Wafa idzin', 'no_jkn' => '0019233895574', 'no_rm' => 'RM00005', 'no_sep' => '0120R0150225V000004', 'gender' => 'L', 'tanggal_lahir' => '1995-12-05'],
            ['name' => 'Justin Case pratama', 'no_jkn' => '123456789008', 'no_rm' => 'RM00008', 'no_sep' => '0120R0150225V000005', 'gender' => 'L', 'tanggal_lahir' => '2000-04-25'],
            ['name' => 'Leni Siti', 'no_jkn' => '123456789007', 'no_rm' => 'RM00007', 'no_sep' => '0120R0150225V000006', 'gender' => 'P', 'tanggal_lahir' => '1993-09-14'],
            ['name' => 'Ramlan', 'no_jkn' => '123456789006', 'no_rm' => 'RM006606', 'no_sep' => '0120R0150225V000007', 'gender' => 'L', 'tanggal_lahir' => '1987-02-18'],
            ['name' => 'Ujang', 'no_jkn' => '123456783006', 'no_rm' => 'RM00036', 'no_sep' => '0120R0150225V000008', 'gender' => 'L', 'tanggal_lahir' => '1991-06-07'],
            ['name' => 'Dani Harmawan', 'no_jkn' => '123436789006', 'no_rm' => 'RM01006', 'no_sep' => '0120R0150225V000009', 'gender' => 'L', 'tanggal_lahir' => '1994-03-12'],
            ['name' => 'Kinan Permata Sari', 'no_jkn' => '123756789006', 'no_rm' => 'RM29006', 'no_sep' => '0120R0150225V000010', 'gender' => 'P', 'tanggal_lahir' => '1996-08-29'],
            ['name' => 'Septi Anggraini', 'no_jkn' => '113456789006', 'no_rm' => 'RM10006', 'no_sep' => '0120R0150225V000011', 'gender' => 'P', 'tanggal_lahir' => '1999-01-21'],
            ['name' => 'Ina Rahmadani', 'no_jkn' => '193456789006', 'no_rm' => 'RM90006', 'no_sep' => '0120R0150225V000012', 'gender' => 'P', 'tanggal_lahir' => '2001-10-10'],
            ['name' => 'Yuli Wulandari', 'no_jkn' => '129956789006', 'no_rm' => 'RM14006', 'no_sep' => '0120R0150225V000013', 'gender' => 'P', 'tanggal_lahir' => '1989-05-03'],
        ];
        

        foreach ($patients as $patientData) {
            // Pilih user secara random
            $randomUserId = $users[array_rand($users)];
            $patientData['user_id'] = $randomUserId;

            // Buat data pasien hanya jika belum ada
            $patient = Patient::firstOrCreate(
                ['no_jkn' => $patientData['no_jkn']], // Cek apakah no_jkn sudah ada
                $patientData
            );

            // Buat Lab Result
            $labResult = LabResult::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'hb' => 12.5,
                'leukosit' => 5.0,
                'pcv' => 35,
                'trombosit' => 150000,
                'kreatinin' => 0.9,
                'albumin' => 4.2,
                'laktat' => 1.8,
                'sbut' => 24,
                'ureum' => 40,
            ]);

            // Buat AGD
            $agd = Agd::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'ph' => 7.35,
                'pco2' => 35.0,
                'po2' => 80.0,
                'spo2' => 98.0,
                'base_excees' => -2,
                'sbpt' => 1,
                'pf_ratio' => 200,
                'hco3' => 13,
                'tco2' => 15,
            ]);

            // Buat Elektrolit
            $elektrolit = Elektrolit::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'natrium' => 138,
                'kalium' => 4.1,
                'calsium' => 103,
                'magnesium' => 22,
                'clorida' => 8.4,
            ]);

            // Buat TTV
            $ttv = Ttv::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'sistolik' => rand(100, 120),
                'diastolik' => rand(60, 80),
                'suhu' => rand(36, 37),
                'nadi' => rand(70, 90),
                'rr' => rand(12, 20),
                'spo2' => rand(95, 100),
                'consciousness' => 'Sadar',
            ]);

            // Buat Ventilator
            $ventilator = Ventilator::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'venti_datetime' => now(),
                'venti_usagetime' => now()->addHours(rand(1, 24)), // Random usage time
                'mode_venti' => ['Assist-Control', 'SIMV', 'PC-SIMV', 'PS', 'DuoPAP', 'PcBiPAP'][array_rand(['Assist-Control', 'SIMV', 'PC-SIMV', 'PS', 'DuoPAP', 'PcBiPAP'])],
                'ipl' => rand(10, 25),
                'peep' => rand(5, 15),
                'fio2' => round(rand(21, 100) / 100, 2), // Random FiO2 between 0.21 and 1.00
                'rr' => rand(12, 20),
                'ps' => rand(5, 20),
                'trigger' => rand(1, 5), // Asumsi flow trigger, jika pressure bisa -1 sampai -5
            ]);

            // Tentukan jenis intubasi secara acak
            $intubationType = ['ETT', 'TC'][rand(0, 1)];

            $ettDiameter = null;
            $ettDepth = null;
            $tcDiameter = null;
            $tcType = null;

            if ($intubationType === 'ETT') {
                $ettDiameter = rand(60, 90); 
                $ettDepth = rand(18, 24);
            } else { // TC
                $tcDiameter = rand(70, 100);
                $tcType = ['Cuffed', 'Uncuffed', 'Fenestrated'][array_rand(['Cuffed', 'Uncuffed', 'Fenestrated'])];
            }

            // Buat Intubation
            $intubation = Intubation::create([
                'patient_id' => $patient->id,
                'user_id' => $randomUserId,
                'ventilator_id' => $ventilator->id,
                'ttv_pre_id' => $ttv->id, // Perlu dipastikan TTV ini relevan untuk pre-intubasi/prosedur
                'ttv_post_id' => $ttv->id, // Perlu dipastikan TTV ini relevan untuk post-intubasi/prosedur
                'intubation_type' => $intubationType, // Tambahkan ini
                'ett_diameter' => $ettDiameter,
                'ett_depth' => $ettDepth,
                'tc_diameter' => $tcDiameter,
                'tc_type' => $tcType,
                'pre_intubation' => 'Pasien stabil sebelum prosedur.',
                'post_intubation' => 'Prosedur berhasil, pasien terpasang ' . $intubationType . '.',
                'intubation_datetime' => now(),
                'intubation_location' => ['IGD', 'ICU', 'OK'][array_rand(['IGD', 'ICU', 'OK'])],
                'dr_intubation' => 'Dr. ' . Str::random(5), // Nama dokter random
                'dr_consultant' => 'Dr. ' . Str::random(5), // Nama dokter konsulan random
            ]);

            // Buat Origin Room
            $originRoom = OriginRoom::create([
                'user_id' => $randomUserId,
                'origin_room_name' => ['IGD', 'Bangsal', 'Ruang Operasi'][array_rand(['IGD', 'Bangsal', 'Ruang Operasi'])],
                'radiology' => ['X-Ray', 'CT Scan', 'MRI'][array_rand(['X-Ray', 'CT Scan', 'MRI'])],
                'physical_check' => 'Normal',
                'ews' => rand(0, 7),
                'natrium' => rand(135, 145),
                'kalium' => round(rand(35, 50) / 10, 1),
                'gds' => rand(80, 120),
                'additional_check' => 'Tidak ada',
                'main_diagnose' => ['Pneumonia', 'CHF', 'ARDS', 'Sepsis'][array_rand(['Pneumonia', 'CHF', 'ARDS', 'Sepsis'])],
                'secondary_diagnose' => ['Bronchitis', 'Diabetes', 'Hipertensi', 'Tidak ada'][array_rand(['Bronchitis', 'Diabetes', 'Hipertensi', 'Tidak ada'])],
                'intubation_id' => $intubation->id,
                'labresult_id' => $labResult->id,
                'agd_id' => $agd->id,
                'patient_id' => $patient->id,
            ]);

            // Buat ICU Room
            $icuRoom = IcuRoom::create([
                'user_id' => $randomUserId,
                'icu_room_datetime' => now(),
                'icu_room_name' => 'ICU',
                'icu_room_bednum' => rand(1, 10),
                'ro' => 'Normal',
                'ro_post_intubation' => 'Improved',
                'blood_culture' => ['Positive', 'Negative'][rand(0,1)],
                'sputum_color' => 'Kuning',
                'lab_tests_sent' => 'test lab',
                'labresult_id' => $labResult->id,
                'elektrolit_id' => $elektrolit->id,
                'ventilator_id' => $ventilator->id,
                'agd_id' => $agd->id,
                'ttv_id' => $ttv->id,
                'patient_id' => $patient->id,
            ]);
        }
    }
}