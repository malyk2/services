<?php

namespace App\Http\Resources\Ajax\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingEvent extends JsonResource
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
            'title' => 'Booking',
            'start' => $this->from->format('Y-m-d H:i'),
            'end' => $this->to->format('Y-m-d H:i'),
            'allDay' => false,
        ];
    }
}
