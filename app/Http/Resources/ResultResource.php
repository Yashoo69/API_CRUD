<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $race = $this->whenLoaded('race');
        return [
            'id' => $this->resultId,
            'number' => $this->number,
            'grid' => $this->grid,
            'position' => $this->position,
            'positionText' => $this->positionText,
            'positionOrder' => $this->positionOrder,
            'points' => $this->points,
            'laps' => $this->laps,
            'time' => $this->time,
            'milliseconds' => $this->milliseconds,
            'fastestLap' => $this->fastestLap,
            'rank' => $this->rank,
            'fastestLapTime' => $this->fastestLapTime,
            'fastestLapSpeed' => $this->fastestLapSpeed,
            'race' => new RaceResource($race),
            'driver' => $this->driver,
            'constructor' => $this->constructor
        ];
    }
}
