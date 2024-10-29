<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BiodataRequest extends FormRequest
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
        $biodataId = $this->route('biodata_id');

        return [
            // 'nik' => 'required|string|size:16|unique:biodatas,nik,' . $biodataId,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:l,p',
            'lahir_tempat' => 'required|string|max:255',
            'lahir_tanggal' => 'required|date_format:Y-m-d',
            'no_hp' => 'required|string|max:20',
            'agama' => 'required|string|max:20',
            'alamat_domisili' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.size' => 'NIK harus terdiri dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',

            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus l (laki-laki) atau p (perempuan).',

            'lahir_tempat.required' => 'Tempat lahir wajib diisi.',
            'lahir_tempat.string' => 'Tempat lahir harus berupa teks.',
            'lahir_tempat.max' => 'Tempat lahir maksimal 255 karakter.',

            'lahir_tanggal.required' => 'Tanggal lahir wajib diisi.',
            'lahir_tanggal.date_format' => 'Tanggal lahir harus dalam format Y-m-d (contoh: 2024-01-01).',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',

            'agama.required' => 'Agama wajib diisi.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama maksimal 20 karakter.',

            'alamat_domisili.string' => 'Alamat domisili harus berupa teks.',
        ];
    }
}
