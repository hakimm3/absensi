<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MipoSetting;
use App\Models\EmployeeMipo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class EmployeeMipoImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']));
        
        $user = User::firstOrCreate([
            'employee_id' => $row['employee_no'],
        ], [
            'name' => $row['employee_name'],
            'username' => $row['employee_no'],
            'email' => "{$row['employee_no']}@example.com",
            'password' => bcrypt($row['employee_no']),
        ]);

        $mipoSetting = MipoSetting::where('name', $row['jenis'])->first();

        return EmployeeMipo::create([
            'user_id' => $user->id,
            'mipo_setting_id' => $mipoSetting->id,
            'date' => $date->format('Y-m-d'),
            'description' => $row['description'],
        ]);
    }

    public function rules(): array
    {
        return [
            'employee_no' => 'required',
            'employee_name' => 'required',
            'date' => 'required',
            'jenis' => 'required',
            'description' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'employee_no.required' => 'Employee No is required',
            'employee_name.required' => 'Employee Name is required',
            'date.required' => 'Date is required',
            'jenis.required' => 'Jenis is required',
            'description.required' => 'Description is required',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
