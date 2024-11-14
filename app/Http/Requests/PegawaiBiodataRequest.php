<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Pegawai;

class PegawaiBiodataRequest extends FormRequest
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
        // Mengambil ID pegawai dari parameter route
        $pegawaiId = $this->route('pegawai_id'); // Pastikan nama ini sesuai dengan route

        // Aturan untuk Mahasiswa
        $pegawaiRules = [
            'idpeg' => 'nullable|string|max:50',
            'pegawai_nomor_induk' => 'required|string|max:20|unique:pegawais,pegawai_nomor_induk,' . $pegawaiId,
            'status_asn_id' => 'required|exists:pegawai_status_asns,id', // Jika Anda memiliki tabel statuses
            'kategori_id' => 'required|exists:pegawai_kategoris,id', // Jika Anda memiliki tabel kategoris
            'is_dosen' => 'required|boolean',

            'pegawai_id' => 'required',
            'master_jafung_id' => 'required',
            'jabatan' => 'required|string|max:50',
            'pangkat' => 'required|string|max:50',
            'golongan' => 'required|string|max:50',
            'is_current' => 'required|boolean',
        ];

        // Aturan untuk Biodata
        $biodataRules = (new BiodataRequest())->rules();
        $biodataRules['nik'] = 'required|string|size:16|unique:biodatas,nik,' . $this->getBiodataId($pegawaiId);
        // Gabungkan aturan
        return array_merge($pegawaiRules, $biodataRules);
    }
    protected function getBiodataId($pegawaiId)
    {
        // Ambil biodata_id dari mahasiswa berdasarkan mahasiswa_id
        $pegawai = Pegawai::find($pegawaiId);
        return $pegawai ? $pegawai->biodata_id : null;
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
            'idpeg.required' => 'ID pegawai harus diisi.',
            'idpeg.string' => 'ID pegawai harus berupa string.',
            'idpeg.max' => 'ID pegawai maksimal :max karakter.',

            'pegawai_nomor_induk.required' => 'Nomor induk pegawai harus diisi.',
            'pegawai_nomor_induk.string' => 'Nomor induk pegawai harus berupa string.',
            'pegawai_nomor_induk.max' => 'Nomor induk pegawai maksimal :max karakter.',
            'pegawai_nomor_induk.unique' => 'Nomor induk pegawai sudah terdaftar.',

            'biodata_id.required' => 'ID biodata harus diisi.',
            'biodata_id.exists' => 'ID biodata tidak ditemukan.',

            'status_asn_id.required' => 'Status ASN harus diisi.',
            'status_asn_id.exists' => 'Status ASN tidak ditemukan.',

            'kategori_id.required' => 'Kategori harus diisi.',
            'kategori_id.exists' => 'Kategori tidak ditemukan.',
        ];
        return array_merge(
            $message,
            (new BiodataRequest)->messages()
        );
    }
}
