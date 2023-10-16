<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $baseQueryAttendance = Attendance::query();
        // group by attendance by month and year and count the attendance by status (present, late, absent)
        $attendance = $baseQueryAttendance->whereYear('date', 2023)->orderBy('date')->selectRaw('DATE_FORMAT(date, "%M %Y") as month_year, status, count(*) as total')
            ->groupBy('month_year', 'status')
            ->orderBy('month_year', 'desc')
            ->get();

            $attendanceResult = [];
            foreach ($attendance as $key => $value) {
                $attendanceResult [] = [
                    'month_year' => $value->month_year,
                    'late' => $value->status == 'late' ? $value->total : 0,
                    'present' => $value->status == 'present' ? $value->total : 0,
                    'absent' => $value->status == 'absent' ? $value->total : 0,
                ];
            }

            $attendanceResult = collect($attendanceResult)->groupBy('month_year')->map(function ($item) {
                return [
                    'month_year' => $item->first()['month_year'],
                    'late' => $item->sum('late'),
                    'present' => $item->sum('present'),
                    'absent' => $item->sum('absent'),
                ];
            })->values();

            $compact = compact('attendanceResult');
        return view('home', $compact);
    }
}
