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
use App\Models\Field;
use App\Models\Fieldar;
use App\Models\Fieldbn;
use App\Models\Visa;
use App\Models\Visatype;
use File;

class CustomerEmbassyController extends Controller
{
    public function embassy($id)
    {
        $data_customer = Customer::find($id);
        $customer_embassy = CustomerEmbassy::latest()-> get();
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1)->get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1)->get();
        $all_visa = Visa::latest()->where('status','=',1) -> get();
        $all_visa_type = Visatype::latest()->where('status','=',1)->get();
        
        if($data_customer !== null && $data_customer->value == 2){
            return view('admin.client.customer.embassy.embassy', [
            'data_customer'=>$data_customer,
            'customer_embassy'=>$customer_embassy,
            'all_field'=>$all_field,
            'all_fieldar'=>$all_fieldar,
            'all_fieldbn'=>$all_fieldbn,
            'all_visa'=>$all_visa,
            'all_visa_type'=>$all_visa_type,
        ]);
        }else{
            return redirect('/customer');
        }
    }

    public function storeEmbassy(Request $request, $id)
    {
        $this->validation($request);

        $data_customer = Customer::findOrFail($id);
        $customer_id = $data_customer->id;

        $customer_embassy = new CustomerEmbassy();
        $customer_embassy->customerId       = $customer_id;
        $customer_embassy->mofa             = $request->mofa;
        $customer_embassy->visaTypeId       = $request->visaTypeId;
        $customer_embassy->visaId           = $request->visaId;
        $customer_embassy->fieldId          = $request->fieldId;
        $customer_embassy->fieldarId        = $request->fieldarId;
        $customer_embassy->fieldbnId        = $request->fieldbnId;
        $customer_embassy->religion         = $request->religion;
        $customer_embassy->age              = $request->age;
        $customer_embassy->submissionDate   = $request->submissionDate;
        $customer_embassy->save();

        if($customer_embassy){
            $data_customer->value        = 3;
            $data_customer->medical      = 2;
            $data_customer->update();
            return redirect() -> back() -> with('message', 'Customer Embassy Info is added successfully');
        }
    }

    public function editEmbassy($id)
    {
        $data_customer_edit = Customer::find($id);
        $embassy_edit = CustomerEmbassy::where('customerId', $id)->get();
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1)->get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1)->get();
        $all_visa = Visa::latest()->where('status','=',1) -> get();
        $all_visa_type = Visatype::latest()->where('status','=',1)->get();
        
        if ($data_customer_edit !== null) {
            return view('admin.client.customer.embassy.editEmbassy', [
            'data_customer_edit'=>$data_customer_edit,
            'embassy_edit'=>$embassy_edit,
            'all_field'=>$all_field,
            'all_fieldar'=>$all_fieldar,
            'all_fieldbn'=>$all_fieldbn,
            'all_visa'=>$all_visa,
            'all_visa_type'=>$all_visa_type,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updateEmbassy(Request $request, $id)
    {
        $embassy_edit = CustomerEmbassy::where('customerId', $id)->first();
        $this->validationInfo($request);

        $embassy_edit->visaTypeId       = $request->visaTypeId;
        $embassy_edit->visaId           = $request->visaId;
        $embassy_edit->fieldId          = $request->fieldId;
        $embassy_edit->fieldarId        = $request->fieldarId;
        $embassy_edit->fieldbnId        = $request->fieldbnId;
        $embassy_edit->religion         = $request->religion;
        $embassy_edit->age              = $request->age;
        $embassy_edit->submissionDate   = $request->submissionDate;
        $embassy_edit->update();

        return redirect() -> back() -> with('message', 'Customer Embassy Info is Updated successfully');
    }

    public function editMofa($id)
    {
        $data_customer_mofa = Customer::find($id);
        $mofa_edit = CustomerEmbassy::where('customerId', $id)->get();        
        if ($data_customer_mofa !== null) {
            return view('admin.client.customer.embassy.editMofa', [
            'data_customer_mofa'=>$data_customer_mofa,
            'mofa_edit'=>$mofa_edit,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updateMofa(Request $request, $id)
    {
        $mofa_edit = CustomerEmbassy::where('customerId', $id)->first();
        $this -> validate($request, [
            'mofa'              => 'required|unique:customer_embassies',
        ],
        [
            'mofa.unique'               => 'Mofa Number is already exist',
            'mofa.required'             => 'Mofa Number Field must not be Empty',
        ]);

        $mofa_edit->mofa             = $request->mofa;
        $mofa_edit->update();

        return redirect() -> back() -> with('message', 'Customer Mofa Number is Updated successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_embassies',
            'mofa'              => 'required|unique:customer_embassies',
            'visaTypeId'        => 'required|exists:visatypes,id',
            'visaId'            => 'required|exists:visas,id',
            'fieldId'           => 'required|exists:fields,id',
            'fieldarId'         => 'required|exists:fieldars,id',
            'fieldbnId'         => 'required|exists:fieldbns,id',
            'religion'          => 'required',
            'age'               => 'required',
            'submissionDate'    => 'required|date',
        ],
        [
            'customerId.unique'         => 'Customer is already exist',
            'mofa.unique'               => 'Mofa Number is already exist',
            'mofa.required'             => 'Mofa Number Field must not be Empty',
            'visaTypeId.required'       => 'Visa Type Field is required',
            'visaId.required'           => 'Visa Info Field is required',
            'fieldId.required'          => "Office Name Field is required !!",
            'fieldarId.required'        => "Office Name Arabic Field is required !!",
            'fieldbnId.required'        => "Office Name Bengali Field is required !!",
            'religion.required'         => "Religion Field must not be empty !!",
            'age.required'              => "Age Field is required !!",
            'submissionDate.required'   => "Embassy Submission Field is required !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'visaTypeId'        => 'required|exists:visatypes,id',
            'visaId'            => 'required|exists:visas,id',
            'fieldId'           => 'required|exists:fields,id',
            'fieldarId'         => 'required|exists:fieldars,id',
            'fieldbnId'         => 'required|exists:fieldbns,id',
            'religion'          => 'required',
            'age'               => 'required',
            'submissionDate'    => 'required|date',
        ],
        [
            'visaTypeId.required'       => 'Visa Type Field is required',
            'visaId.required'           => 'Visa Info Field is required',
            'fieldId.required'          => "Office Name Field is required !!",
            'fieldarId.required'        => "Office Name Arabic Field is required !!",
            'fieldbnId.required'        => "Office Name Bengali Field is required !!",
            'religion.required'         => "Religion Field must not be empty !!",
            'age.required'              => "Age Field is required !!",
            'submissionDate.required'   => "Embassy Submission Field is required !!",
        ]);
    }
}