<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $circuit = $this->whenLoaded('circuit');

        return [
            'id' => $this->raceId,
            'year' => $this->year,
            'round' => $this->round,
            'name' => $this->name,
            'date' => $this->date,
            'time' => $this->time,
            'url' => $this->url,
            'circuit' => new CircuitResource($circuit),
        ];
    }
}
