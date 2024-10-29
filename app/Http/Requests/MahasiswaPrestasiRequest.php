<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaPrestasiRequest extends FormRequest
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
            'jenis_prestasi' => 'required|string|max:255',
            'tingkat_prestasi' => 'required|string|max:255',
            'nama_prestasi' => 'required|string|max:255',
            'tahun_prestasi' => 'required|digits:4|integer',
            'penyelenggara' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'mahasiswa_id.required' => 'Mahasiswa ID harus diisi.',
            'mahasiswa_id.exists' => 'Mahasiswa ID tidak valid.',
            'jenis_prestasi.required' => 'Jenis prestasi harus diisi.',
            'tingkat_prestasi.required' => 'Tingkat prestasi harus diisi.',
            'nama_prestasi.required' => 'Nama prestasi harus diisi.',
            'tahun_prestasi.required' => 'Tahun prestasi harus diisi.',
            'tahun_prestasi.digits' => 'Tahun prestasi harus terdiri dari 4 digit.',
            'penyelenggara.required' => 'Penyelenggara harus diisi.',
        ];
    }
}
