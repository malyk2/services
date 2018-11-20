<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceType;

// use App\Http\Requests\User\SaveRole as SaveRoleRequest;
use App\Http\Requests\Service\Save as SaveServiceRequest;

class ServiceController extends Controller
{
    public function listServices()
    {
        $items = [];
        return view('admin.service.list', compact('items'));
    }

    public function addService()
    {
        $types = ServiceType::get();
        return view('admin.service.form', compact('types'));
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

    public function saveType(SaveServiceRequest $request, ServiceType $serviceType)
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
