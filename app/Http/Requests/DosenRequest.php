<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DosenRequest extends FormRequest
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
        $dosenId = $this->route('dosen_id'); // Untuk validasi update
        return [
            'pegawai_id' => 'required|exists:pegawais,id',
            // 'nomor_dosen' => 'required|string|max:50|unique:pegawai_dosens,nomor_dosen,' . $pegawaiDosenId,
            'nomor_dosen' => 'required|string|max:50|unique:dosens,nomor_dosen,' . $dosenId,
            'dosen_kategori' => 'required|string|in:tetap,honorer',
        ];
    }

    public function messages()
    {
        return [
            'pegawai_id.required' => 'Pegawai wajib dipilih.',
            'pegawai_id.exists' => 'Pegawai tidak valid.',
            'nomor_dosen.required' => 'Nomor dosen wajib diisi.',
            'nomor_dosen.max' => 'Nomor dosen maksimal 50 karakter.',
            'nomor_dosen.unique' => 'Nomor dosen sudah terdaftar.',
            'dosen_kategori.required' => 'Kategori dosen wajib diisi.',
            'dosen_kategori.in' => 'Kategori dosen harus tetap atau honorer.',
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
