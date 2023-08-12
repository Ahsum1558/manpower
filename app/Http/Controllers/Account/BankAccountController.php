<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use App\Models\AccountCategory;
use App\Models\BankAccount;
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

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_bankaccount = $this->getInfo();
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.bank.index', compact('all_bankaccount'));
        }else{
            return redirect('/');
        }
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.account.bank.ajax',[
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
            return view('admin.account.bank.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bankaccount_data = BankAccount::latest() -> get(); // as latest
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            return view('admin.account.bank.create', [
            'bankaccount_data'=>$bankaccount_data,
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
        $existingRecord = BankAccount::where([
            'account_number'=>$request->account_number,
            'bank_name'=>$request->bank_name,
            'account_type'=>$request->account_type,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);

        $bankaccount_data = BankAccount::latest() -> get();
        if (count($bankaccount_data) > 0) {
            BankAccount::create([
                'accountsl'      => $request->accountsl,
                'account_number' => $request->account_number,
                'account_holder' => $request->account_holder,
                'bank_name'      => $request->bank_name,
                'account_type'   => $request->account_type,
                'signatory'      => $request->signatory,
                'nominee'        => $request->nominee,
                'mobile'         => $request->mobile,
                'email'          => $request->email,
                'branch'         => $request->branch,
                'districtId'     => $request->districtId,
                'divisionId'     => $request->divisionId,
                'countryId'      => $request->countryId,
                'pre_balance'    => $request->pre_balance,
                'status'         => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Bank Account is added successfully');
            }else{
            $bankSerial = "BANK00001";
            BankAccount::create([
                'accountsl'      => $bankSerial,
                'account_number' => $request->account_number,
                'account_holder' => $request->account_holder,
                'bank_name'      => $request->bank_name,
                'account_type'   => $request->account_type,
                'signatory'      => $request->signatory,
                'nominee'        => $request->nominee,
                'mobile'         => $request->mobile,
                'email'          => $request->email,
                'branch'         => $request->branch,
                'districtId'     => $request->districtId,
                'divisionId'     => $request->divisionId,
                'countryId'      => $request->countryId,
                'pre_balance'    => $request->pre_balance,
                'status'         => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Bank Account is added successfully');
        }
        }else{
            return redirect() -> back() -> with('error_message', 'Bank Account is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_bankaccount = $this->getDetails($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            if($single_bankaccount->count() > 0){
                return view('admin.account.bank.show', [
                'single_bankaccount'=>$single_bankaccount,
            ]);
            }else{
                return redirect('/bank');
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
        $bank_info = BankAccount::find($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();

        if ($bank_info !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.bank.edit', [
                'bank_info'=>$bank_info,
                'all_country'=>$all_country,
                'all_division'=>$all_division,
                'all_district'=>$all_district,
            ]);
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/bank');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bank_info = BankAccount::findOrFail($id);
        $this->validationInfo($request);

        $bank_info->account_holder = $request->account_holder;
        $bank_info->signatory      = $request->signatory;
        $bank_info->nominee        = $request->nominee;
        $bank_info->mobile         = $request->mobile;
        $bank_info->email          = $request->email;
        $bank_info->branch         = $request->branch;
        $bank_info->districtId     = $request->districtId;
        $bank_info->divisionId     = $request->divisionId;
        $bank_info->countryId      = $request->countryId;
        $bank_info->pre_balance    = $request->pre_balance;
        $bank_info->status         = $request->status;
        $bank_info->update();

        return redirect() -> back() -> with('message', 'Bank Account Info is Updated successfully');
    }

    public function editAccount(string $id)
    {
        $bankaccount_info = BankAccount::find($id);
        if ($bankaccount_info !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.bank.editAccount', compact('bankaccount_info'));
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/bank');
        }
    }

    public function updateAccount(Request $request, string $id)
    {
        $bankaccount_info = BankAccount::findOrFail($id);
        $existingRecord = BankAccount::where([
            'account_number'=>$request->account_number,
            'bank_name'=>$request->bank_name,
            'account_type'=>$request->account_type,
        ])->first();
        if (!$existingRecord){
            $this->validateAccount($request);

        $bankaccount_info->account_number = $request->account_number;
        $bankaccount_info->bank_name      = $request->bank_name;
        $bankaccount_info->account_type   = $request->account_type;
        $bankaccount_info->update();              

        return back()->with('message', 'The Bank Account Number Info is Updated Successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Bank Account Number Info is already exist in the table !');
        }
    }

    public function editImage($id)
    {
        $bankaccount_img = BankAccount::find($id);
        if ($bankaccount_img !== null) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
                return view('admin.account.bank.editImage', compact('bankaccount_img'));
            }else{
                return redirect('/');
            } 
        }else{
            return redirect('/bank');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $bankaccount_img = BankAccount::findOrFail($id);
        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img->move(public_path('admin/uploads/bank/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/bank/' .$request->old_photo)) {
                File::delete('public/admin/uploads/bank/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $bankaccount_img->holder_img     = $unique_file_name;
        $bankaccount_img->update();
        
        return back()->with('message', 'Bank Account Holder Image is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_bankaccount = BankAccount::find($id);
        $data_bankaccount -> delete();

        if(File::exists('public/admin/uploads/bank/' .$data_bankaccount->holder_img)) {
            File::delete('public/admin/uploads/bank/' .$data_bankaccount->holder_img);
        }

        return redirect() -> back() -> with('message', 'The Bank Account is deleted successfully');
    }

    public function inactive($id)
    {
        $bankaccount_inactive = BankAccount::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $bankaccount_inactive->status   = 0;
            $bankaccount_inactive->update();              

            return redirect('/bank')->with('message', 'The Bank Account is Inactive Successfully');
        }else{
            return redirect('/');
        }
    }
    
    public function active($id)
    {
        $bankaccount_active = BankAccount::findOrFail($id);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'author') {
            $bankaccount_active->status   = 1;
            $bankaccount_active->update();              

            return redirect('/bank')->with('message', 'The Bank Account is Active Successfully');
        }else{
            return redirect('/');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'account_number' => 'required',
            'account_holder' => 'required',
            'bank_name'      => 'required',
            'account_type'   => 'required|in:1,2',
            'signatory'      => 'required',
            'nominee'        => 'required',
            'mobile'         => 'required|numeric',
            'email'          => 'required|email',
            'branch'         => 'required',
            'pre_balance'    => 'required',
            'districtId'     => 'required|exists:districts,id',
            'divisionId'     => 'required|exists:divisions,id',
            'countryId'      => 'required|exists:countries,id',
            'status'         => 'required|in:1,0',
        ],
        [
            'account_number.required' => 'Bank Account Field is required',
            'account_holder.required' => 'Account Holder Name Field must not be Empty',
            'bank_name.required'      => 'Bank Name Field must not be Empty',
            'account_type.required'   => 'Account Type Field is required',
            'account_type.in'           => 'Invalid Account Type option selected',
            'signatory.required'      => 'Signatory Field must not be Empty',
            'nominee.required' => 'Nominee Field is required',
            'mobile.required'  => 'Mobile Number Field must not be Empty',
            'mobile.numeric'   => "Mobile number is not valid !!",
            'email.required'   => "E-Mail Field must not be empty !!",
            'email.email'      => "E-Mail Address is not valid !!",
            'branch.required'  => 'Branch Location Field is required',
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
            'email'          => 'required|email',
            'branch'         => 'required',
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
            'email.required'   => "E-Mail Field must not be empty !!",
            'email.email'      => "E-Mail Address is not valid !!",
            'branch.required'  => 'Branch Location Field is required',
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
            'bank_name'      => 'required',
            'account_type'   => 'required|in:1,2',
        ],
        [
            'account_number.required' => 'Bank Account Field is required',
            'bank_name.required'      => 'Bank Name Field must not be Empty',
            'account_type.required'   => 'Account Type Field is required',
            'account_type.in'           => 'Invalid Account Type option selected',
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('bank_accounts')
            ->leftJoin('countries', 'bank_accounts.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'bank_accounts.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'bank_accounts.districtId', '=', 'districts.id')
            ->select('bank_accounts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->orderBy('bank_accounts.id', 'desc')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('bank_accounts')
            ->leftJoin('countries', 'bank_accounts.countryId', '=', 'countries.id')
            ->where('bank_accounts.id', $id)
            ->leftJoin('divisions', 'bank_accounts.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'bank_accounts.districtId', '=', 'districts.id')
            ->select('bank_accounts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->get();
        return $data_details;
    }
}