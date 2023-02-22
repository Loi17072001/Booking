<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NguoiTruyNaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hoten' => $this->hoten,
            'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'sogiayto' => $this->sogiayto,
            'diachicutru' => $this->diachicutru,
            'bo' => $this->bo,
            'me' => $this->me,
            'toidanh' => $this->toidanh,
            'soqd' => $this->soqd,
            'ngayraqd' => $this->ngayraqd ? Carbon::createFromFormat('Y-m-d H:i:s', $this->ngayraqd)->format('d/m/Y') : "",
            'donviraquyetdinh' => $this->donviraquyetdinh,
            'donviraquyetdinh2' => $this->donviraquyetdinh2,
            'loaitruyna' => $this->loaitruyna,
            'he' => $this->he,
            'luutru' => $this->luutru,
        ];
    }
}
