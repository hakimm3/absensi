<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class SuggestionSystemRequest extends FormRequest
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
            'pengaju_id' => ['required', 'integer'],
            'evaluator_id' => ['nullable', 'integer'],
            'tanggal_pengajuan' => ['required', 'date'],
            'tema' => ['required', 'string'],
            'kategori' => ['required', 'string'],
            'text_masalah' => ['required', 'string'],
            'file_masalah' => ['nullable'],
            'analisa' => ['required', 'string'],
            'perbaikan' => ['required', 'string'],
            'text_evaluasi' => ['nullable', 'string'],
            'file_evaluasi' => ['nullable', 'string'],
        ];
    }
}
