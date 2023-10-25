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
        $absen_in = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['absen_in']));
        $max_absen_in = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['max_absen_in']));
        $status = $absen_in->gt($max_absen_in) ? 'late' : 'present';


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
            'time_in' => $absen_in->format('H:i:s'),
            'max_time_in' => $max_absen_in->format('H:i:s'),
            'status' => $status,
            'time_out' => $row['absen_out'] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['absen_out']))->format('H:i:s') : null,
            'description' => $row['description'] ?? '',
        ]);

    }

    public function rules(): array
    {
        return [
            'employee_name' => 'required',
            'date' => 'required',
            'absen_in' => 'required',
            'max_absen_in' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'employee_name.required' => 'Name is required',
            'date.required' => 'Date is required|date_format:Y-m-d',
            'absen_in.required' => 'Time in is required|date_format:H:i:s',
            'max_absen_in.required' => 'Max time is required|date_format:H:i:s',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
