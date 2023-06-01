<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use File;

class SuperuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_superuser = User::latest() -> get(); // as latest
        return view('super.operator.index', compact('all_superuser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_data = User::latest() -> get(); // as latest
        return view('super.operator.create', compact('user_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingRecord = User::first();
        if (!$existingRecord) {
            $this->validation($request);
            $user_data = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'designation' => $request->designation,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'role' => $request->role,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ]);
        return redirect() -> back() -> with('message', 'User is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'User is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_user = User::find($id);
        
        if($single_user !== null){
            return view('super.operator.show', compact('single_user'));
        }else{
            return redirect('/super/operator');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user_info = User::find($id);
        if ($user_info !== null) {
            return view('super.operator.edit', compact('user_info'));
        }else{
            return redirect('/super/operator');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user_info = User::findOrFail($id);

        $user_info->role       = $request->role;
        $user_info->status     = $request->status;
        $user_info->update();              

        return back()->with('message', 'The User Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_user = User::find($id);
        $data_user -> delete();

        if(file_exists('public/admin/uploads/user/' .$data_user->photo)){
                unlink('public/admin/uploads/user/' .$data_user->photo);
            }

        return redirect() -> back() -> with('message', 'The User is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {
        $user_inactive = User::findOrFail($id);
        $user_inactive->username     = $request->username;
        $user_inactive->status       = 'inactive';
        $user_inactive->update();              

        return redirect('/super/operator')->with('message', 'The User is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {
        $user_active = User::findOrFail($id);
        $user_active->username     = $request->username;
        $user_active->status       = 'active';
        $user_active->update();              

        return redirect('/super/operator')->with('message', 'The User is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required_with:password|same:password|min:4',
            'designation' => 'required|max:255',
            'phone' => 'required|numeric',
        ],
        [
            'name.required' => "Name Field must not be empty !!",
            'username.required' => "Field must not be empty !!",
            'username.unique' => "Username is Already Exist !!",
            'email.required' => "Field must not be empty !!",
            'email.unique' => "E-Mail is Already Exist !!",
            'email.email' => "E-Mail Address is not valid !!",
            'designation.required' => "Designation Field must not be empty !!",
            'phone.required' => "Phone Field must not be empty !!",
            'phone.numeric' => "Phone number is not valid !!",
            'password.required' => "Password Field must not be empty !!",
            'password_confirmation.required' => "Confirm Password Field must not be empty !!",
        ]);
    }
}