<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Intubation;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Ventilator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $intubatedCount = Intubation::whereIn('user_id', $user)
            ->whereNotIn('patient_id', function ($query) {
                $query->select('patient_id')->from('extubations');
            })
            ->count();
        
        // Tambahkan case-when untuk status
        $patientsQuery = Patient::select([
            'patients.*',
            DB::raw("
                CASE 
                    WHEN extubations.patient_status IS NOT NULL THEN 2
                    WHEN intubations.id IS NOT NULL THEN 1
                    ELSE 0
                END AS status_priority
            ")
        ])
        ->leftJoin('intubations', 'patients.id', '=', 'intubations.patient_id')
        ->leftJoin('extubations', 'patients.id', '=', 'extubations.patient_id')
        ->when($request->year, function ($query) use ($request) {
            $query->whereYear('patients.created_at', $request->year);
        })
        ->take(100);

        // Tambahkan pengurutan berdasarkan status_priority dan updated_at
        $patientsQuery->orderBy('status_priority', 'asc')->orderBy('updated_at', 'desc');

        // Eksekusi query
        $patients = $patientsQuery->get();
            
        if ($user->role === 'user') {
            $patientsQuery->where('patients.user_id', $user->id);
        }
        
        if ($request->ajax()) {
            return DataTables::of($patientsQuery)
                ->addColumn('hospital', function ($patient) use ($user) {
                    return $user->role === 'user' ? null : ($patient->user->userDetails->hospital ?? '-');
                })
                ->addColumn('status', function ($patient) {
                    if ($patient->extubation && $patient->extubation->patient_status) {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #FFC107; background-color: #FFF7D1; color: #FFC107; border-radius: 5px;">' 
                                . $patient->extubation->patient_status . 
                            '</span>';
                    } elseif ($patient->intubation) {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #4CAF50; background-color: #DFFFD6; color: #4CAF50; border-radius: 5px;">Sedang Intubasi</span>';
                    } else {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #F44336; background-color: #FFEBEE; color: #F44336; border-radius: 5px;">Belum Intubasi</span>';
                    }
                })
                ->addColumn('room', function ($patient) {
                    return $patient->originRoom->origin_room_name ??
                    $patient->icuDash->icu_room_name ??
                    $patient->transferRoom->transfer_room_name ?? '-';
                })
                ->addColumn('room_date', function ($patient) {
                    return $patient->icuDash && $patient->icuDash->icu_room_datetime ? Carbon::parse($patient->icuDash->icu_room_datetime)->format('H:i d/m/Y') : '-';
                })
                ->addColumn('updated_time', function ($patient) {
                    return $patient->updated_at ? $patient->updated_at->format('H:i d/m/Y') : '-';
                })
                ->addColumn('action', function ($patient) { 
                    return '
                    <a href="'.route('patients.show', $patient->id).'" 
                        style="background-color: #2f4157; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; 
                        transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor=\'#577c8e\'" 
                        onmouseout="this.style.backgroundColor=\'#2f4157\'">
                        Detail
                    </a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        
        
            $hospitals = UserDetail::where('hospital', '!=', 'KC Soreang')->get();

            $hospitalData = $hospitals->map(function ($hospital) {
                // Get the users associated with this hospital
                $users = User::where('user_detail_id', $hospital->id)->get();
                
                // Count the number of intubated patients in the hospital via users
                $intubatedCount = Intubation::whereIn('user_id', $users->pluck('id'))
                ->whereNotIn('patient_id', function ($query) {
                    $query->select('patient_id')->from('extubations');
                })
                ->count();

                // Get the number of ventilators for this hospital
                $ventilatorsCount = $hospital->venti;

                // Add the required information for each hospital
                $hospital->intubated_count = $intubatedCount;
                $hospital->ventilators_count = $ventilatorsCount;

                return $hospital;
            });

            $userDet = $user->user_detail_id ;
            $usrHos = UserDetail::where('id', $userDet)->first();
            $ventiRs = $usrHos->venti;
            $isDisabled = $intubatedCount >= $ventiRs;

        return view('dashboard', compact('intubatedCount','user', 'isDisabled', 'hospitals'));
    }

    public function showDetails(Request $request, $id)
    {
        $hospital = UserDetail::findOrFail($id);
        $users = User::where('user_detail_id', $id)->where('role', 'user')->first();

        $intubatedCount = Intubation::where('user_id', $users->id)
            ->whereNotIn('patient_id', function ($query) {
                $query->select('patient_id')->from('extubations');
            })
            ->count();

        $totalPatientsThisMonth = Patient::where('user_id', $users->id)
            ->whereMonth('created_at', now()->month)
            ->count();

        $patientsQuery = Patient::select([
                'patients.id',
                'patients.name',
                'patients.no_jkn',
                'patients.updated_at',
            ])
            ->selectRaw("
                CASE 
                    WHEN extubations.patient_status IS NOT NULL THEN 2
                    WHEN intubations.id IS NOT NULL THEN 1
                    ELSE 0
                END AS status_priority
            ")
            ->leftJoin('intubations', 'patients.id', '=', 'intubations.patient_id')
            ->leftJoin('extubations', 'patients.id', '=', 'extubations.patient_id')
            ->where('patients.user_id', $users->id) 
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear('patients.created_at', $request->year);
            })
            ->orderBy('status_priority', 'asc')  
            ->orderBy('patients.updated_at', 'desc') 
            ->take(100);
        
        if ($request->ajax()) {
            return DataTables::of($patientsQuery)
                ->addColumn('status', function ($patient) {
                    if ($patient->extubation && $patient->extubation->patient_status) {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #FFC107; background-color: #FFF7D1; color: #FFC107; border-radius: 5px;">' 
                                . $patient->extubation->patient_status . 
                            '</span>';
                    } elseif ($patient->intubation) {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #4CAF50; background-color: #DFFFD6; color: #4CAF50; border-radius: 5px;">Sedang Intubasi</span>';
                    } else {
                        return '<span style="display: inline-block; padding: 5px 10px; border: 1px solid #F44336; background-color: #FFEBEE; color: #F44336; border-radius: 5px;">Belum Intubasi</span>';
                    }
                })
                ->addColumn('room', function ($patient) {
                    return $patient->originRoom->origin_room_name ??
                        $patient->icuDash->icu_room_name ??
                        $patient->transferRoom->transfer_room_name ?? '-';
                })
                ->addColumn('room_date', function ($patient) {
                    return $patient->icuDash && $patient->icuDash->icu_room_datetime ? Carbon::parse($patient->icuDash->icu_room_datetime)->format('H:i d/m/Y') : '-';
                })
                ->addColumn('updated_time', function ($patient) {
                    return $patient->updated_at ? $patient->updated_at->format('H:i:s d/m/Y') : '-';
                })
                ->addColumn('action', function ($patient) {
                    return '
                        <a href="'.route('patients.show', $patient->id).'" style="background-color: #2f4157; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; 
                        transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor=\'#577c8e\'" 
                        onmouseout="this.style.backgroundColor=\'#2f4157\'">
                            Detail
                        </a>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        
        return view('admin.hospital.details', compact(
            'hospital', 
            'intubatedCount', 
            'totalPatientsThisMonth'
        ));
    }


}
