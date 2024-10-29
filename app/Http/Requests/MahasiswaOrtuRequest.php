<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MahasiswaOrtuRequest extends FormRequest
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

            // Ayah data
            'ayah_nik' => 'required|string|max:20',
            'ayah_nama' => 'required|string|max:100',
            'ayah_tgl_lahir' => 'nullable|date',
            'pekerjaan_ayah_id' => 'required|exists:master_pekerjaans,id',
            'pendapatan_ayah_id' => 'required|exists:master_pendapatans,id',

            // Ibu data
            'ibu_nik' => 'required|string|max:20',
            'ibu_nama' => 'required|string|max:100',
            'ibu_tgl_lahir' => 'required|date',
            'pekerjaan_ibu_id' => 'required|exists:master_pekerjaans,id',
            'pendapatan_ibu_id' => 'required|exists:master_pendapatans,id',

            // Kontak dan alamat
            'hp_ortu' => 'required|string|max:15',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string|max:255',
            'kecamatan_id' => 'required|string|max:10',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
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
            'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists' => 'Mahasiswa yang dipilih tidak valid.',

            // Ayah
            'ayah_nik.required' => 'NIK Ayah wajib diisi.',
            'ayah_nama.required' => 'Nama Ayah wajib diisi.',
            'ayah_tgl_lahir.date' => 'Tanggal lahir Ayah harus berupa tanggal yang valid.',
            'pekerjaan_ayah_id.required' => 'Pekerjaan Ayah wajib dipilih.',
            'pekerjaan_ayah_id.exists' => 'Pekerjaan Ayah tidak valid.',
            'pendapatan_ayah_id.required' => 'Pendapatan Ayah wajib dipilih.',
            'pendapatan_ayah_id.exists' => 'Pendapatan Ayah tidak valid.',

            // Ibu
            'ibu_nik.required' => 'NIK Ibu wajib diisi.',
            'ibu_nama.required' => 'Nama Ibu wajib diisi.',
            'ibu_tgl_lahir.required' => 'Tanggal lahir Ibu wajib diisi.',
            'ibu_tgl_lahir.date' => 'Tanggal lahir Ibu harus berupa tanggal yang valid.',
            'pekerjaan_ibu_id.required' => 'Pekerjaan Ibu wajib dipilih.',
            'pekerjaan_ibu_id.exists' => 'Pekerjaan Ibu tidak valid.',
            'pendapatan_ibu_id.required' => 'Pendapatan Ibu wajib dipilih.',
            'pendapatan_ibu_id.exists' => 'Pendapatan Ibu tidak valid.',

            // Kontak dan Alamat
            'hp_ortu.required' => 'Nomor telepon orang tua wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'kecamatan_id.required' => 'Kecamatan ID wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kabupaten.required' => 'Kabupaten wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
        ];
    }
}
