<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuggestionSystem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\SuggestionSystemRequest;

class SuggestionSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dates = $request->date ? explode(' - ', $request->date) : [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')];
        $data = SuggestionSystem::with('pengaju', 'evaluator')
        ->when($request->date, function ($query, $dates) {
            return $query->whereBetween('date', explode(' - ', $dates));
        })
        ->when($request->user_id, function($query, $user_id){
            return $query->where('user_id', $user_id);
        })
        ->mp()
        ->latest();
        if($request->ajax()){
            return datatables()->eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.employee.suggestion-system.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::all();
        return view('admin.employee.suggestion-system.index', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SuggestionSystemRequest $request)
    {
        $data = SuggestionSystem::updateOrCreate(['id' => $request->id], $request->validated());
        if($request->file_masalah){
            $fileMasalahName = uploadPhoto($request->file_masalah, 'suggestion-system');
            $data->update(['file_masalah' => $fileMasalahName]);
        }

        if($request->file_evaluasi){
            $fileEvaluasiName = uploadPhoto($request->file_evaluasi, 'suggestion-system');
            $data->update(['file_evaluasi' => $fileEvaluasiName]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Suggestion System saved successfully.'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suggestionSystem = SuggestionSystem::with('pengaju')->find($id);
        return response()->json([
            'success' => true,
            'data' => $suggestionSystem
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SuggestionSystem::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Suggestion System deleted successfully.'
        ]);
    }
}
