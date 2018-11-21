<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceType;
use App\Http\Requests\Front\SaveBooking as SaveBookingRequest;
use App\Http\Resources\Ajax\Booking\Service as ServiceResouce;
use App\Http\Resources\Ajax\Booking\BookingEvent as BookingEventResouce;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with('type')->get();
        $types = ServiceType::with('services')->get();
        return view('front.home', compact('types'));
    }
    /**AJAX method */
    public function getBookingInfo(Service $service)
    {
        // dd($service);
        $service->load('bookings');
        return new ServiceResouce($service);
    }

    public function saveBooking(SaveBookingRequest $request, Service $service)
    {
        $data = [
            'client_email' => $request->email,
            'from' => stringToCarbon($request->date.$request->time_from),
            'to' => stringToCarbon($request->date.$request->time_to),
        ];
        try {
            $booking = $service->bookings()->create($data);
            return response(new BookingEventResouce($booking));
        } catch(\Exception $e) {
            return respponse([], 500);
        }
        // dd($data);

        // bookings
    }
}
