<?php

namespace App\Http\Controllers\Manpower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerEmbassy;
use App\Models\Delegate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Field;
use App\Models\Fieldar;
use App\Models\Fieldbn;
use App\Models\Visa;
use App\Models\Submission;
use App\Models\SubmissionCustomer;
use App\Models\ManpowerSubmission;
use App\Models\CustomerManpower;
use App\Models\BmetPayment;

class ManpowerSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_manpower = $this->getInfo(); // as latest
        $all_customer = $this->getCustomers()->where('value','=',4); // as latest
        $stamped_customer = $this->getCustomers()->where('value','=',3); // as latest
        $all_payment = $this->getPayment(); // as latest

        return view('admin.client.manpower.index', [
            'all_manpower'=>$all_manpower,
            'all_customer'=>$all_customer,
            'stamped_customer'=>$stamped_customer,
            'all_payment'=>$all_payment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manpower_data = ManpowerSubmission::latest() -> get(); // as latest
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1) -> get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1) -> get();

        return view('admin.client.manpower.create', [
            'manpower_data'=>$manpower_data,
            'all_field'=>$all_field,
            'all_fieldar'=>$all_fieldar,
            'all_fieldbn'=>$all_fieldbn,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $manpower_data = new ManpowerSubmission();

        $manpower_data->fieldId        = $request->fieldId; 
        $manpower_data->fieldarId      = $request->fieldarId;
        $manpower_data->fieldbnId      = $request->fieldbnId;
        $manpower_data->manpowerDate   = $request->manpowerDate;
        $manpower_data->putupSl        = $request->putupSl;
        $manpower_data->userId         = Auth::user()->id;
        $manpower_data->status         = $request->status;
        $manpower_data->save();

        return redirect() -> back() -> with('message', 'Manpower Submission Date is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manpower_single_data = $this->getDetails($id);
        $manpower_customers = $this->getCustomersDetails($id);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->get();
        
        if($manpower_single_data->count() > 0){
            return view('admin.client.manpower.show', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manpower_info = ManpowerSubmission::find($id);
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1) -> get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1) -> get();
        if($manpower_info !== null){
            return view('admin.client.manpower.edit', [
            'manpower_info'=>$manpower_info,
            'all_field'=>$all_field,
            'all_fieldar'=>$all_fieldar,
            'all_fieldbn'=>$all_fieldbn,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $manpower_info = ManpowerSubmission::findOrFail($id);
        $this->validationInfo($request);

        $manpower_info->fieldId      = $request->fieldId;
        $manpower_info->fieldarId    = $request->fieldarId;
        $manpower_info->fieldbnId    = $request->fieldbnId;
        $manpower_info->status       = $request->status;
        $manpower_info->update();

        return redirect() -> back() -> with('message', 'Manpower Submission Info is Updated successfully');
    }

    public function editDate($id)
    {
        $manpower_date_info = ManpowerSubmission::find($id);
        if ($manpower_date_info !== null) {
            return view('admin.client.manpower.editDate', compact('manpower_date_info'));
        }else{
            return redirect('/manpower');
        }
    }

    public function updateDate(Request $request, $id)
    {
        $manpower_date_info = ManpowerSubmission::findOrFail($id);
        $this -> validate($request, [
            'manpowerDate' => 'required|date|unique:manpower_submissions',
        ],
        [
            'manpowerDate.required' => "Manpower Submission Date Field is required !!",
            'manpowerDate.unique' => "Manpower Submission Date Field is already exist !!",
        ]);

        $manpower_date_info->manpowerDate = $request->manpowerDate;
        $manpower_date_info->update();

        return redirect() -> back() -> with('message', 'Manpower Submission Date is Updated successfully');
    }

    public function editPutup($id)
    {
        $manpower_putup_info = ManpowerSubmission::find($id);
        if ($manpower_putup_info !== null) {
            return view('admin.client.manpower.editPutup', compact('manpower_putup_info'));
        }else{
            return redirect('/manpower');
        }
    }

    public function updatePutup(Request $request, $id)
    {
        $manpower_putup_info = ManpowerSubmission::findOrFail($id);
        $this -> validate($request, [
            'putupSl' => 'required|unique:manpower_submissions',
        ],
        [
            'putupSl.required' => "Put Up List Field is required !!",
            'putupSl.unique'   => "Put Up List Field is already exist !!",
        ]);

        $manpower_putup_info->putupSl = $request->putupSl;
        $manpower_putup_info->update();

        return redirect() -> back() -> with('message', 'Put Up List is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manpower = ManpowerSubmission::find($id);
        if ($manpower) {
            $manpower->delete();
        }
        CustomerManpower::where('manpowerSubId', $id)->delete();
        BmetPayment::where('manpowerSubId', $id)->delete();
        
        return redirect()->back()->with('message', 'Manpower Submission and related records have been deleted.');
    }

    public function inactive($id)
    {
        $manpower_inactive = ManpowerSubmission::findOrFail($id);

        $manpower_inactive->status   = 0;
        $manpower_inactive->update();              

        return redirect('/manpower')->with('message', 'The Manpower Submission Date is Inactive Successfully');
    }
    
    public function active($id)
    {
        $manpower_active = ManpowerSubmission::findOrFail($id);

        $manpower_active->status   = 1;
        $manpower_active->update();              

        return redirect('/manpower')->with('message', 'The Manpower Submission Date is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'fieldId'      => 'required|exists:fields,id',
            'fieldarId'    => 'required|exists:fieldars,id',
            'fieldbnId'    => 'required|exists:fieldbns,id',
            'manpowerDate' => 'required|date|unique:manpower_submissions',
            'putupSl'      => 'required|unique:manpower_submissions',
            'status'       => 'required|in:1,0',
        ],
        [
            'fieldId.required'        => "Office Name Field is required !!",
            'fieldId.exists'          => "Office Name Field is Invalid !!",
            'fieldarId.required'      => "Office Name Arabic Field is required !!",
            'fieldarId.exists'        => "Invalid Office Name Arabic Field !!",
            'fieldbnId.required'      => "Office Name Bengali Field is required !!",
            'fieldbnId.exists'        => "Office Name Bengali Field is Invalid !!",
            'manpowerDate.required'   => "Manpower Submission Date Field is required !!",
            'manpowerDate.unique'     => "Manpower Submission Date Field is already exist !!",
            'putupSl.required'        => "Put Up List Field is required !!",
            'putupSl.unique'          => "Put Up List Field is already exist !!",
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'fieldId'   => 'required|exists:fields,id',
            'fieldarId' => 'required|exists:fieldars,id',
            'fieldbnId' => 'required|exists:fieldbns,id',
            'status'    => 'required|in:1,0',
        ],
        [
            'fieldId.required'   => "Office Name Field is required !!",
            'fieldId.exists'     => "Office Name Field is Invalid !!",
            'fieldarId.required' => "Office Name Arabic Field is required !!",
            'fieldarId.exists'   => "Invalid Office Name Arabic Field !!",
            'fieldbnId.required' => "Office Name Bengali Field is required !!",
            'fieldbnId.exists'   => "Office Name Bengali Field is Invalid !!",
            'status.required'    => 'Status Field is required',
            'status.in'          => 'Invalid status option selected',
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('manpower_submissions')
            ->leftJoin('fields', 'manpower_submissions.fieldId', '=', 'fields.id')
            ->leftJoin('fieldars', 'manpower_submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'manpower_submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('manpower_submissions.*', 'fields.title', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('manpower_submissions')
            ->leftJoin('fields', 'manpower_submissions.fieldId', '=', 'fields.id')
            ->where('manpower_submissions.id', $id)
            ->leftJoin('fieldars', 'manpower_submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'manpower_submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('manpower_submissions.*', 'fields.title', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->get();
        return $data_details;
    }

    protected function getPayment(){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }

    protected function getPaymentDetails($id){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->where('manpower_submissions.id', $id)
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }

    protected function getCustomers(){
        $data_customer = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('manpower_submissions', 'customer_manpowers.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'customer_visas.stamped_visano', 'customer_visas.visa_issue', 'customer_visas.visa_expiry', 'customer_visas.stay_duration', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national', 'customer_manpowers.customerPhone', 'customer_manpowers.ordinal', 'customer_manpowers.fatherPhone', 'customer_manpowers.motherPhone', 'customer_manpowers.certificateNo', 'customer_manpowers.batchNo', 'customer_manpowers.rollNo', 'customer_manpowers.ttcname', 'customer_manpowers.accountNo', 'customer_manpowers.bankname', 'customer_manpowers.bankbranch', 'customer_manpowers.medicalCenter', 'customer_manpowers.immigrationCosts', 'customer_manpowers.finger_regno', 'customer_manpowers.salary', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->orderBy('manpower_submissions.manpowerDate', 'desc')
            ->orderBy('customer_manpowers.ordinal', 'desc')
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_customer;
    }

    protected function getCustomersDetails($id){
        $data_customerDetails = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('manpower_submissions', 'customer_manpowers.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'customer_visas.stamped_visano', 'customer_visas.visa_issue', 'customer_visas.visa_expiry', 'customer_visas.stay_duration', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national', 'customer_manpowers.customerPhone', 'customer_manpowers.ordinal', 'customer_manpowers.fatherPhone', 'customer_manpowers.motherPhone', 'customer_manpowers.certificateNo', 'customer_manpowers.batchNo', 'customer_manpowers.rollNo', 'customer_manpowers.ttcname', 'customer_manpowers.accountNo', 'customer_manpowers.bankname', 'customer_manpowers.bankbranch', 'customer_manpowers.medicalCenter', 'customer_manpowers.immigrationCosts', 'customer_manpowers.finger_regno', 'customer_manpowers.salary', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->where('manpower_submissions.id', $id)
            ->where('customers.value','=',4)
            ->orderBy('customer_manpowers.ordinal')
            ->get();
        return $data_customerDetails;
    }
}