<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Models\User;
use App\Models\MipoSetting;
use App\Models\EmployeeMipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\MinusPoinRequest;
use Yajra\DataTables\Facades\DataTables;

class MinusPoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dates = $request->date ? explode(' - ', $request->date) : [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')];
        $data = EmployeeMipo::with('user', 'mipoSetting')
        ->when($request->date, function ($query, $dates) {
            return $query->whereBetween('date', explode(' - ', $dates));
        })
        ->when($request->user_id, function($query, $user_id){
            return $query->where('user_id', $user_id);
        })
        ->mp()
        ->latest();
        if($request->ajax()){
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('jenis', function($row){
                    return $row->mipoSetting->name ?? '';
                })
                ->addColumn('minus_poin', function($row){
                    return $row->mipoSetting->value ?? '';
                })
                ->addColumn('action', 'admin.employee.mipo.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::all();
        $settings = MipoSetting::all();
        return view('admin.employee.mipo.index', compact('users', 'settings'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MinusPoinRequest $request)
    {
        EmployeeMipo::updateOrCreate(['id' => $request->id], $request->validated());
        return response()->json(['message' => 'Minus poin berhasil disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = EmployeeMipo::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EmployeeMipo::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Minus poin berhasil dihapus']);
    }
}
