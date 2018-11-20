<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Profile\Profile as ProfileRequest;
use App\Http\Requests\Profile\ChangePassword as ChangePasswordRequest;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profileForm()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function profileSave(ProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->fill($data);
        $user->save();
        return redirect()->route('profile.form')->pnotify('Дані збережено', '','success');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $old = $data['old_password'];
        if ( ! Hash::check($old, $user->password)) {
            return back()->pnotify('Помилка', 'Невірний старий пароль','erorr');
        }
        $user->password = $data['password'];
        $user->save();
        return redirect()->route('profile.form')->pnotify('Пароль змінено', '','success');
    }

}
