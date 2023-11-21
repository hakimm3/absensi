<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportEmployeeMipoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Excel::import(new \App\Imports\EmployeeMipoImport, $request->file('file'));

        return response()->json([
            'message' => 'Import success',
            'status' => 'success',
        ]);
    }
}
