<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeMipo;
use App\Models\User;

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
            ->mp()
            ->get();

            $attendanceResult = [];
            foreach ($attendance as $key => $value) {
                $attendanceResult [] = [
                    'month_year' => $value->month_year,
                    'present' => $value->status == 'present' ? $value->total : 0,
                    'late' => $value->status == 'late' ? $value->total : 0,
                    'absent' => $value->status == 'absent' ? $value->total : 0,
                    'skd' => $value->status == 'skd' ? $value->total : 0,
                    'cuti tahunan' => $value->status == 'cuti tahunan' ? $value->total : 0,
                    'cuti istimewa' => $value->status == 'cuti istimewa' ? $value->total : 0,
                    'rawat inap' => $value->status == 'rawat inap' ? $value->total : 0,
                ];
            }

            $attendanceResult = collect($attendanceResult)->groupBy('month_year')->map(function ($item) {
                return [
                    'month_year' => $item->first()['month_year'],
                    'present' => $item->sum('present'),
                    'late' => $item->sum('late'),
                    'absent' => $item->sum('absent'),
                    'skd' => $item->sum('skd'),
                    'cuti tahunan' => $item->sum('cuti tahunan'),
                    'cuti istimewa' => $item->sum('cuti istimewa'),
                    'rawat inap' => $item->sum('rawat inap'),
                ];
            })->values();


            // report mipo
            $baseQueryMipo = User::whereHas('mipo')->with('mipo.mipoSetting')
            ->mp()
            ->get();
            // return $baseQueryMipo;
            $mipoResult = [];
            foreach ($baseQueryMipo as $key => $value) {
                $mipoResult [] = [
                    'name' => $value->name,
                    'value' => abs($value->mipo->sum('mipoSetting.value')),
                ];
            }

            // report suggestion system
            $baseQuerySuggestion = User::whereHas('suggestionSystem')->withCount('suggestionSystem')
            ->mp()
            ->get();
            $suggestionResult = [];
            foreach ($baseQuerySuggestion as $key => $value) {
                $suggestionResult [] = [
                    'name' => $value->name,
                    'value' => $value->suggestion_system_count,
                ];
            }
            

            $compact = compact('attendanceResult', 'mipoResult', 'suggestionResult');
        return view('home', $compact);
    }
}
