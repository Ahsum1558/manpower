<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SuperLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{

    public function index(){
        $data = User::latest() -> get(); // as latest
        if (Auth::check() && Auth::user()->status === 'active') {
            return view('admin.home.index');
        }elseif(Auth::check() && Auth::user()->status !== 'active') {
            Auth::logout();
            return redirect('/login')->with(['error_message' => 'Your account is inactive. Please contact the administrator.']);
        }
        
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
        $profile_data = $this->getDetails($id);
        return view('admin.users.profile', compact('profile_data'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.users.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function getDistrict(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_district)>0) {
            return view('admin.users.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    public function getCity(Request $request)
    {
        $all_city = City::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_city)>0) {
            return view('admin.users.ajax_city',[
                'all_city'=>$all_city,
            ]);
        }
    }

    public function getUpzila(Request $request)
    {
        $all_upzila = Policestation::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_upzila)>0) {
            return view('admin.users.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    public function profileInfoEdit(){
        $id = Auth::user()->id;
        $user_info = $this->getDetails($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_city = City::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();
        
        return view('admin.users.profile_info', [
            'user_info'=>$user_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
    }

    public function profileInfoUpdate(Request $request){
        $id = Auth::user()->id;
        $user_info = User::find($id);

        $this->validationInfo($request);

        $user_info->name            = $request->name;
        $user_info->designation     = $request->designation;
        $user_info->phone           = $request->phone;
        $user_info->address         = $request->address;
        $user_info->policestationId = $request->policestationId;
        $user_info->districtId      = $request->districtId;
        $user_info->divisionId      = $request->divisionId;
        $user_info->cityId          = $request->cityId;
        $user_info->countryId       = $request->countryId;
        $user_info->dateOfBirth     = $request->dateOfBirth;
        $user_info->gender          = $request->gender;
        $user_info->description     = $request->description;
        $user_info->zipcode         = $request->zipcode;
        $user_info->update();              

        return back()->with('message', 'Profile Information is Updated Successfully');
    }

    public function profileUsername(){
        $id = Auth::user()->id;
        $username_data = User::find($id);
        return view('admin.users.profile_username', compact('username_data'));
    }

    public function profileUsernameUpdate(Request $request){
        $id = Auth::user()->id;
        $username_data = User::find($id);

        $rules = [
                'username' => 'required|unique:users|max:255',
            ];

            $customMessage = [
                'username.required' => "Field must not be empty !!",
                'username.unique' => "Username is Already Exist !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $username_data->username    = $request->username;
        $username_data->update();              

        return back()->with('message', 'Username is Updated Successfully');
    }

    public function profileEmail(){
        $id = Auth::user()->id;
        $email_data = User::find($id);
        return view('admin.users.profile_email', compact('email_data'));
    }

    public function profileEmailUpdate(Request $request){
        $id = Auth::user()->id;
        $email_data = User::find($id);

        $rules = [
                'email' => 'required|email|unique:users|max:255',
            ];

            $customMessage = [
                'email.required' => "Field must not be empty !!",
                'email.unique' => "E-Mail is Already Exist !!",
                'email.email' => "E-Mail Address is not valid !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $email_data->email       = $request->email;
        $email_data->update();              

        return back()->with('message', 'E-Mail is Updated Successfully');
    }

    public function profileImage(){
        $id = Auth::user()->id;
        $image_data = User::find($id);
        return view('admin.users.profile_image', compact('image_data'));
    }

    public function profileImageUpdate(Request $request){
        $id = Auth::user()->id;
        $image_data = User::find($id);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img->move(public_path('admin/uploads/user/'), $unique_file_name);
            // if(file_exists('public/admin/uploads/user/' .$request->old_photo)){
            //     unlink('public/admin/uploads/user/' .$request->old_photo);
            // }
            if(File::exists('public/admin/uploads/user/' .$request->old_photo)) {
                File::delete('public/admin/uploads/user/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $image_data->photo     = $unique_file_name;
        $image_data->update();
        
        return back()->with('message', 'Profile Image is Updated Successfully');
    }

    public function profilePassword(){
        $id = Auth::user()->id;
        $password_data = User::find($id);
        return view('admin.users.profile_password', compact('password_data'));
    }

    public function profilePasswordUpdate(Request $request){
        $id = Auth::user()->id;
        $password_data = User::find($id);

        $this->validationPassword($request);

        $oldPassword = $request->old_password;
        if (!Hash::check($oldPassword, $password_data->password)) {
            return back()->with('error_message', 'Old password does not match ! Please try again');
        }

        if (Hash::check($oldPassword, $password_data->password)) {
        $password_data->password = Hash::make($request->new_password);
        $password_data->update();
        return back()->with('message', 'Password is Updated Successfully');
        }
    }

    public function userProfileTheme(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('admin.users.profile_theme', compact('userData'));
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

    protected function validationInfo($request){
        $this -> validate($request, [
            'name'            => 'required|max:255',
            'designation'     => 'required',
            'phone'           => 'required|numeric',
            'address'         => 'required',
            'gender'          => 'required|in:1,2,3',
            'dateOfBirth'     => 'required|date',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
        ],
        [
            'name.required'         => "Name Field must not be empty !!",
            'designation.required'  => "Designation Field must not be empty !!",
            'phone.required'        => "Phone Field must not be empty !!",
            'phone.numeric'         => "Phone number is not valid !!",
            'address.required'      => "Address Field must not be empty !!",
            'dateOfBirth.required'  => 'Date of Birth Field is required',
            'gender.required'       => 'Gender Field is required',
            'gender.in'             => 'Invalid Gender option selected',
            'policestationId.required' => "Police Station Field is required !!",
            'policestationId.exists' => "Invalid Police Station Field !!",
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'cityId.required'        => "City Field is required !!",
            'cityId.exists'          => "Invalid City Field !!",
        ]);
    }

    protected function validationPassword($request){
        $this -> validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|different:old_password',
            'new_password_confirmation' => 'required',
        ],
        [
            'old_password.required' => "Old Password Field must not be empty !!",
            'new_password.required' => "New Password Field must not be empty !!",
            'new_password.different' => "New Password should be different old password !!",
            'new_password_confirmation.required' => "Confirm New Password Field must not be empty !!",
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('cities', 'users.cityId', '=', 'cities.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->select('users.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'cities.cityname', 'policestations.policestationname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('cities.cityname')
            ->orderBy('policestations.policestationname')
            ->orderBy('users.username')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->where('users.id', $id)
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('cities', 'users.cityId', '=', 'cities.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->select('users.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'cities.cityname', 'policestations.policestationname')
            ->get();
        return $data_details;
    }
}