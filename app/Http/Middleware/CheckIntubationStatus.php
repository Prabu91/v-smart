<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserDetail;
use App\Models\Intubation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckIntubationStatus
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 'user') {
            $userDet = $user->user_detail_id;
            $usrHos = UserDetail::where('id', $userDet)->first();
            $ventiRs = $usrHos->venti ?? 0;

            $intubatedCount = Intubation::whereIn('user_id', User::where('user_detail_id', $userDet)->pluck('id'))
                ->whereNotIn('patient_id', function ($query) {
                    $query->select('patient_id')->from('extubations');
                })
                ->count();

            $isDisabled = $intubatedCount >= $ventiRs;

            // Share variable globally
            view()->share('isDisabled', $isDisabled);
        } else {
            view()->share('isDisabled', false);
        }

        return $next($request);
    }
}
