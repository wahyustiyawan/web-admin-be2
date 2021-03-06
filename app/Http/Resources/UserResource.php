<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $host = $request->getSchemeAndHttpHost();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'gambar' => $host.'/'.$this->gambar,
            'role' => $this->role,
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
