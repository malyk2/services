<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\Login as LoginRequests;
use App\Exceptions\PermissionException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function form()
    {
        return view('admin.login');
    }

    public function login(LoginRequests $request)
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            if ( ! auth()->user()->can('login')) {
                auth()->logout();
                return redirect()->back()->pnotify('Access is prohibited', '','error');
            }
            return redirect()->intended(route('admin.home'))->pnotify('Authorization is successful', '', 'success');
        } else {
            return redirect()->back()->pnotify('Error', 'Invalid login and / or password', 'error');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->pnotify('Logout', '','info');
    }
}
