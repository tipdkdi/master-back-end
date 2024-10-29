<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganisasiGrupRequest extends FormRequest
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
            'grup_nama' => 'required|string|max:255',
            'grup_singkatan' => 'required|string|max:50',
            'grup_flag' => 'required|string',
            'pimpinan_sebutan' => 'nullable|string|max:255',
            'grup_keterangan' => 'nullable|string|max:500',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
    public function messages(): array
    {
        return [
            'grup_nama.required' => 'Nama grup harus diisi.',
            'grup_nama.string' => 'Nama grup harus berupa string.',
            'grup_nama.max' => 'Nama grup tidak boleh lebih dari 255 karakter.',
            'grup_singkatan.required' => 'Singkatan grup harus diisi.',
            'grup_singkatan.string' => 'Singkatan grup harus berupa string.',
            'grup_singkatan.max' => 'Singkatan grup tidak boleh lebih dari 50 karakter.',
            'grup_flag.required' => 'Flag grup harus diisi.',
            'grup_flag.boolean' => 'Flag grup harus berupa boolean.',
            'pimpinan_sebutan.string' => 'Sebutan pimpinan harus berupa string.',
            'pimpinan_sebutan.max' => 'Sebutan pimpinan tidak boleh lebih dari 255 karakter.',
            'grup_keterangan.string' => 'Keterangan grup harus berupa string.',
            'grup_keterangan.max' => 'Keterangan grup tidak boleh lebih dari 500 karakter.',
        ];
    }
}
