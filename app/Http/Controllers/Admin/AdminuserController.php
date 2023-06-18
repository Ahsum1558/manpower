<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDocoment;
use App\Models\CustomerEmbassy;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\Delegate;
use App\Models\Visatrade;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use File;

class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_adminuser = User::latest() -> get(); // as latest
        if (Auth::user()->role == 'admin') {
            return view('admin.operator.index', compact('all_adminuser'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_data = User::latest() -> get(); // as latest
        if (Auth::user()->role == 'admin') {
            return view('admin.operator.create', compact('user_data'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $user_data = User::create([
            'username'    => $request->username,
            'name'        => $request->name,
            'designation' => $request->designation,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'gender'      => $request->gender,
            'role'        => $request->role,
            'status'      => $request->status,
            'password'    => Hash::make($request->password),
        ]);
        return redirect() -> back() -> with('message', 'User is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_user = User::find($id);
        if (Auth::user()->role == 'admin') {
            if($single_user !== null){
                return view('admin.operator.show', compact('single_user'));
            }else{
                return redirect('/operator');
            }
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_info = User::find($id);

        if ($user_info !== null) {
            if (Auth::user()->role == 'admin' && Auth::user()->id !== $user_info->id) {
                return view('admin.operator.edit', compact('user_info'));
                }else{
                    return redirect('/');
                }
            }else{
                return redirect('/operator');
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request, [
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:admin,author,editor,contributor,user',
        ],
        [
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
            'role.required'     => 'User Role Field is required',
            'role.in'           => 'Invalid User Role option selected',
        ]);

        $user_info = User::findOrFail($id);

        $user_info->role       = $request->role;
        $user_info->status     = $request->status;
        $user_info->update();              

        return back()->with('message', 'The User Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_user = User::find($id);
        if (Auth::user()->role == 'admin' && Auth::user()->id !== $id) {
            $data_user -> delete();
            if(File::exists('public/admin/uploads/user/' .$data_user->photo)) {
                File::delete('public/admin/uploads/user/' .$data_user->photo);
              }
            return redirect() -> back() -> with('message', 'The User is deleted successfully');
        }else{
            return redirect('/');
        }
    }

    public function inactive($id)
    {
        $user_inactive = User::findOrFail($id);
        if (Auth::user()->role == 'admin' && Auth::user()->id !== $user_inactive->id) {
            $user_inactive->status       = 'inactive';
            $user_inactive->update();              

            return redirect('/operator')->with('message', 'The User is Inactive Successfully');
        }else{
            return redirect('/');
        }
    }
    
    public function active($id)
    {
        $user_active = User::findOrFail($id);
        if (Auth::user()->role == 'admin' && Auth::user()->id !== $user_active->id) {
            $user_active->status       = 'active';
            $user_active->update();              

            return redirect('/operator')->with('message', 'The User is Active Successfully');
        }else{
            return redirect('/');
        }
    }

    public function customerRef(){
        $id = Auth::user()->id;
        $customer_ref = $this->getUserDetails($id);
        return view('admin.users.customerRef', compact('customer_ref'));
    }

    protected function validation($request){
        $this -> validate($request, [
            'name'                  => 'required',
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:4',
            'password_confirmation' => 'required_with:password|same:password|min:4',
            'designation'           => 'required|max:255',
            'phone'                 => 'required|numeric',
            'gender'                => 'required|in:1,2,3',
            'status'                => 'required|in:active,inactive',
            'role' => 'required|in:admin,author,editor,contributor,user',
        ],
        [
            'name.required'     => "Name Field must not be empty !!",
            'username.required' => "Field must not be empty !!",
            'username.unique'   => "Username is Already Exist !!",
            'email.required'    => "Field must not be empty !!",
            'email.unique'      => "E-Mail is Already Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
            'designation.required' => "Designation Field must not be empty !!",
            'phone.required'    => "Phone Field must not be empty !!",
            'phone.numeric'     => "Phone number is not valid !!",
            'password.required' => "Password Field must not be empty !!",
            'password_confirmation.required' => "Confirm Password Field must not be empty !!",
            'gender.required'       => 'Gender Field is required',
            'gender.in'             => 'Invalid Gender option selected',
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
            'role.required'     => 'User Role Field is required',
            'role.in'           => 'Invalid User Role option selected',
        ]);
    }

    protected function getUserDetails($id){
        $data_details = DB::table('users')
            ->leftJoin('customers', 'users.id', '=', 'customers.userId')
            ->where('users.id', $id)
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->select('users.*', 'customers.customersl', 'customers.bookRef', 'customers.cusFname', 'customers.cusLname', 'customers.gender', 'customers.value', 'customers.status', 'customers.passportNo', 'customers.medical', 'customers.received', 'delegates.agentsl', 'delegates.agentname', 'customers.passportNo', 'visatrades.visatrade_name')
            ->get();
        return $data_details;
    }
}