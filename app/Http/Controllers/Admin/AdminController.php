<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SuperLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use File;



class AdminController extends Controller
{

    public function index(){
        $data = User::latest() -> get(); // as latest
        return view('admin.home.index');
    }

    public function login(){
        $users = User::latest() -> get();
        if (count($users) > 0) {
            return view('admin.users.login');
        }
    }

    public function userStore(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            $this->validation($request);

            if(Auth::attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ])){
                return redirect('/');
            }else{
                return redirect()->back()->with("error_message", "Invalid Username or Password");
            }
        }
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.users.user_profile', compact('profile_data'));
    }

    public function userProfileTheme(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('admin.users.user_profile_theme', compact('userData'));
    }

    public function userProfileThemeUpdate(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->theme        = $request->theme;
        $data->update();              

        return back()->with('message', 'The Theme is Updated Successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    protected function validation($request){
        $this -> validate($request, [
            'username' => 'required|max:255',
            'password' => 'required|max:30'
        ],
        [
            'username.required' => "Username is required",
            'password.required' => "Password is required",
        ]);
    }

    





}
