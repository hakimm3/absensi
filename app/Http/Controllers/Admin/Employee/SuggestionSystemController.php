<?php

namespace App\Http\Controllers\Admin\Employee;

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
        if($request->ajax()){
            $data = SuggestionSystem::with('user')->latest();
            return datatables()->eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.employee.suggestion-system.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employee.suggestion-system.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SuggestionSystemRequest $request)
    {
        SuggestionSystem::updateOrCreate(['id' => $request->id], $request->validated());
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
        $suggestionSystem = SuggestionSystem::find($id);
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
