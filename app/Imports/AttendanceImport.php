<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class AttendanceImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
     * @param Collection $collection
     */

    public function model(array $row){
    //   dd($row);
        $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']));
        $time_in = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['time_in']));
        $max_time_in = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['max_time_in']));
        $status = $time_in->gt($max_time_in) ? 'late' : 'present';


        $user = User::updateOrCreate(['employee_id' => $row['employee_no']], 
        [
            'name' => $row['employee_name'],
            'username' => $row['employee_no'],
            'email' => "{$row['employee_no']}@example.com",
            'password' => bcrypt($row['employee_no']),
        ]);

        return Attendance::updateOrCreate([
            'user_id' => $user->id,
            'date' => $date->format('Y-m-d'),
        ],[
            'time_in' => $time_in->format('H:i:s'),
            'max_time_in' => $max_time_in->format('H:i:s'),
            'status' => $status,
        ]);

    }

    public function rules(): array
    {
        return [
            'employee_name' => 'required',
            'date' => 'required',
            'time_in' => 'required',
            'max_time_in' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'employee_name.required' => 'Name is required',
            'date.required' => 'Date is required|date_format:Y-m-d',
            'time_in.required' => 'Time in is required|date_format:H:i:s',
            'max_time_in.required' => 'Max time is required|date_format:H:i:s',
        ];
    }

    public function headingRow(): int
    {
        return 5;
    }
}
