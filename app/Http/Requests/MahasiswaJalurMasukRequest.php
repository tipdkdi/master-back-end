<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MahasiswaJalurMasukRequest extends FormRequest
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
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jalur_pendaftaran' => 'required|string|max:255',
            'jenis_pendaftaran' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tahun_akademik_id' => 'required|exists:tahun_akademiks,id',
            'pembiayaan_awal' => 'required|string|max:255',
            'biaya_masuk' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'mahasiswa_id.required' => 'Mahasiswa ID wajib diisi.',
            'mahasiswa_id.exists' => 'Mahasiswa ID tidak ditemukan di tabel mahasiswas.',
            'mahasiswa_id.unique' => 'Mahasiswa ini sudah memiliki jalur masuk yang terdaftar.',

            'jalur_pendaftaran.required' => 'Jalur pendaftaran wajib diisi.',
            'jalur_pendaftaran.string' => 'Jalur pendaftaran harus berupa teks.',
            'jalur_pendaftaran.max' => 'Jalur pendaftaran maksimal 255 karakter.',

            'jenis_pendaftaran.required' => 'Jenis pendaftaran wajib diisi.',
            'jenis_pendaftaran.string' => 'Jenis pendaftaran harus berupa teks.',
            'jenis_pendaftaran.max' => 'Jenis pendaftaran maksimal 255 karakter.',

            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date' => 'Tanggal masuk harus berupa tanggal yang valid.',

            'periode_pendaftaran.required' => 'Periode pendaftaran wajib diisi.',
            'periode_pendaftaran.string' => 'Periode pendaftaran harus berupa teks.',
            'periode_pendaftaran.max' => 'Periode pendaftaran maksimal 255 karakter.',

            'pembiayaan_awal.required' => 'Pembiayaan awal wajib diisi.',
            'pembiayaan_awal.string' => 'Pembiayaan awal harus berupa teks.',
            'pembiayaan_awal.max' => 'Pembiayaan awal maksimal 255 karakter.',

            'biaya_masuk.required' => 'Biaya masuk wajib diisi.',
            'biaya_masuk.string' => 'Biaya masuk harus berupa teks.',
            'biaya_masuk.max' => 'Biaya masuk maksimal 255 karakter.',
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
