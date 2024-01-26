<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\OldPasswordCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function changePassword(){
        $pageTitle = 'Change Password';
        return view('admin.pages.change-password', compact('pageTitle'));
    }
    public function changePasswordStore(Request $request){
        $user = Auth::user();
        $request->validate([
            'old_password' => ['required', new OldPasswordCheck],
            'password' => 'required|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Password Changed Successfully');
    }
}
