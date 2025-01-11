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
                    <a href="'.route('patients.show', $patient->id).'" style="background-color: #3490dc; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
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

            if ($user->role === 'admin') {
                return view('dashboardAdmin', compact('hospitals'));
            }

            $userDet = $user->user_detail_id ;
            $usrHos = UserDetail::where('id', $userDet)->first();
            $ventiRs = $usrHos->venti;
            $isDisabled = $intubatedCount >= $ventiRs;

        return view('dashboard', compact('intubatedCount','user', 'isDisabled'));
    }

    public function showDetails(Request $request, $id)
    {
        $hospital = UserDetail::findOrFail($id);
        $users = User::where('user_detail_id', $id)->where('role', 'user')->first();
        // dd($users->id);  

        $intubatedCount = Intubation::where('user_id', $users->id)
            ->whereNotIn('patient_id', function ($query) {
                $query->select('patient_id')->from('extubations');
            })
            ->count();

        $totalPatientsThisMonth = Patient::where('user_id', $users->id)
            ->whereMonth('created_at', now()->month)
            ->count();

        // $patients = Patient::with(['icuDash', 'extubation', 'originRoom', 'transferRoom'])
        //     ->where('user_id', $users) 
        //     ->get();

        $patients = Patient::with(['icuDash', 'intubation', 'extubation', 'originRoom', 'transferRoom'])
            ->where('user_id', $users->id) 
            ->select(['id', 'name', 'no_jkn', 'updated_at'])
            ->get();
            
            // dd($patients);

            if ($request->ajax()) {
                return DataTables::of($patients)
                    ->addColumn('status', function ($patient) {
                        if ($patient->extubation && $patient->extubation->patient_status) {
                            return $patient->extubation->patient_status;
                        } elseif ($patient->icuDash) {
                            return 'Sedang Intubasi';
                        } else {
                            return 'Belum Intubasi';
                        }
                    })
                    ->addColumn('room', function ($patient) {
                        return $patient->originRoom->origin_room_name ??
                            $patient->icuDash->icu_room_name ??
                            $patient->transferRoom->transfer_room_name ?? '-';
                    })
                    ->addColumn('room_date', function ($patient) {
                        return $patient->originRoom->origin_room_datetime ??
                            $patient->icuDash->icu_room_datetime ??
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
        

        return view('admin.hospital.details', compact(
            'hospital', 
            'intubatedCount', 
            'totalPatientsThisMonth'
        ));
    }


}
