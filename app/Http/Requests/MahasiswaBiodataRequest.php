<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Mahasiswa;

class MahasiswaBiodataRequest extends FormRequest
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
        // Mengambil ID mahasiswa dari parameter route
        $mahasiswaId = $this->route('mahasiswa_id'); // Pastikan nama ini sesuai dengan route

        // Aturan untuk Mahasiswa
        $mahasiswaRules = [
            'iddata' => 'required|string|max:50',
            'nisn' => 'required|string|max:20|unique:mahasiswas,nisn,' . $mahasiswaId,
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswaId,
            'prodi_id' => 'required|exists:organisasis,id',
            'is_luar_negeri' => 'boolean',
        ];

        // Aturan untuk Biodata
        $biodataRules = (new BiodataRequest())->rules();
        $biodataRules['nik'] = 'required|string|size:16|unique:biodatas,nik,' . $this->getBiodataId($mahasiswaId);

        // Gabungkan aturan
        return array_merge($mahasiswaRules, $biodataRules);
    }
    protected function getBiodataId($mahasiswaId)
    {
        // Ambil biodata_id dari mahasiswa berdasarkan mahasiswa_id
        $mahasiswa = Mahasiswa::find($mahasiswaId);
        return $mahasiswa ? $mahasiswa->biodata_id : null;
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
        $message = [
            'iddata.required' => 'ID data wajib diisi.',
            'iddata.string' => 'ID data harus berupa teks.',
            'iddata.max' => 'ID data maksimal 50 karakter.',

            'nisn.required' => 'NISN wajib diisi.',
            'nisn.string' => 'NISN harus berupa teks.',
            'nisn.max' => 'NISN maksimal 20 karakter.',
            'nisn.unique' => 'NISN sudah terdaftar, gunakan NISN lain.',

            'nim.required' => 'NIM wajib diisi.',
            'nim.string' => 'NIM harus berupa teks.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nim.unique' => 'NIM sudah terdaftar, gunakan NIM lain.',

            'biodata_id.required' => 'ID biodata wajib diisi.',
            'biodata_id.exists' => 'ID biodata tidak ditemukan dalam data yang ada.',

            'prodi_id.required' => 'ID program studi wajib diisi.',
            'prodi_id.exists' => 'ID program studi tidak ditemukan dalam data yang ada.',

            'is_luar_negeri.boolean' => 'Is Luar Negeri harus berupa true atau false.',
        ];
        return array_merge(
            $message,
            (new BiodataRequest)->messages()
        );
    }
}
