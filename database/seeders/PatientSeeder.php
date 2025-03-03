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
                    'sbpt' => 0,
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
                ]);

                // Buat Ventilator
                $ventilator = Ventilator::create([
                    'patient_id' => $patient->id,
                    'user_id' => $randomUserId,
                    'venti_datetime' => now(),
                    'venti_usagetime' => now()->addHours(10),
                    'mode_venti' => 'Assist-Control',
                    'ipl' => 20,
                    'peep' => 5,
                    'fio2' => 0.5,
                    'rr' => rand(12, 18),
                ]);
    
                // Buat Intubation
                $intubation = Intubation::create([
                    'patient_id' => $patient->id,
                    'user_id' => $randomUserId,
                    'ventilator_id' => $ventilator->id,
                    'ttv_pre_id' => $ttv->id,
                    'ttv_post_id' => $ttv->id,
                    'diameter' => 8.0,
                    'depth' => 22.0,
                    'pre_intubation' => 'Stable',
                    'post_intubation' => 'Improved',
                    'intubation_datetime' => now(),
                    'intubation_location' => 'ICU Room',
                    'dr_intubation' => 'Dr. Smith',
                    'dr_consultant' => 'Dr. Taylor',
                ]);

                // Buat Origin Room
                $originRoom = OriginRoom::create([
                    'user_id' => $randomUserId,
                    'origin_room_name' => 'ICU',
                    'radiology' => 'X-Ray',
                    'physical_check' => 'Normal',
                    'ews' => 5,
                    'natrium' => 138,
                    'kalium' => 4.1,
                    'gds' => 100,
                    'additional_check' => 'No additional check',
                    'main_diagnose' => 'Pneumonia',
                    'secondary_diagnose' => 'Bronchitis',
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
                    'blood_culture' => 'Negative',
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

