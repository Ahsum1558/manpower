<?php

namespace App\Http\Controllers\Client;

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

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_submission = $this->getInfo(); // as latest
        $all_customer = $this->getCustomers(); // as latest

        return view('admin.client.submission.index', [
            'all_submission'=>$all_submission,
            'all_customer'=>$all_customer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $submission_data = Submission::latest() -> get(); // as latest
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1) -> get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1) -> get();

        return view('admin.client.submission.create', [
            'submission_data'=>$submission_data,
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
        $submission_data = new Submission();

        $submission_data->fieldId        = $request->fieldId; 
        $submission_data->fieldarId      = $request->fieldarId;
        $submission_data->fieldbnId      = $request->fieldbnId;
        $submission_data->submissionDate = $request->submissionDate;
        $submission_data->userId         = Auth::user()->id;
        $submission_data->status         = $request->status;
        $submission_data->save();

        return redirect() -> back() -> with('message', 'Embassy Submission Date is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $submission_single_data = $this->getDetails($id);
        $submission_customers = $this->getCustomersDetails($id);
        
        if($submission_single_data->count() > 0){
            return view('admin.client.submission.show', [
            'submission_single_data'=>$submission_single_data,
            'submission_customers'=>$submission_customers,
        ]);
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $submission_info = Submission::find($id);
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1) -> get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1) -> get();
        if($submission_info !== null){
            return view('admin.client.submission.edit', [
            'submission_info'=>$submission_info,
            'all_field'=>$all_field,
            'all_fieldar'=>$all_fieldar,
            'all_fieldbn'=>$all_fieldbn,
        ]);
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $submission_info = Submission::findOrFail($id);
        $this->validationInfo($request);

        $submission_info->fieldId      = $request->fieldId;
        $submission_info->fieldarId    = $request->fieldarId;
        $submission_info->fieldbnId    = $request->fieldbnId;
        $submission_info->status       = $request->status;
        $submission_info->update();

        return redirect() -> back() -> with('message', 'Embassy Submission Info is Updated successfully');
    }

    public function editDate($id)
    {
        $submission_date_info = Submission::find($id);
        if ($submission_date_info !== null) {
            return view('admin.client.submission.editDate', compact('submission_date_info'));
        }else{
            return redirect('/submission');
        }
    }

    public function updateDate(Request $request, $id)
    {
        $submission_date_info = Submission::findOrFail($id);
        $this -> validate($request, [
            'submissionDate'    => 'required|date|unique:submissions',
        ],
        [
            'submissionDate.required' => "Embassy Submission Date Field is required !!",
            'submissionDate.unique' => "Embassy Submission Date Field is already exist !!",
        ]);

        $submission_date_info->submissionDate = $request->submissionDate;
        $submission_date_info->update();

        return redirect() -> back() -> with('message', 'Embassy Submission Date is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $submission = Submission::find($id);
        if ($submission) {
            $submission->delete();
        }
        SubmissionCustomer::where('submissionId', $id)->delete();

        // Update emblist to 0 in customers table
        $submissionCustomers = SubmissionCustomer::where('submissionId', $id)->get();
        $customerIds = $submissionCustomers->pluck('customerId');
        
        Customer::whereIn('id', $customerIds)->update(['emblist' => 0]);

        return redirect()->back()->with('message', 'Submission and related records have been deleted.');
    }

    public function inactive($id)
    {
        $submission_inactive = Submission::findOrFail($id);

        $submission_inactive->status   = 0;
        $submission_inactive->update();              

        return redirect('/submission')->with('message', 'The Submission Date is Inactive Successfully');
    }
    
    public function active($id)
    {
        $submission_active = Submission::findOrFail($id);

        $submission_active->status   = 1;
        $submission_active->update();              

        return redirect('/submission')->with('message', 'The Submission Date is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'fieldId'           => 'required|exists:fields,id',
            'fieldarId'         => 'required|exists:fieldars,id',
            'fieldbnId'         => 'required|exists:fieldbns,id',
            'submissionDate'    => 'required|date|unique:submissions',
            'status'            => 'required|in:1,0',
        ],
        [
            'fieldId.required'        => "Office Name Field is required !!",
            'fieldId.exists'          => "Office Name Field is Invalid !!",
            'fieldarId.required'      => "Office Name Arabic Field is required !!",
            'fieldarId.exists'        => "Invalid Office Name Arabic Field !!",
            'fieldbnId.required'      => "Office Name Bengali Field is required !!",
            'fieldbnId.exists'        => "Office Name Bengali Field is Invalid !!",
            'submissionDate.required' => "Embassy Submission Date Field is required !!",
            'submissionDate.unique' => "Embassy Submission Date Field is already exist !!",
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'fieldId'           => 'required|exists:fields,id',
            'fieldarId'         => 'required|exists:fieldars,id',
            'fieldbnId'         => 'required|exists:fieldbns,id',
            'status'            => 'required|in:1,0',
        ],
        [
            'fieldId.required'        => "Office Name Field is required !!",
            'fieldId.exists'          => "Office Name Field is Invalid !!",
            'fieldarId.required'      => "Office Name Arabic Field is required !!",
            'fieldarId.exists'        => "Invalid Office Name Arabic Field !!",
            'fieldbnId.required'      => "Office Name Bengali Field is required !!",
            'fieldbnId.exists'        => "Office Name Bengali Field is Invalid !!",
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('submissions')
            ->leftJoin('fields', 'submissions.fieldId', '=', 'fields.id')
            ->leftJoin('fieldars', 'submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('submissions.*', 'fields.title', 'fields.license', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->orderByDesc('submissions.submissionDate')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('submissions')
            ->leftJoin('fields', 'submissions.fieldId', '=', 'fields.id')
            ->where('submissions.id', $id)
            ->leftJoin('fieldars', 'submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('submissions.*', 'fields.title', 'fields.license', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->get();
        return $data_details;
    }

    protected function getCustomers(){
        $data_customer = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'submission_customers.submissionType', 'submission_customers.ordinal', 'submission_customers.visaYear', 'submissions.submissionDate',)
            ->where('customers.value','=',3)
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
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'submission_customers.submissionType', 'submission_customers.ordinal', 'submission_customers.visaYear', 'submissions.submissionDate',)
            ->where('submissions.id', $id)
            ->where('customers.value','=',3)
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_customerDetails;
    }
}