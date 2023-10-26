<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dates = $request->date ? explode(' - ', $request->date) : [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')];
        $data = \App\Models\Attendance::query()->with('user')
        ->when($request->date, function ($query, $date) {
            return $query->whereBetween('date', explode(' - ', $date));
        })
        ->when($request->status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->latest();

        if($request->ajax()){
            return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', 'admin.employee.attendance.action')
            ->rawColumns(['action'])
            ->make(true);
        }

        $users = User::all();
        return view('admin.employee.attendance.index', compact('data', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $user = User::where('employee_id', $request->employee_id)->first();
      
        $data = Attendance::updateOrCreate([
            'user_id' => $user->id,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
        ],$request->validated());

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $absen_in = Carbon::parse($request->date . ' ' . $request->time_in);
        $max_absen_in = Carbon::parse($request->date . ' ' . $request->max_time_in);
        inputMipo($date, $absen_in, $max_absen_in, $user->id);

        return response()->json([
            'message' => 'Data saved successfully',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = \App\Models\Attendance::with('user')->findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = \App\Models\Attendance::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Data deleted successfully'
        ]);
    }
}
