<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\MipoSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Setting\MipoSettingRequest;

class MipoSettingControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = MipoSetting::latest();
        if($request->ajax()){
            return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', 'admin.setting.mipo.action')
            ->rawColumns(['action'])
            ->make(true);
        }

        return view ('admin.setting.mipo.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MipoSettingRequest $request)
    {
        MipoSetting::updateOrCreate(['id' => $request->id], $request->validated());

        return response()->json([
            'message' => 'Data saved successfully',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MipoSetting::findOrFail($id);
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MipoSetting::destroy($id);
        return response()->json([
            'message' => 'Data deleted successfully',
        ]);
    }
}
