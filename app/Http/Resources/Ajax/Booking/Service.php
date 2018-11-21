<?php

namespace App\Http\Resources\Ajax\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
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
            'duration' => $this->duration,
            'duration_hours' => $this->duration_hours,
            'price' => $this->price,
            'from' => $this->from->format('Y-m-d'),
            'to' => $this->to->format('Y-m-d'),
            'events' => $this->whenLoaded('bookings', BookingEvent::collection($this->bookings)),
        ];
    }
}
