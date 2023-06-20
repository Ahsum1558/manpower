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

class SubmissionCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function statement($id)
    {
        $customer_emb = Customer::find($id);
        $customer_sub = SubmissionCustomer::latest()-> get();
        $all_submission = Submission::where('status', 1)->orderBy('submissionDate', 'desc')->limit(1)->get();
        
        if($customer_emb !== null && $customer_emb->value == 3 && $customer_emb->emblist == 0){
            return view('admin.client.submission.statement', [
            'customer_emb'=>$customer_emb,
            'customer_sub'=>$customer_sub,
            'all_submission'=>$all_submission,
        ]);
        }else{
            return redirect('/submission');
        }
    }

    public function storeStatement(Request $request, $id)
    {
        $this->validation($request);

        $customer_emb = Customer::findOrFail($id);
        $customer_id = $customer_emb->id;

        $customer_sub = new SubmissionCustomer();
        $customer_sub->customerId     = $customer_id;
        $customer_sub->submissionId   = $request->submissionId;
        $customer_sub->submissionType = $request->submissionType;
        $customer_sub->ordinal        = $request->ordinal;
        $customer_sub->visaYear       = $request->visaYear;
        $customer_sub->status         = $request->status;
        $customer_sub->value          = 0;
        $customer_sub->userId         = Auth::user()->id;
        $customer_sub->save();

        if($customer_sub){
            $customer_emb->emblist        = 1;
            $customer_emb->update();
            return redirect() -> back() -> with('message', 'Customer is added to Embassy Statement');
        }
    }
  
    /**
     * Display the specified resource.
     */
    public function display($id)
    {
        $customer_display = $this->getCustomersDetails($id);
        
        if($customer_display->count() > 0){
            return view('admin.client.submission.display', [
            'customer_display'=>$customer_display,
        ]);
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStatement($id)
    {
        $customer_statement = Customer::find($id);
        $edit_statments = SubmissionCustomer::where('customerId', $id)->get();
        $all_submission = Submission::where('status', 1)->orderBy('submissionDate', 'desc')->limit(1)->get();
        
        if ($customer_statement !== null && $customer_statement->value == 3 && $customer_statement->emblist == 1) {
            return view('admin.client.submission.editStatement', [
            'customer_statement'=>$customer_statement,
            'edit_statments'=>$edit_statments,
            'all_submission'=>$all_submission,
            ]);
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatement(Request $request, $id)
    {
        $edit_statments = SubmissionCustomer::where('customerId', $id)->first();
        $this->validation($request);

        $edit_statments->submissionId   = $request->submissionId;
        $edit_statments->submissionType = $request->submissionType;
        $edit_statments->ordinal        = $request->ordinal;
        $edit_statments->visaYear       = $request->visaYear;
        $edit_statments->status         = $request->status;
        $edit_statments->update();

        return redirect() -> back() -> with('message', 'Customer Embassy Statement Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove($id)
    {
        $customer_emb = Customer::findOrFail($id);
        $customer_emb->emblist          = 0;
        $customer_emb->save();

        if($customer_emb){
            SubmissionCustomer::where('customerId', $id)->delete();
            return redirect() -> back() -> with('message', 'The Customer is removed from List of Embassy successfully');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'     => 'unique:submission_customers',
            'submissionId'   => 'required|exists:submissions,id',
            'submissionType' => 'required|in:1,2,3,4,5,6,7',
            'ordinal'        => 'required',
            'visaYear'       => 'required',
            'status'         => 'required|in:1,0',
        ],
        [
            'customerId.unique'       => 'Customer is already exist',
            'submissionId.required'   => 'Submission Date Field is required',
            'submissionId.exists'     => 'Submission Date Field is Invalid',
            'submissionType.required' => 'Submission Type Field is required',
            'submissionType.in'       => 'Invalid Submission Type option selected',
            'ordinal.required'        => 'Ordinal No. for Serial Field must not be Empty',
            'visaYear.required'       => 'Hijri Year in Visa Field is required',
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
        ]);
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
            ->where('customers.id', $id)
            ->where('customers.value','=',3)
            ->orderBy('submission_customers.ordinal')
            ->get();
        return $data_customerDetails;
    }
}