<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GrupJabatanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organisasi_grup_id' => 'required|integer|exists:organisasi_grups,id',
            'jabatan' => 'required|string|max:255',
            'flag' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer|min:1',
            'keterangan' => 'nullable|string',
            'is_aktif' => 'required|boolean',
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'organisasi_grup_id.required' => 'Organisasi grup ID wajib diisi.',
            'organisasi_grup_id.integer' => 'Organisasi grup ID harus berupa angka.',
            'organisasi_grup_id.exists' => 'Organisasi grup ID tidak ditemukan.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'flag.max' => 'Flag tidak boleh lebih dari 50 karakter.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan harus lebih besar atau sama dengan 1.',
            'is_aktif.required' => 'Status aktif wajib diisi.',
            'is_aktif.boolean' => 'Status aktif harus berupa true atau false.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
