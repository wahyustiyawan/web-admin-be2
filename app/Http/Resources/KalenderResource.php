<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KalenderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tanggal =  explode('-', $this->deadline);
        return [
            'namaEvent' => $this->judul,
            'jenisEvent' => 'assignment',
            // 'assignment' => $this->assignment,
            'waktuSelesai' => $this->deadline,
            // 'tahun' => $tanggal[0],
            // 'bulan' => $tanggal[1],
            // 'tanggal' => $tanggal[2],
            'pertemuan_id' => $this->pertemuan_id,
            'mata_kuliah_id' => $this->mata_kuliah_id,
        ];
    }

    public function with($request)
    {
        return [
            "error" => false,
            "message" => "success",
            //'kelas' => $kelas,
        ];
    }

}
