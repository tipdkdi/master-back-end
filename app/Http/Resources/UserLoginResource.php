<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $biodata = $this->userBiodata ? $this->userBiodata->biodata : null;
        $pegawai = $this->userBiodata && $this->userBiodata->jenis == 'pegawai' ? $this->userBiodata->biodata->pegawai : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'foto' => $this->foto,
            'jenis_biodata' => $this->userBiodata ? $this->userBiodata->jenis : null, // Jenis Biodata (pegawai/mahasiswa)
            'biodata_nama_lengkap' => $biodata ? $biodata->nama_lengkap : null,
            'biodata_nik' => $biodata ? $biodata->nik : null,
            'biodata_jenis_kelamin' => $biodata ? $biodata->jenis_kelamin : null,
            'biodata_no_hp' => $biodata ? $biodata->no_hp : null,
            'biodata_agama' => $biodata ? $biodata->agama : null,
            'biodata_alamat_domisili' => $biodata ? $biodata->alamat_domisili : null,
            'pegawai_is_dosen' => $pegawai ? $pegawai->is_dosen : null,
            'pegawai_status_asn' => $pegawai && $pegawai->statusAsn ? $pegawai->statusAsn->asn_nama : null,
            'pegawai_kategori' => $pegawai && $pegawai->kategori ? $pegawai->kategori->kategori : null,
        ];
    }
}
