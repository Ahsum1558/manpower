<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerDocoment;
use App\Models\CustomerEmbassy;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\Delegate;
use App\Models\Visatrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\User;
use File;

class CustomerPassportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.client.customer.passport.ajax',[
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
            return view('admin.client.customer.passport.ajax_district',[
                'all_district'=>$all_district,
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
            return view('admin.client.customer.passport.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    public function passport($id)
    {
        $customer_info = Customer::find($id);
        $customer_passports = CustomerPassport::latest()-> get();
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();
        $all_issue = Issue::latest()->where('status','=',1) -> get();
        
        if($customer_info !== null && $customer_info->value == 1){
            return view('admin.client.customer.passport.passport', [
            'customer_info'=>$customer_info,
            'customer_passports'=>$customer_passports,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_upzila'=>$all_upzila,
            'all_issue'=>$all_issue,
        ]);
        }else{
            return redirect('/customer');
        }
    }

    public function storePassports(Request $request, $id)
    {
        $this->validation($request);

        $customer_info = Customer::findOrFail($id);
        $customer_id = $customer_info->id;

        $customer_passports = new CustomerPassport();
        $customer_passports->customerId     = $customer_id;
        $customer_passports->father         = $request->father;
        $customer_passports->mother         = $request->mother;
        $customer_passports->spouse         = $request->spouse;
        $customer_passports->passportIssue  = $request->passportIssue;
        $customer_passports->passportExpiry = $request->passportExpiry;
        $customer_passports->nid            = $request->nid;
        $customer_passports->dateOfBirth    = $request->dateOfBirth;
        $customer_passports->maritalStatus  = $request->maritalStatus;
        $customer_passports->address        = $request->address;
        $customer_passports->issuePlaceId   = $request->issuePlaceId;
        $customer_passports->policestationId = $request->policestationId;
        $customer_passports->districtId     = $request->districtId;
        $customer_passports->divisionId     = $request->divisionId;
        $customer_passports->countryId      = $request->countryId;
        $customer_passports->save();

        if($customer_passports){
            $customer_info->value        = 2;
            $customer_info->update();
            return redirect() -> back() -> with('message', 'Customer Passport Info is added successfully');
        }
    }

    public function editPassport($id)
    {
        $customer_info_edit = Customer::find($id);
        $passport_edit = CustomerPassport::where('customerId', $id)->get();
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();
        $all_issue = Issue::latest()->where('status','=',1) -> get();
        
        if ($customer_info_edit !== null) {
            return view('admin.client.customer.passport.editPassport', [
            'customer_info_edit'=>$customer_info_edit,
            'passport_edit'=>$passport_edit,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_upzila'=>$all_upzila,
            'all_issue'=>$all_issue,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updatePassport(Request $request, $id)
    {
        $passport_edit = CustomerPassport::where('customerId', $id)->first();
        $this->validation($request);

        $passport_edit->father         = $request->father;
        $passport_edit->mother         = $request->mother;
        $passport_edit->spouse         = $request->spouse;
        $passport_edit->passportIssue  = $request->passportIssue;
        $passport_edit->passportExpiry = $request->passportExpiry;
        $passport_edit->nid            = $request->nid;
        $passport_edit->dateOfBirth    = $request->dateOfBirth;
        $passport_edit->maritalStatus  = $request->maritalStatus;
        $passport_edit->address        = $request->address;
        $passport_edit->issuePlaceId   = $request->issuePlaceId;
        $passport_edit->policestationId = $request->policestationId;
        $passport_edit->districtId     = $request->districtId;
        $passport_edit->divisionId     = $request->divisionId;
        $passport_edit->countryId      = $request->countryId;
        $passport_edit->update();

        return redirect() -> back() -> with('message', 'Customer Passport Info is Updated successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_passports',
            'father'            => 'required',
            'mother'            => 'required',
            'spouse'            => 'required',
            'passportIssue'     => 'required|date',
            'passportExpiry'    => 'required|date',
            'nid'               => 'required',
            'dateOfBirth'       => 'required|date',
            'maritalStatus'     => 'required|in:1,2',
            'address'           => 'required',
            'issuePlaceId'      => 'required|exists:issues,id',
            'policestationId'   => 'required|exists:policestations,id',
            'districtId'        => 'required|exists:districts,id',
            'divisionId'        => 'required|exists:divisions,id',
            'countryId'         => 'required|exists:countries,id',
        ],
        [
            'customerId.unique'      => 'Customer is already exist',
            'father.required'        => 'Father Name Field must not be Empty',
            'mother.required'        => 'Mother Name Field is required',
            'spouse.required'        => 'Spouse Name Field is required',
            'passportIssue.required' => "Passport Issue Date is required !!",
            'passportExpiry.required' => "Passport Expiry Date Field must not be empty !!",
            'nid.required'           => "NID Field is required !!",
            'dateOfBirth.required'   => "Date of Birth Field is required !!",
            'maritalStatus.required' => "Marital Status Field is required !!",
            'maritalStatus.in'       => "Marital Status selection is invalid !!",
            'address.required'       => "Address Field is required !!",
            'issuePlaceId.required'  => "Passport Issue Place Field is required !!",
            'issuePlaceId.exists'    => "Passport Issue Place Field is Invalid !!",
            'policestationId.required' => "Police Station Field is required !!",
            'policestationId.exists' => "Invalid Police Station Field !!",
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
        ]);
    }
}