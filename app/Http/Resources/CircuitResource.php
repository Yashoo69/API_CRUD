<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CircuitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $races = $this->whenLoaded('races');

        return [
            'id' => $this->circuitId,
            'ref' => $this->circuitRef,
            'name' => $this->name,
            'location' => $this->location,
            'country' => $this->country,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'alt' => $this->alt,
            'url' => $this->url,
            'races' => RaceResource::collection($races)
        ];
    }
}
