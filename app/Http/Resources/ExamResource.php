<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'file' => $this->file,
            'waktu_pengerjaan' => date('d-m-Y', strtotime($this->waktu_pengerjaan)),
            'jenis' => $this->jenis,
            'mata_kuliah_id' => $this->mata_kuliah_id,
            //'kelas_id' => $this->kelas_id,
            // 'count' =>  $countvideo + $countdokumen,
            // 'count_complete' =>  $uvideo + $udokumen,
            // 'isComplete' => $this->isComplete,
            // 'nama_kelas'=> $kelas->nama,
            //'video' => $this->get_video,
        ];
    }
}
