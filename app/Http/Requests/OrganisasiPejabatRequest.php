<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganisasiPejabatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'organisasi_id' => 'required|integer|exists:organisasis,id',
            'jabatan_id' => 'required|integer|exists:organisasi_grup_jabatans,id',
            'pegawai_id' => 'required|integer|exists:pegawais,id',
            'jabatan' => 'required|string|max:255',
            'is_aktif' => 'required|boolean',
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'organisasi_id.required' => 'Organisasi ID wajib diisi.',
            'organisasi_id.integer' => 'Organisasi ID harus berupa angka.',
            'organisasi_id.exists' => 'Organisasi ID tidak ditemukan.',
            'jabatan_id.required' => 'Jabatan ID wajib diisi.',
            'jabatan_id.integer' => 'Jabatan ID harus berupa angka.',
            'jabatan_id.exists' => 'Jabatan ID tidak ditemukan.',
            'pegawai_id.required' => 'Pegawai ID wajib diisi.',
            'pegawai_id.integer' => 'Pegawai ID harus berupa angka.',
            'pegawai_id.exists' => 'Pegawai ID tidak ditemukan.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
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
