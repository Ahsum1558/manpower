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

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_customer = $this->getInfo(); // as latest
        return view('admin.client.customer.index', compact('all_customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer_data = Customer::latest() -> get(); // as latest
        $all_visa_trade = Visatrade::latest()->where('status','=',1) -> get();
        $all_delegate = Delegate::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        return view('admin.client.customer.create', [
            'customer_data'=>$customer_data,
            'all_visa_trade'=>$all_visa_trade,
            'all_delegate'=>$all_delegate,
            'all_district'=>$all_district,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $customer_data = Customer::latest() -> get();
        if (count($customer_data) > 0) {
            Customer::create([
            'customersl'    => $request->customersl,
            'bookRef'       => $request->bookRef,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'phone'         => $request->phone,
            'agentId'       => $request->agentId,
            'birthPlace'    => $request->birthPlace,
            'medical'       => $request->medical,
            'received'      => $request->received,
            'tradeId'       => $request->tradeId,
            'status'        => $request->status,
            'value'         => 0,
            'userId'        => Auth::user()->id,
            
        ]);
        return redirect() -> back() -> with('message', 'Customer is added successfully');
        }else{
            $customerSerial = "CUS00001";
            Customer::create([
            'customersl'    => $customerSerial,
            'bookRef'       => $request->bookRef,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'phone'         => $request->phone,
            'agentId'       => $request->agentId,
            'birthPlace'    => $request->birthPlace,
            'medical'       => $request->medical,
            'received'      => $request->received,
            'tradeId'       => $request->tradeId,
            'status'        => $request->status,
            'value'         => 0,
            'userId'        => Auth::user()->id,
        ]);

        return redirect() -> back() -> with('message', 'Customer is added successfully');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'bookRef'       => 'required|unique:customers',
            'cusFname'      => 'required',
            'phone'         => 'required',
            'passportNo'    => 'required|unique:customers',
            'birthPlace'    => 'required|exists:districts,id',
            'received'      => 'required|date',
        ],
        [
            'bookRef.required'          => 'Book Ref No. Field must not be Empty',
            'bookRef.unique'            => "Book Ref No. is Already Exist !!",
            'cusFname.required'         => 'Customer First Name Field is required',
            'phone.required'            => 'Phone Number Field must not be Empty',
            'passportNo.required'       => "Passport Number Field must not be empty !!",
            'passportNo.unique'         => "Passport Number is Already Exist !!",
            'birthPlace.required'       => "Place of Birth Field must not be empty !!",
            'received.required'         => "Passport Receive Date Field must not be empty !!",

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer_single_data = $this->getDetails($id);
        $customer_single_docs = CustomerDocoment::where('customerId', $id)->get();
        $passport_single_data = $this->getPassportDetails($id);
        $embassy_single_data = $this->getEmbassyDetails($id);
        $stamping_single_docs = CustomerVisa::where('customerId', $id)->get();
        $rate_single_docs = CustomerRate::where('customerId', $id)->get();

        if($customer_single_data->count() > 0){
            return view('admin.client.customer.show', [
            'customer_single_data'=>$customer_single_data,
            'customer_single_docs'=>$customer_single_docs,
            'passport_single_data'=>$passport_single_data,
            'embassy_single_data'=>$embassy_single_data,
            'stamping_single_docs'=>$stamping_single_docs,
            'rate_single_docs'=>$rate_single_docs,
        ]);

        }else{
            return redirect('/customer');
        }
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
        // Begin a database transaction
        DB::beginTransaction();
        try {
            // Delete customer from the "customers" table
            $data_customer = Customer::find($id);
            $data_customer -> delete();
            // Customer::where('id', $id)->delete();
            CustomerDocoment::where('customerId', $id)->delete();
            CustomerPassport::where('customerId', $id)->delete();
            CustomerEmbassy::where('customerId', $id)->delete();
            CustomerVisa::where('customerId', $id)->delete();
            CustomerRate::where('customerId', $id)->delete();

            // Commit the transaction if all queries succeeded
            DB::commit();

            if(File::exists('public/admin/uploads/customer/' .$data_customer->photo)) {
            File::delete('public/admin/uploads/customer/' .$data_customer->photo);
            }
            if(File::exists('public/admin/uploads/customer/' .$data_customer->passportCopy)) {
            File::delete('public/admin/uploads/customer/' .$data_customer->passportCopy);
            }
            return redirect() -> back() -> with('message', 'The Customer is deleted successfully');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();
            return "Error deleting customer: " . $e->getMessage();
        }
    }

    public function inactive($id)
    {
        $customer_inactive = Customer::findOrFail($id);

        $customer_inactive->status   = 0;
        $customer_inactive->update();              

        return redirect('/customer')->with('message', 'The Customer is Inactive Successfully');
    }
    
    public function active($id)
    {
        $customer_active = Customer::findOrFail($id);

        $customer_active->status   = 1;
        $customer_active->update();              

        return redirect('/customer')->with('message', 'The Customer is Active Successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver')
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->where('customers.id', $id)
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver')
            ->get();
        return $data_details;
    }

    protected function getPassportDetails($id){
        $data_passport = DB::table('customer_passports')
            ->leftJoin('countries', 'customer_passports.countryId', '=', 'countries.id')
            ->where('customer_passports.customerId', $id)
            ->leftJoin('divisions', 'customer_passports.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'customer_passports.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'customer_passports.policestationId', '=', 'policestations.id')
            ->leftJoin('issues', 'customer_passports.issuePlaceId', '=', 'issues.id')
            ->select('customer_passports.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'issues.issuePlace')
            ->get();
        return $data_passport;
    }

    protected function getEmbassyDetails($id){
        $data_embassy = DB::table('customer_embassies')
            ->leftJoin('visatypes', 'customer_embassies.visaTypeId', '=', 'visatypes.id')
            ->where('customer_embassies.customerId', $id)
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('fields', 'customer_embassies.fieldId', '=', 'fields.id')
            ->leftJoin('fieldars', 'customer_embassies.fieldarId', '=', 'fieldars.id')
            ->leftJoin('fieldbns', 'customer_embassies.fieldbnId', '=', 'fieldbns.id')
            ->select('customer_embassies.*', 'visatypes.visatype_name', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'fields.title', 'fields.license', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fieldars.title_ar', 'fieldars.license_ar', 'fieldars.address_ar', 'fieldars.proprietor_ar', 'fieldars.proprietortitle_ar', 'fieldbns.title_bn', 'fieldbns.license_bn', 'fieldbns.address_bn', 'fieldbns.proprietor_bn', 'fieldbns.proprietortitle_bn', 'fieldbns.description_bn')
            ->get();
        return $data_embassy;
    }
}