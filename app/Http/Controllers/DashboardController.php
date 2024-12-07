<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Intubation;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


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

        if ($user->role === 'user') {
            $patients = Patient::with(['icuRoom', 'intubation', 'extubation', 'originRoom', 'transferRoom'])
                ->where('user_id', $user->id) 
                ->select(['id', 'name', 'no_jkn', 'updated_at'])
                ->get();
        } else {
            $patients = Patient::with(['icuRoom', 'extubation', 'originRoom', 'transferRoom', 'user.user_detail']) 
                ->select(['id', 'name', 'no_jkn', 'user_id', 'updated_at'])
                ->get()
                ->map(function ($patients) {
                    $patients->hospital = $patients->user ? $patients->user->user_detail->name : 'No Hospital';
                    return $patients;
                });
        }
        
        if ($request->ajax()) {
            return DataTables::of($patients)
                ->addColumn('hospital', function ($patient) {
                    return $patient->hospital;
                })
                ->addColumn('status', function ($patient) {
                    if ($patient->extubation && $patient->extubation->patient_status) {
                        return $patient->extubation->patient_status;
                    } elseif ($patient->intubation) {
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
            $hospitals = UserDetail::where('id', '!=', 1)->get();

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
        return view('dashboard', compact('intubatedCount','user'));
    }

    public function showDetails(Request $request, $id)
    {
        $hospital = UserDetail::findOrFail($id);
        $users = User::where('hospital_id', $id)->where('role', 'user')->get();

        $intubatedCount = Intubation::whereIn('user_id', $users->pluck('id'))
            ->whereNotIn('patient_id', function ($query) {
                $query->select('patient_id')->from('extubations');
            })
            ->count();

        $totalPatientsThisMonth = Patient::whereIn('user_id', $users->pluck('id'))
            ->whereMonth('created_at', now()->month)
            ->count();

        $patients = Patient::whereIn('user_id', $users->pluck('id'))
            ->with(['icuRoom', 'extubation', 'originRoom', 'transferRoom'])
            ->get();

        // dd($patients->icuRoom->icu_room_name);
            
            
            if ($request->ajax()) {
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
        

        return view('admin.hospital.details', compact(
            'hospital', 
            'intubatedCount', 
            'totalPatientsThisMonth'
        ));
    }


}
