<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerDocoment;

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
            return redirect() -> back() -> with('message', 'Customer Document Info is added successfully');
        }
    }

    public function editDocs($id)
    {
        $customer_edit_docs = Customer::find($id);
        $docs_edit = CustomerDocoment::where('customerId', $id)->get();
        
        if ($customer_edit_docs !== null) {
            return view('admin.client.customer.document.editDocs', [
            'customer_edit_docs'=>$customer_edit_docs,
            'docs_edit'=>$docs_edit,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    public function updateDocs(Request $request, $id)
    {
        $docs_edit = CustomerDocoment::where('customerId', $id)->first();
        $this->validation($request);

        $docs_edit->tc             = $request->tc;
        $docs_edit->pc             = $request->pc;
        $docs_edit->license        = $request->license;
        $docs_edit->certificate    = $request->certificate;
        $docs_edit->finger         = $request->finger;
        $docs_edit->musaned        = $request->musaned;
        $docs_edit->update();

        return redirect() -> back() -> with('message', 'Customer Document Info is Updated successfully');
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
}