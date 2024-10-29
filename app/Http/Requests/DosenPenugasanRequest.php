<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DosenPenugasanRequest extends FormRequest
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
            'dosen_id' => 'required|exists:dosens,id',
            'tahun_ajar' => 'required|string|max:10',
            'prodi' => 'required|exists:organisasis,id',
            'surat_tugas_nomor' => 'required|string|max:255',
            'surat_tugas_tanggal' => 'required|date_format:Y-m-d',
            'surat_tugas_tmt' => 'required|date_format:Y-m-d',
            'surat_tugas_file' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'dosen_id.required' => 'Dosen wajib dipilih.',
            'dosen_id.exists' => 'Dosen tidak valid.',
            'tahun_ajar.required' => 'Tahun ajar wajib diisi.',
            'tahun_ajar.max' => 'Tahun ajar maksimal 10 karakter.',
            'prodi.required' => 'Program studi wajib diisi.',
            'prodi.max' => 'Program studi maksimal 255 karakter.',
            'surat_tugas_nomor.required' => 'Nomor surat tugas wajib diisi.',
            'surat_tugas_tanggal.required' => 'Tanggal surat tugas wajib diisi.',
            'surat_tugas_tanggal.date_format' => 'Tanggal surat tugas harus dalam format Y-m-d.',
            'surat_tugas_tmt.required' => 'Tanggal mulai tugas wajib diisi.',
            'surat_tugas_tmt.date_format' => 'Tanggal mulai tugas harus dalam format Y-m-d.',
            'surat_tugas_file.mimes' => 'File surat tugas harus berupa PDF, JPG, JPEG, atau PNG.',
            'surat_tugas_file.max' => 'Ukuran file maksimal 2 MB.',
            'is_current.required' => 'Status current wajib diisi.',
            'is_current.boolean' => 'Nilai status current harus berupa true atau false.',
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
