<?php 

namespace App\Support;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function log(string $action, ?string $description = null): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'description' => $description,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
