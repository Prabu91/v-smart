<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $logs = ActivityLog::latest()->paginate(10);
        return view('logs.index', compact('logs'));
    }
}
