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

class CustomerDocomentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function document($id)
    {
        $customer_docs = Customer::find($id);
        $customer_documents = CustomerDocoment::latest()-> get();
        
        if($customer_docs !== null && $customer_docs->value == 0){
            return view('admin.client.customer.document.document', [
            'customer_docs'=>$customer_docs,
            'customer_documents'=>$customer_documents,
        ]);
        }else{
            return redirect('/customer');
        }
    }

    public function storeDocuments(Request $request, $id)
    {
        $this->validation($request);

        $customer_docs = Customer::findOrFail($id);
        $customer_id = $customer_docs->id;

        $customer_documents = new CustomerDocoment();
        $customer_documents->customerId     = $customer_id;
        $customer_documents->tc             = $request->tc;
        $customer_documents->pc             = $request->pc;
        $customer_documents->license        = $request->license;
        $customer_documents->certificate    = $request->certificate;
        $customer_documents->finger         = $request->finger;
        $customer_documents->musaned        = $request->musaned;
        $customer_documents->save();

        if($customer_documents){
            $customer_docs->value        = 1;
            $customer_docs->update();
            return redirect() -> back() -> with('message', 'Customer Document is added successfully');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'     => 'unique:customer_docoments',
            'tc'             => 'required',
            'pc'             => 'required',
            'license'        => 'required',
            'certificate'    => 'required',
            'finger'         => 'required',
            'musaned'        => 'required',
        ],
        [
            'customerId.unique'     => 'Customer is already exist',
            'tc.required'           => 'Training Certificate Field must not be Empty',
            'pc.required'           => 'Police Clearance Certificate Field is required',
            'license.required'      => 'Driving License Field must not be Empty',
            'certificate.required'  => "Educational Certificate Field must not be empty !!",
            'finger.required'       => "Finger Print Field must not be empty !!",
            'musaned.required'      => "Musaned Field must not be empty !!",
        ]);
    }

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
