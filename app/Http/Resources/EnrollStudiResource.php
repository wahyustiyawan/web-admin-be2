<?php

namespace App\Http\Resources;

use App\Models\Kelas;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollStudiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $kelas = Kelas::find($this->kelas_id);
        return [
            'id' => $this->id,
            //'kelas' => $this->kelas_id,
            'iscomplete' => $this->iscomplete,
            'kelas' => new KelasResource($kelas),
        ];
    }

    public function with($request)
    {
        return [
            "error" => false,
            "message" => "success",
        ];
    }
}
