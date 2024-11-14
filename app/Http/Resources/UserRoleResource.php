<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role' => $this->role->role_nama,  // asumsi 'name' adalah nama kolom di tabel roles
            'role_id' => $this->role->id,  // asumsi 'name' adalah nama kolom di tabel roles
            'is_default' => $this->is_default,  // asumsi 'name' adalah nama kolom di tabel roles
            'is_active' => $this->is_active,  // asumsi 'name' adalah nama kolom di tabel roles
        ];
    }
}
