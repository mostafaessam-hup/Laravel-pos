<?php

namespace App\Http\Controllers\Admin;

use App\Base\Helper\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\ProfileRequest;

class AuthController extends Controller
{
    public const VIEWPATH = 'admin.auth.';

    public function loginView()
    {

        return view(static::VIEWPATH  . __FUNCTION__);
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $arr = array('status' => 'success');
            return response()->json($arr);
        }

        $arr = array('status' => 'fail', 'data' => []);
        return response()->json($arr);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login.form'));
    }

    public function updateProfileView()
    {
        $update_route = 'admin.profile.post';
        $record = auth('admin')->user();
        return view('admin.auth.profile', compact('update_route', 'record'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $admin = auth('admin')->user();
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = ImageUpload::uploadImage($request->file('image'));
        }

        if ($request->input('old_password')) {
            if (Hash::check($request->input('old_password'), $admin->password)) {
                $data['password'] = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->with('error', __('admin.old_password_is_incorrect'));
            }
        }

        $admin->update($data);

        return redirect()->back()->with('success', __('admin.profile_updated_successfully'));
    }
}
