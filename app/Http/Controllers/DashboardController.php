<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\IcuRoom;
use App\Models\Extubation;
use App\Models\OriginRoom;
use App\Models\TransferRoom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = Patient::with(['icuRoom', 'extubation', 'originRoom', 'transferRoom'])
                ->select(['id', 'name', 'no_jkn', 'updated_at']);

            return DataTables::of($patients)
                ->addColumn('status', function ($patient) {
                    if ($patient->extubation && $patient->extubation->patient_status) {
                        return $patient->extubation->patient_status;
                    } elseif ($patient->icuRoom) {
                        return 'Sedang Intubasi';
                    } else {
                        return 'Belum Intubasi';
                    }
                })
                ->addColumn('room', function ($patient) {
                    return $patient->originRoom->origin_room_name ??
                        $patient->icuRoom->icu_room_name ??
                        $patient->transferRoom->transfer_room_name ?? '-';
                })
                ->addColumn('room_date', function ($patient) {
                    return $patient->originRoom->origin_room_datetime ??
                        $patient->icuRoom->icu_room_datetime ??
                        $patient->transferRoom->transfer_room_datetime ?? '-';
                })
                ->addColumn('updated_time', function ($patient) {
                    return $patient->updated_at ? $patient->updated_at->format('Y-m-d H:i:s') : '-';
                })
                ->addColumn('action', function ($patient) {
                    return '
                        <a href="'.route('patients.show', $patient->id).'" style="background-color: #3490dc; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
                            Detail
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard');
    }



    public function getPatients()
    {
        $patients = Patient::with([
            'icuRoom', 'extubation', 'originRoom', 'transferRoom'
        ])->get()->map(function ($patient, $index) {
            $status = 'Belum Intubasi';
            if ($patient->icuRoom) {
                $status = 'Sedang Intubasi';
            }
            if ($patient->extubation) {
                $status = $patient->extubation->patient_status;
            }

            $room = $patient->originRoom->origin_room_name ?? 
                    $patient->icuRoom->icu_room_name ?? 
                    $patient->transferRoom->transfer_room_name ?? '-';
            
            $roomDate = $patient->originRoom->origin_room_datetime ??
                        $patient->icuRoom->icu_room_datetime ?? 
                        $patient->transferRoom->transfer_room_datetime ?? '-';

            $lastUpdated = max([
                $patient->updated_at,
                $patient->icuRoom->updated_at ?? null,
                $patient->extubation->updated_at ?? null,
                $patient->originRoom->updated_at ?? null,
                $patient->transferRoom->updated_at ?? null,
            ]);

            return [
                'no' => $index + 1,
                'no_jkn' => $patient->no_jkn,
                'name' => $patient->name,
                'status' => $status,
                'room' => $room,
                'room_date' => $roomDate,
                'updated_time' => $lastUpdated ? $lastUpdated->format('Y-m-d H:i:s') : '-',
                'action' => view('dashboard.partials.patient_action', compact('patient'))->render(),
            ];
        });

        return response()->json(['data' => $patients]);
    }

}
