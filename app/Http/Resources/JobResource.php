<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'status' => $this->status,
            'finished_at' => $this->finished_at,
            'started_at' => $this->started_at,
            'percentage' => round(($this->urls->avg(function ($url) {
                    return $url->status == true;
                }) * 100), 2),
        ];
    }
}
