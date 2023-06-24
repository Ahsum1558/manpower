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

class BmetPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function payment($id)
    {
        $manpower_data = ManpowerSubmission::find($id);
        $bmet_payment = BmetPayment::latest()-> get();
        
        if($manpower_data !== null){
            return view('admin.client.manpower.payment', [
            'manpower_data'=>$manpower_data,
            'bmet_payment'=>$bmet_payment,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    public function storePayment(Request $request, $id)
    {
        $this->validation($request);

        $manpower_data = ManpowerSubmission::findOrFail($id);
        $manpower_id = $manpower_data->id;

        $bmet_payment = new BmetPayment();
        $bmet_payment->manpowerSubId     = $manpower_id;
        $bmet_payment->customerNumber    = $request->customerNumber;
        $bmet_payment->taxPayBank        = $request->taxPayBank;
        $bmet_payment->incomeTax         = $request->incomeTax;
        $bmet_payment->incomeTaxNo       = $request->incomeTaxNo;
        $bmet_payment->incomeTaxDate     = $request->incomeTaxDate;
        $bmet_payment->insurancePayBank  = $request->insurancePayBank;
        $bmet_payment->welfareInsurance  = $request->welfareInsurance;
        $bmet_payment->welfareInsuranceNo = $request->welfareInsuranceNo;
        $bmet_payment->welfareInsuranceDate = $request->welfareInsuranceDate;
        $bmet_payment->smartPayBank      = $request->smartPayBank;
        $bmet_payment->smartCard         = $request->smartCard;
        $bmet_payment->smartCardNo       = $request->smartCardNo;
        $bmet_payment->smartCardDate     = $request->smartCardDate;
        $bmet_payment->status            = $request->status;
        $bmet_payment->save();

        return redirect() -> back() -> with('message', 'BMET Payment is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showPayment($id)
    {
        $bmet_display = $this->getDetails($id);
        
        if($bmet_display->count() > 0){
            return view('admin.client.manpower.showPayment', [
            'bmet_display'=>$bmet_display,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPayment($id)
    {
        $payment_bmet = BmetPayment::find($id);
        $all_manpower = ManpowerSubmission::where('status', 1)->orderBy('manpowerDate', 'desc')->limit(1)->get();
        
        if ($payment_bmet !== null ) {
            return view('admin.client.manpower.editPayment', [
            'payment_bmet'=>$payment_bmet,
            'all_manpower'=>$all_manpower,
            ]);
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePayment(Request $request, $id)
    {
        $payment_bmet = BmetPayment::findOrFail($id);
        $this->validationInfo($request);

        $payment_bmet->manpowerSubId     = $request->manpowerSubId;
        $payment_bmet->customerNumber    = $request->customerNumber;
        $payment_bmet->taxPayBank        = $request->taxPayBank;
        $payment_bmet->incomeTax         = $request->incomeTax;
        $payment_bmet->incomeTaxDate     = $request->incomeTaxDate;
        $payment_bmet->insurancePayBank  = $request->insurancePayBank;
        $payment_bmet->welfareInsurance  = $request->welfareInsurance;
        $payment_bmet->welfareInsuranceDate = $request->welfareInsuranceDate;
        $payment_bmet->smartPayBank      = $request->smartPayBank;
        $payment_bmet->smartCard         = $request->smartCard;
        $payment_bmet->smartCardDate     = $request->smartCardDate;
        $payment_bmet->status            = $request->status;
        $payment_bmet->update();

        return redirect() -> back() -> with('message', 'BMET Payment Info is Updated successfully');
    }

    public function editTax($id)
    {
        $payment_tax = BmetPayment::find($id);
        
        if ($payment_tax !== null ) {
            return view('admin.client.manpower.editTax', [
            'payment_tax'=>$payment_tax,
            ]);
        }else{
            return redirect('/manpower');
        }
    }

    public function updateTax(Request $request, $id)
    {
        $payment_tax = BmetPayment::findOrFail($id);
        $this -> validate($request, [
            'incomeTaxNo' => 'required|unique:bmet_payments',
        ],
        [
            'incomeTaxNo.required'        => 'Income Tax Payment Pay Order Number Field must not be Empty',
            'incomeTaxNo.unique'        => 'Income Tax Payment Pay Order Number already exist',
        ]);

        $payment_tax->incomeTaxNo  = $request->incomeTaxNo;
        $payment_tax->update();

        return redirect() -> back() -> with('message', 'Income Tax Pay Order Number is Updated successfully');
    }

    public function editInsurance($id)
    {
        $payment_insurance = BmetPayment::find($id);
        
        if ($payment_insurance !== null ) {
            return view('admin.client.manpower.editInsurance', [
            'payment_insurance'=>$payment_insurance,
            ]);
        }else{
            return redirect('/manpower');
        }
    }

    public function updateInsurance(Request $request, $id)
    {
        $payment_insurance = BmetPayment::findOrFail($id);
        $this -> validate($request, [
            'welfareInsuranceNo' => 'required|unique:bmet_payments',
        ],
        [
            'welfareInsuranceNo.required' => 'Welfare Insurance Payment Pay Order Number Field must not be Empty',
            'welfareInsuranceNo.unique' => 'Welfare Insurance Payment Pay Order Number already exist',
        ]);

        $payment_insurance->welfareInsuranceNo = $request->welfareInsuranceNo;
        $payment_insurance->update();

        return redirect() -> back() -> with('message', 'Welfare Insurance Pay Order Number is Updated successfully');
    }

    public function editCard($id)
    {
        $payment_card = BmetPayment::find($id);
        
        if ($payment_card !== null ) {
            return view('admin.client.manpower.editCard', [
            'payment_card'=>$payment_card,
            ]);
        }else{
            return redirect('/manpower');
        }
    }

    public function updateCard(Request $request, $id)
    {
        $payment_card = BmetPayment::findOrFail($id);
        $this -> validate($request, [
            'smartCardNo' => 'required|unique:bmet_payments',
        ],
        [
            'smartCardNo.required' => 'Smart Card Payment Pay Order Number Field must not be Empty',
            'smartCardNo.unique'   => 'Smart Card Payment Pay Order Number already exist',
        ]);

        $payment_card->smartCardNo = $request->smartCardNo;
        $payment_card->update();

        return redirect() -> back() -> with('message', 'Smart Card Pay Order Number is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data_payment = BmetPayment::find($id);
        $data_payment -> delete();

        return redirect() -> back() -> with('message', 'The BMET Payment is deleted successfully');
    }

    public function inactivePayment($id)
    {
        $bmet_inactive = BmetPayment::findOrFail($id);

        $bmet_inactive->status   = 0;
        $bmet_inactive->update();              

        return redirect('/manpower')->with('message', 'The Manpower Payment is Inactive Successfully');
    }
    
    public function activePayment($id)
    {
        $bmet_active = BmetPayment::findOrFail($id);

        $bmet_active->status   = 1;
        $bmet_active->update();              

        return redirect('/manpower')->with('message', 'The Manpower Payment is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerNumber'        => 'required',
            'taxPayBank'            => 'required',
            'incomeTax'             => 'required',
            'incomeTaxNo' => 'required|unique:bmet_payments',
            'incomeTaxDate'         => 'required|date',
            'insurancePayBank'      => 'required',
            'welfareInsurance'      => 'required',
            'welfareInsuranceNo' => 'required|unique:bmet_payments',
            'welfareInsuranceDate'  => 'required|date',
            'smartPayBank'          => 'required',
            'smartCard'             => 'required',
            'smartCardNo' => 'required|unique:bmet_payments',
            'smartCardDate'         => 'required|date',
            'status'                => 'required|in:1,0',
        ],
        [
            'customerNumber.required'     => 'Count of Customer Number Field is required',
            'taxPayBank.required'         => 'Income Tax Payment Bank Name Field must not be Empty',
            'incomeTax.required'          => 'Total Amount of Income Tax Field must not be Empty',
            'incomeTaxNo.required'        => 'Income Tax Payment Pay Order Number Field must not be Empty',
            'incomeTaxNo.unique'          => 'Income Tax Payment Pay Order Number already exist',
            'incomeTaxDate.required'      => 'Income Tax Payment Date Field must not be Empty',
            'insurancePayBank.required'   => 'Welfare Insurance Payment Bank Name Field must not be Empty',
            'welfareInsurance.required'   => 'Total Amount of Welfare Insurance Field must not be Empty',
            'welfareInsuranceNo.required' => 'Welfare Insurance Payment Pay Order Number Field must not be Empty',
            'welfareInsuranceNo.unique'   => 'Welfare Insurance Payment Pay Order Number already exist',
            'welfareInsuranceDate.required' => 'Welfare Insurance Payment Date Field must not be Empty',
            'smartPayBank.required'         => 'Smart Card Payment Bank Name Field must not be Empty',
            'smartCard.required'            => 'Total Amount of Smart Card Field must not be Empty',
            'smartCardNo.required'          => 'Smart Card Payment Pay Order Number Field must not be Empty',
            'smartCardNo.unique'            => 'Smart Card Payment Pay Order Number already exist',
            'smartCardDate.required'        => 'Smart Card Payment Date Field must not be Empty',
            'status.required'               => 'Status Field is required',
            'status.in'                     => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'manpowerSubId'          => 'required|exists:manpower_submissions,id',
            'customerNumber'        => 'required',
            'taxPayBank'            => 'required',
            'incomeTax'             => 'required',
            'incomeTaxDate'         => 'required|date',
            'insurancePayBank'      => 'required',
            'welfareInsurance'      => 'required',
            'welfareInsuranceDate'  => 'required|date',
            'smartPayBank'          => 'required',
            'smartCard'             => 'required',
            'smartCardDate'         => 'required|date',
            'status'                => 'required|in:1,0',
        ],
        [
            'manpowerSubId.required'     => "Manpower Submission Date Field is required !!",
            'manpowerSubId.exists'       => "Invalid Manpower Submission Date Field !!",
            'customerNumber.required'    => 'Count of Customer Number Field is required',
            'taxPayBank.required'         => 'Income Tax Payment Bank Name Field must not be Empty',
            'incomeTax.required'          => 'Total Amount of Income Tax Field must not be Empty',
            'incomeTaxDate.required'      => 'Income Tax Payment Date Field must not be Empty',
            'insurancePayBank.required'   => 'Welfare Insurance Payment Bank Name Field must not be Empty',
            'welfareInsurance.required'    => 'Total Amount of Welfare Insurance Field must not be Empty',
            'welfareInsuranceDate.required' => 'Welfare Insurance Payment Date Field must not be Empty',
            'smartPayBank.required'         => 'Smart Card Payment Bank Name Field must not be Empty',
            'smartCard.required'            => 'Total Amount of Smart Card Field must not be Empty',
            'smartCardDate.required'        => 'Smart Card Payment Date Field must not be Empty',
            'status.required'               => 'Status Field is required',
            'status.in'                     => 'Invalid status option selected',
        ]);
    }

    protected function getDetails($id){
        $data_details = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('fields', 'manpower_submissions.fieldId', '=', 'fields.id')
            ->where('bmet_payments.id', $id)
            ->leftJoin('fieldars', 'manpower_submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'manpower_submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl', 'fields.title', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->get();
        return $data_details;
    }

    protected function getPayment(){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('fields', 'manpower_submissions.fieldId', '=', 'fields.id')
            ->leftJoin('fieldars', 'manpower_submissions.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'manpower_submissions.fieldbnId', '=', 'fieldbns.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl', 'fields.title', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }
}