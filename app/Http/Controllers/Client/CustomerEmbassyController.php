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
    public function embassyAdd($id)
    {
        $data_customer = Customer::find($id);
        $customer_embassy = CustomerEmbassy::latest()-> get();
        $all_field = Field::latest()->where('status','=',1) -> get();
        $all_fieldar = Fieldar::latest()->where('status','=',1)->get();
        $all_fieldbn = Fieldbn::latest()->where('status','=',1)->get();
        $all_visa = Visa::latest()->where('status','=',1) -> get();
        $all_visa_type = Visatype::latest()->where('status','=',1)->get();
        
        if($data_customer !== null && $data_customer->value == 2){
            return view('admin.client.customer.embassyAdd', [
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

    protected function validation($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_passports',
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
