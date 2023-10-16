<?php

namespace App\Http\Controllers\Admin\Attendance;

use Illuminate\Http\Request;
use App\Imports\AttendanceImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportAttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Excel::import(new AttendanceImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }
}
