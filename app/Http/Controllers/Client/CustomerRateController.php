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
use App\Models\City;
use App\Models\User;
use File;

class CustomerRateController extends Controller
{
    public function rateAdd($id)
    {
        $customer_rate_info = Customer::find($id);
        $customer_rate = CustomerRate::latest()-> get();
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'author')) {
            if($customer_rate_info !== null && $customer_rate_info->rateValue == 0){
            return view('admin.client.customer.rateAdd', [
            'customer_rate_info'=>$customer_rate_info,
            'customer_rate'=>$customer_rate,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/');
        }        
    }

    public function storeRate(Request $request, $id)
    {
        $this->validation($request);

        $customer_rate_info = Customer::findOrFail($id);
        $customer_id = $customer_rate_info->id;

        $customer_rate = new CustomerRate();
        $customer_rate->customerId      = $customer_id;
        $customer_rate->workingRate     = $request->workingRate;
        $customer_rate->extraCharge     = $request->extraCharge;
        $customer_rate->rateDescription = $request->rateDescription;
        $customer_rate->discount        = $request->discount;
        $customer_rate->value           = 0;
        $customer_rate->save();

        if($customer_rate){
            $customer_rate_info->rateValue        = 1;
            $customer_rate_info->update();
            return redirect() -> back() -> with('message', 'Customer Rate is added successfully');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'     => 'unique:customer_docoments',
            'workingRate'    => 'required',
            'extraCharge'    => 'required',
            'discount'       => 'required',
        ],
        [
            'customerId.unique'     => 'Customer is already exist',
            'workingRate.required'  => 'Working Rate Field must not be Empty',
            'extraCharge.required'  => 'Extra Charge Field is required',
            'discount.required'      => 'Discount Field must not be Empty',
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
