<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceType;
use App\Http\Resources\Ajax\Booking\Service as ServiceResouce;

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
        return new ServiceResouce($service);
    }
}
