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

class CustomerVisaController extends Controller
{
    public function stampingVisa($id)
    {
        $data_stamped_customer = Customer::find($id);
        $customer_stamping = CustomerVisa::latest()-> get();
        
        if($data_stamped_customer !== null && $data_stamped_customer->value == 3){
            return view('admin.client.customer.stamping.stampingVisa', [
            'data_stamped_customer'=>$data_stamped_customer,
            'customer_stamping'=>$customer_stamping,
        ]);
        }else{
            return redirect('/customer');
        }
    }

    public function storeStampingVisa(Request $request, $id)
    {
        $this->validation($request);

        $data_stamped_customer = Customer::findOrFail($id);
        $customer_id = $data_stamped_customer->id;

        $customer_stamping = new CustomerVisa();
        $customer_stamping->customerId      = $customer_id;
        $customer_stamping->stamped_visano  = $request->stamped_visano;
        $customer_stamping->visa_issue      = $request->visa_issue;
        $customer_stamping->visa_expiry     = $request->visa_expiry;
        $customer_stamping->stay_duration   = $request->stay_duration;
        $customer_stamping->save();

        if($customer_stamping){
            $data_stamped_customer->value        = 4;
            $data_stamped_customer->update();
            return redirect() -> back() -> with('message', 'Customer Visa Stamping Info is added successfully');
        }
    }

    public function editStamping($id)
    {
        $customer_stamping_info = Customer::find($id);
        $stamping_edit = CustomerVisa::where('customerId', $id)->get();
        
        if ($customer_stamping_info !== null) {
            return view('admin.client.customer.stamping.editStamping', [
            'customer_stamping_info'=>$customer_stamping_info,
            'stamping_edit'=>$stamping_edit,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updateStamping(Request $request, $id)
    {
        $stamping_edit = CustomerVisa::where('customerId', $id)->first();
        $this->validationInfo($request);

        $stamping_edit->visa_issue      = $request->visa_issue;
        $stamping_edit->visa_expiry     = $request->visa_expiry;
        $stamping_edit->stay_duration   = $request->stay_duration;
        $stamping_edit->update();

        return redirect() -> back() -> with('message', 'Customer Visa Stamping Info is Updated successfully');
    }

    public function editVisano($id)
    {
        $customer_stamping_visa = Customer::find($id);
        $stamped_visano_edit = CustomerVisa::where('customerId', $id)->get();
        
        if ($customer_stamping_visa !== null) {
            return view('admin.client.customer.stamping.editVisano', [
            'customer_stamping_visa'=>$customer_stamping_visa,
            'stamped_visano_edit'=>$stamped_visano_edit,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updateVisano(Request $request, $id)
    {
        $this -> validate($request, [
            'stamped_visano'    => 'required|unique:customer_visas',
        ],
        [
            'stamped_visano.unique'   => 'Stamped Visa Number is already exist',
            'stamped_visano.required' => 'Stamped Visa Number Field must not be Empty',
        ]);

        $stamped_visano_edit = CustomerVisa::where('customerId', $id)->first();

        $stamped_visano_edit->stamped_visano = $request->stamped_visano;
        $stamped_visano_edit->update();

        return redirect() -> back() -> with('message', 'Customer Stamped Visa Number is Updated successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_visas',
            'stamped_visano'    => 'required|unique:customer_visas',
            'stay_duration'     => 'required',
            'visa_issue'        => 'required|date',
            'visa_expiry'       => 'required|date',
        ],
        [
            'customerId.unique'       => 'Customer is already exist',
            'stamped_visano.unique'   => 'Stamped Visa Number is already exist',
            'stamped_visano.required' => 'Stamped Visa Number Field must not be Empty',
            'stay_duration.required'  => 'Stay Duration Field is required',
            'visa_issue.required'     => 'Visa Issue Date Field is required',
            'visa_expiry.required'    => "Visa Expiry Date Field is required !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'stay_duration'     => 'required',
            'visa_issue'        => 'required|date',
            'visa_expiry'       => 'required|date',
        ],
        [
            'stay_duration.required'  => 'Stay Duration Field is required',
            'visa_issue.required'     => 'Visa Issue Date Field is required',
            'visa_expiry.required'    => "Visa Expiry Date Field is required !!",
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
