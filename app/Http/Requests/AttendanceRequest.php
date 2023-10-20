<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'date' => 'required',
            'time_in' => 'required',
            'max_time_in' => 'required',
            'time_out' => 'nullable',
            'status' => 'required',
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'Employee ID is required',
            'date.required' => 'Date is required',
            'time_in.required' => 'Absen In is required',
            'max_time_in.required' => 'Maximal Absen in is required',
            'status.required' => 'Status is required',
        ];
    }
}
