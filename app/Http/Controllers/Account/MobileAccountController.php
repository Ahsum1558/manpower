<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use App\Models\AccountCategory;
use App\Models\BankAccount;
use App\Models\MobileAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class MobileAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_mobileaccount = $this->getInfo();
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.mobile.index', compact('all_mobileaccount'));
        }else{
            return redirect('/');
        }
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.account.mobile.ajax',[
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
            return view('admin.account.mobile.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mobileaccount_data = MobileAccount::latest() -> get(); // as latest
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.mobile.create', [
            'mobileaccount_data'=>$mobileaccount_data,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
        ]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingRecord = MobileAccount::where([
            'account_number'=>$request->account_number,
            'account_type'=>$request->account_type,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);

        $mobileaccount_data = MobileAccount::latest() -> get();
        if (count($mobileaccount_data) > 0) {
            MobileAccount::create([
                'accountsl'      => $request->accountsl,
                'account_number' => $request->account_number,
                'account_holder' => $request->account_holder,
                'account_type'   => $request->account_type,
                'signatory'      => $request->signatory,
                'nominee'        => $request->nominee,
                'mobile'         => $request->mobile,
                'holder_address' => $request->holder_address,
                'districtId'     => $request->districtId,
                'divisionId'     => $request->divisionId,
                'countryId'      => $request->countryId,
                'pre_balance'    => $request->pre_balance,
                'status'         => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Bank Account is added successfully');
            }else{
            $mobileSerial = "MOB00001";
            MobileAccount::create([
                'accountsl'      => $mobileSerial,
                'account_number' => $request->account_number,
                'account_holder' => $request->account_holder,
                'account_type'   => $request->account_type,
                'signatory'      => $request->signatory,
                'nominee'        => $request->nominee,
                'mobile'         => $request->mobile,
                'holder_address' => $request->holder_address,
                'districtId'     => $request->districtId,
                'divisionId'     => $request->divisionId,
                'countryId'      => $request->countryId,
                'pre_balance'    => $request->pre_balance,
                'status'         => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Mobile Account is added successfully');
        }
        }else{
            return redirect() -> back() -> with('error_message', 'Mobile Account is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_mobileaccount = $this->getDetails($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            if($single_mobileaccount->count() > 0){
                return view('admin.account.mobile.show', [
                'single_mobileaccount'=>$single_mobileaccount,
            ]);
            }else{
                return redirect('/mobile');
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
        $mobile_info = MobileAccount::find($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();

        if ($mobile_info !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.mobile.edit', [
                'mobile_info'=>$mobile_info,
                'all_country'=>$all_country,
                'all_division'=>$all_division,
                'all_district'=>$all_district,
            ]);
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/mobile');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mobile_info = MobileAccount::findOrFail($id);
        $this->validationInfo($request);

        $mobile_info->account_holder = $request->account_holder;
        $mobile_info->signatory      = $request->signatory;
        $mobile_info->nominee        = $request->nominee;
        $mobile_info->mobile         = $request->mobile;
        $mobile_info->holder_address = $request->holder_address;
        $mobile_info->districtId     = $request->districtId;
        $mobile_info->divisionId     = $request->divisionId;
        $mobile_info->countryId      = $request->countryId;
        $mobile_info->pre_balance    = $request->pre_balance;
        $mobile_info->status         = $request->status;
        $mobile_info->update();

        return redirect() -> back() -> with('message', 'Mobile Account Info is Updated successfully');
    }

    public function editAccount(string $id)
    {
        $mobileaccount_info = MobileAccount::find($id);
        if ($mobileaccount_info !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.mobile.editAccount', compact('mobileaccount_info'));
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/mobile');
        }
    }

    public function updateAccount(Request $request, string $id)
    {
        $mobileaccount_info = MobileAccount::findOrFail($id);
        $existingRecord = MobileAccount::where([
            'account_number'=>$request->account_number,
            'account_type'=>$request->account_type,
        ])->first();
        if (!$existingRecord){
            $this->validateAccount($request);

        $mobileaccount_info->account_number = $request->account_number;
        $mobileaccount_info->account_type   = $request->account_type;
        $mobileaccount_info->update();              

        return back()->with('message', 'The Mobile Account Number Info is Updated Successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Mobile Account Number Info is already exist in the table !');
        }
    }

    public function editImage($id)
    {
        $mobileaccount_img = MobileAccount::find($id);
        if ($mobileaccount_img !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.mobile.editImage', compact('mobileaccount_img'));
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/mobile');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $mobileaccount_img = MobileAccount::findOrFail($id);
        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img->move(public_path('admin/uploads/mobile/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/mobile/' .$request->old_photo)) {
                File::delete('public/admin/uploads/mobile/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $mobileaccount_img->holder_img     = $unique_file_name;
        $mobileaccount_img->update();
        
        return back()->with('message', 'Mobile Account Holder Image is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_bankaccount = MobileAccount::find($id);
        $data_bankaccount -> delete();

        if(File::exists('public/admin/uploads/mobile/' .$data_bankaccount->holder_img)) {
            File::delete('public/admin/uploads/mobile/' .$data_bankaccount->holder_img);
        }

        return redirect() -> back() -> with('message', 'The Mobile Account is deleted successfully');
    }

    public function inactive($id)
    {
        $mobileaccount_inactive = MobileAccount::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $mobileaccount_inactive->status   = 0;
            $mobileaccount_inactive->update();              

            return redirect('/mobile')->with('message', 'The Mobile Account is Inactive Successfully');
        }else{
            return redirect('/');
        }
    }
    
    public function active($id)
    {
        $mobileaccount_active = MobileAccount::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $mobileaccount_active->status   = 1;
            $mobileaccount_active->update();              

            return redirect('/mobile')->with('message', 'The Mobile Account is Active Successfully');
        }else{
            return redirect('/');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'account_number' => 'required',
            'account_holder' => 'required',
            'account_type'   => 'required|in:1,2,3',
            'signatory'      => 'required',
            'nominee'        => 'required',
            'mobile'         => 'required|numeric',
            'holder_address' => 'required',
            'pre_balance'    => 'required',
            'districtId'     => 'required|exists:districts,id',
            'divisionId'     => 'required|exists:divisions,id',
            'countryId'      => 'required|exists:countries,id',
            'status'         => 'required|in:1,0',
        ],
        [
            'account_number.required' => 'Mobile Account Field is required',
            'account_holder.required' => 'Account Holder Name Field must not be Empty',
            'account_type.required'   => 'Account Type Field is required',
            'account_type.in'         => 'Invalid Account Type option selected',
            'signatory.required'      => 'Signatory Field must not be Empty',
            'nominee.required' => 'Nominee Field is required',
            'mobile.required'  => 'Mobile Number Field must not be Empty',
            'mobile.numeric'   => "Mobile number is not valid !!",
            'holder_address.required' => 'Holder Address Field is required',
            'pre_balance.required' => 'Starting Balance Field is required',
            'districtId.required' => "District Field is required !!",
            'districtId.exists'   => "Invalid District Field !!",
            'divisionId.required' => "Division Field is required !!",
            'divisionId.exists'   => "Invalid Division Field !!",
            'countryId.required'  => "Country Field is required !!",
            'countryId.exists'    => "Invalid Country Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'account_holder' => 'required',
            'signatory'      => 'required',
            'nominee'        => 'required',
            'mobile'         => 'required|numeric',
            'holder_address' => 'required',
            'pre_balance'    => 'required',
            'districtId'     => 'required|exists:districts,id',
            'divisionId'     => 'required|exists:divisions,id',
            'countryId'      => 'required|exists:countries,id',
            'status'         => 'required|in:1,0',
        ],
        [
            'account_holder.required' => 'Account Holder Name Field must not be Empty',
            'signatory.required'      => 'Signatory Field must not be Empty',
            'nominee.required' => 'Nominee Field is required',
            'mobile.required'  => 'Mobile Number Field must not be Empty',
            'mobile.numeric'   => "Mobile number is not valid !!",
            'holder_address.required' => 'Holder Address Field is required',
            'pre_balance.required' => 'Starting Balance Field is required',
            'districtId.required' => "District Field is required !!",
            'districtId.exists'   => "Invalid District Field !!",
            'divisionId.required' => "Division Field is required !!",
            'divisionId.exists'   => "Invalid Division Field !!",
            'countryId.required'  => "Country Field is required !!",
            'countryId.exists'    => "Invalid Country Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }

    protected function validateAccount($request){
        $this -> validate($request, [
            'account_number' => 'required',
            'account_type'   => 'required|in:1,2,3',
        ],
        [
            'account_number.required' => 'Mobile Account Field is required',
            'account_type.required'   => 'Account Type Field is required',
            'account_type.in'         => 'Invalid Account Type option selected',
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('mobile_accounts')
            ->leftJoin('countries', 'mobile_accounts.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'mobile_accounts.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'mobile_accounts.districtId', '=', 'districts.id')
            ->select('mobile_accounts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->orderBy('mobile_accounts.id', 'desc')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('mobile_accounts')
            ->leftJoin('countries', 'mobile_accounts.countryId', '=', 'countries.id')
            ->where('mobile_accounts.id', $id)
            ->leftJoin('divisions', 'mobile_accounts.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'mobile_accounts.districtId', '=', 'districts.id')
            ->select('mobile_accounts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->get();
        return $data_details;
    }
}