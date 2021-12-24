<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   $opsi = ["opsi_a"=> $this->opsi_a,
        "opsi_b"=> $this->opsi_b,
        "opsi_c"=> $this->opsi_c,
        "opsi_d"=> $this->opsi_d,
        "opsi_e"=> $this->opsi_e,];
        return [
            'id' => $this->id,
            "no"=> $this->no,
            "pertanyaan"=> $this->soal,
            "opsi" => $opsi,
            "jawaban"=> $this->jawaban,
            "quiz_id"=> $this->quiz_id,
            //'video' => $this->get_video,
        ];
    }
}
