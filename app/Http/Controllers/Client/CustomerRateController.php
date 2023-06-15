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
    public function rate($id)
    {
        $customer_rate_info = Customer::find($id);
        $customer_rate = CustomerRate::latest()-> get();
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'author')) {
            if($customer_rate_info !== null && $customer_rate_info->rateValue == 0){
            return view('admin.client.customer.rate.rate', [
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

    public function editRate($id)
    {
        $customer_edit_rate = Customer::find($id);
        $rate_edit = CustomerRate::where('customerId', $id)->get();
        
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'author')) {
            if ($customer_edit_rate !== null) {
                return view('admin.client.customer.rate.editRate', [
                'customer_edit_rate'=>$customer_edit_rate,
                'rate_edit'=>$rate_edit,
                ]);
                }else{
                    return redirect('/customer');
                }
            }else{
                return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRate(Request $request, $id)
    {
        $rate_edit = CustomerRate::where('customerId', $id)->first();
        $this->validation($request);

        $rate_edit->workingRate     = $request->workingRate;
        $rate_edit->extraCharge     = $request->extraCharge;
        $rate_edit->rateDescription = $request->rateDescription;
        $rate_edit->discount        = $request->discount;
        $rate_edit->update();

        return redirect() -> back() -> with('message', 'Customer Working Rate is Updated successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'     => 'unique:customer_rates',
            'workingRate'    => 'required',
            'extraCharge'    => 'required',
            'discount'       => 'required',
        ],
        [
            'customerId.unique'     => 'Customer is already exist',
            'workingRate.required'  => 'Working Rate Field must not be Empty',
            'extraCharge.required'  => 'Extra Charge Field is required',
            'discount.required'     => 'Discount Field must not be Empty',
        ]);
    }
}