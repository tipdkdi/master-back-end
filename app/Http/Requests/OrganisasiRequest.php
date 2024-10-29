<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganisasiRequest extends FormRequest
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
            'parent_id' => 'nullable|integer|exists:organisasis,id',
            'organisasi_nama' => 'required|string|max:255',
            'pddikti_kode' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
            'singkatan_sia' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_current' => 'nullable|boolean',
            'is_aktif' => 'nullable|boolean',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
    public function messages()
    {
        return [
            'organisasi_grup_id.required' => 'Organisasi grup ID wajib diisi.',
            'organisasi_grup_id.integer' => 'Organisasi grup ID harus berupa angka.',
            'organisasi_grup_id.exists' => 'Organisasi grup ID tidak valid.',
            'parent_id.integer' => 'Parent ID harus berupa angka.',
            'parent_id.exists' => 'Parent ID tidak valid.',
            'organisasi_nama.required' => 'Nama organisasi wajib diisi.',
            'organisasi_nama.max' => 'Nama organisasi tidak boleh lebih dari 255 karakter.',
            'singkatan.max' => 'Singkatan tidak boleh lebih dari 50 karakter.',
            'singkatan_sia.max' => 'Singkatan SIA tidak boleh lebih dari 50 karakter.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'is_current.boolean' => 'Is Current harus berupa boolean (true/false).',
            'is_aktif.boolean' => 'Is Aktif harus berupa boolean (true/false).',
        ];
    }
}
