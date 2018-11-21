<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceType;
use App\Http\Requests\Service\SaveType as SaveTypeRequest;
use App\Http\Requests\Service\SaveService as SaveServiceRequest;

class ServiceController extends Controller
{
    public function listServices()
    {
        $me = auth()->user();
        $items = $me->services()->with('type')->paginate(Service::PAGINATE_PER_PAGE);
        return view('admin.service.list', compact('items'));
    }

    public function addService()
    {
        $types = ServiceType::get();
        return view('admin.service.form', compact('types'));
    }

    public function saveService(SaveServiceRequest $request, Service $service)
    {
        $me = auth()->user();
        $data = [
            'type_id' => $request->type_id,
            'price' => $request->price,
            'user_id' => $me->id,
        ];
        $data['duration'] = timeToSeconds($request->duration);
        list($from, $to) = explode(' - ',$request->range);
        $data['from'] = stringToCarbon($from);
        $data['to'] = stringToCarbon($to);
        $service->fill($data);
        $service->save();

        return redirect()->route('admin.service.list')->pnotify('Data saved', '','success');
    }

    public function editServise(Service $service)
    {
        $types = ServiceType::get();
        $item = $service;
        return view('admin.service.form', compact('item','types'));
    }

    public function deleteService(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.service.list')->pnotify('Deleted', '','success');
    }

    public function listTypes()
    {
        $items = ServiceType::paginate(ServiceType::PAGINATE_PER_PAGE);

        return view('admin.service.list-types', compact('items'));
    }

    public function addType()
    {
        return view('admin.service.form-types');
    }

    public function editType(ServiceType $serviceType)
    {
        return view('admin.service.form-types', ['item'=>$serviceType]);
    }

    public function saveType(SaveTypeRequest $request, ServiceType $serviceType)
    {
        $data = $request->validated();
        $serviceType->fill($data);
        $serviceType->save();
        return redirect()->route('admin.service-type.list')->pnotify('Data saved', '','success');
    }

    public function deleteType(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->route('admin.service-type.list')->pnotify('Deleted', '','success');
    }
}
