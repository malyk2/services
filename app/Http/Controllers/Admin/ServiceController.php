<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceType;

// use App\Http\Requests\User\SaveRole as SaveRoleRequest;
use App\Http\Requests\Service\Save as SaveServiceRequest;

class ServiceController extends Controller
{
    public function listTypes()
    {
        $items = ServiceType::paginate(ServiceType::PAGINATE_PER_PAGE);

        return view('admin.service.list-types', compact('items'));
    }

    public function addType()
    {
        return view('admin.service.form-types');
    }

    public function saveType(SaveServiceRequest $request, ServiceType $serviceType)
    {
        $data = $request->validated();
        $serviceType->fill($data);
        $serviceType->save();
        return redirect()->route('admin.service-type.list')->pnotify('Data saved', '','success');
    }
}
