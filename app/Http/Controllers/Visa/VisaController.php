<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_visa = Visa::latest() -> get(); // as latest
        return view('admin.visa.visainfo.index', compact('all_visa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visa_data = Visa::latest() -> get(); // as latest
        return view('admin.visa.visainfo.create', compact('visa_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingRecord = Visa::where([
            'visano_en'=>$request->visano_en,
            'sponsorid_en'=>$request->sponsorid_en,
            'occupation_ar'=>$request->occupation_ar,
            'delegation_no'=>$request->delegation_no,
        ])->first();
        if (!$existingRecord){
        $this->validation($request);

        Visa::create([
            'visano_en'         => $request->visano_en,
            'visano_ar'         => $request->visano_ar,
            'sponsorid_en'      => $request->sponsorid_en,
            'sponsorid_ar'      => $request->sponsorid_ar,
            'sponsorname_en'    => $request->sponsorname_en,
            'sponsorname_ar'    => $request->sponsorname_ar,
            'visa_date'         => $request->visa_date,
            'visa_address'      => $request->visa_address,
            'occupation_en'     => $request->occupation_en,
            'occupation_ar'     => $request->occupation_ar,
            'delegation_no'     => $request->delegation_no,
            'delegation_date'   => $request->delegation_date,
            'delegated_visa'    => $request->delegated_visa,
            'visa_duration'     => $request->visa_duration,
            'status'            => $request->status,
        ]);
        
        return redirect() -> back() -> with('message', 'Visa is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Visa no is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_visa = Visa::find($id);
        
        if ($single_visa !== null) {
            return view('admin.visa.visainfo.show', compact('single_visa'));
        }else{
            return redirect('/visa');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa_data = Visa::find($id);
        
        if ($visa_data !== null) {
            return view('admin.visa.visainfo.edit', compact('visa_data'));
        }else{
            return redirect('/visa');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationInfo($request);
        $visa_data = Visa::findOrFail($id);

        $visa_data->sponsorid_en    = $request->sponsorid_en;
        $visa_data->sponsorid_ar    = $request->sponsorid_ar;
        $visa_data->sponsorname_en  = $request->sponsorname_en;
        $visa_data->sponsorname_ar  = $request->sponsorname_ar;
        $visa_data->visa_date       = $request->visa_date;
        $visa_data->visa_address    = $request->visa_address;
        $visa_data->occupation_en   = $request->occupation_en;
        $visa_data->occupation_ar   = $request->occupation_ar;
        $visa_data->delegation_date = $request->delegation_date;
        $visa_data->delegated_visa  = $request->delegated_visa;
        $visa_data->visa_duration   = $request->visa_duration;
        $visa_data->status          = $request->status;
        $visa_data->update();

        return back()->with('message', 'The Visa Info is Updated Successfully');
    }

    public function editVisa(string $id)
    {
        $visaNo_data = Visa::find($id);
        
        if ($visaNo_data !== null) {
            return view('admin.visa.visainfo.editVisa', compact('visaNo_data'));
        }else{
            return redirect('/visa');
        }
    }

    public function updateVisa(Request $request, string $id)
    {
        $this->validationVisaNo($request);
        $visaNo_data = Visa::findOrFail($id);

        $visaNo_data->visano_en   = $request->visano_en;
        $visaNo_data->visano_ar   = $request->visano_ar;
        $visaNo_data->update();

        return back()->with('message', 'The Visa Number is Updated Successfully');
    }

    public function editDelegation(string $id)
    {
        $delegation_data = Visa::find($id);
        
        if ($delegation_data !== null) {
            return view('admin.visa.visainfo.editDelegation', compact('delegation_data'));
        }else{
            return redirect('/visa');
        }
    }

    public function updateDelegation(Request $request, string $id)
    {
        $this->validationDelegation($request);
        $delegation_data = Visa::findOrFail($id);

        $delegation_data->delegation_no   = $request->delegation_no;
        $delegation_data->update();

        return back()->with('message', 'The Visa Delegation No. is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_visa = Visa::find($id);
        $data_visa -> delete();

        return redirect() -> back() -> with('message', 'The Visa is deleted successfully');
    }

    public function inactive($id)
    {

        $Visa_inactive = Visa::findOrFail($id);

        $Visa_inactive->status   = 0;
        $Visa_inactive->update();              

        return redirect('/visa')->with('message', 'The Visa is Inactive Successfully');
    }
    
    public function active($id)
    {

        $visa_active = Visa::findOrFail($id);

        $visa_active->status   = 1;
        $visa_active->update();              

        return redirect('/visa')->with('message', 'The Visa is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visano_en'         => 'required',
            'visano_ar'         => 'required',
            'sponsorid_en'      => 'required',
            'sponsorid_ar'      => 'required',
            'sponsorname_en'    => 'required',
            'sponsorname_ar'    => 'required',
            'visa_date'         => 'required',
            'visa_address'      => 'required',
            'occupation_en'     => 'required',
            'occupation_ar'     => 'required',
            'delegation_no'     => 'required',
            'delegation_date'   => 'required',
            'delegated_visa'    => 'required',
            'visa_duration'     => 'required',
        ],
        [
            'visano_en.required' => 'Visa No. Field must not be Empty',
            'visano_ar.required' => 'Visa No. Arabic Field is required',
            'sponsorid_en.required'     => 'Sponsor Id No. Field must not be Empty',
            'sponsorid_ar.required'     => 'Sponsor Id No. Arabic Field must not be Empty',
            'sponsorname_en.required'   => 'Sponsor Name Field must not be Empty',
            'sponsorname_ar.required'   => 'Sponsor Name Arabic Field is required',
            'visa_date.required'        => 'Visa date in Hijri Field must not be Empty',
            'visa_address.required'     => 'Visa Address Field is required',
            'occupation_en.required'    => 'Occupation Field must not be Empty',
            'occupation_ar.required'    => 'Occupation Arabic Field must not be Empty',
            'delegation_no.required'    => 'Visa Delegation No. Field must not be Empty',
            'delegation_date.required'  => 'Visa Delegation Date Field is required',
            'delegated_visa.required'   => 'Total Delegated visa count Field must not be Empty',
            'visa_duration.required'    => 'Visa Duration Field is required',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'sponsorid_en'      => 'required',
            'sponsorid_ar'      => 'required',
            'sponsorname_en'    => 'required',
            'sponsorname_ar'    => 'required',
            'visa_date'         => 'required',
            'visa_address'      => 'required',
            'occupation_en'     => 'required',
            'occupation_ar'     => 'required',
            'delegation_date'   => 'required',
            'delegated_visa'    => 'required',
            'visa_duration'     => 'required',
        ],
        [
            'sponsorid_en.required'     => 'Sponsor Id No. Field must not be Empty',
            'sponsorid_ar.required'     => 'Sponsor Id No. Arabic Field must not be Empty',
            'sponsorname_en.required'   => 'Sponsor Name Field must not be Empty',
            'sponsorname_ar.required'   => 'Sponsor Name Arabic Field is required',
            'visa_date.required'        => 'Visa date in Hijri Field must not be Empty',
            'visa_address.required'     => 'Visa Address Field is required',
            'occupation_en.required'    => 'Occupation Field must not be Empty',
            'occupation_ar.required'    => 'Occupation Arabic Field must not be Empty',
            'delegation_date.required'  => 'Visa Delegation Date Field is required',
            'delegated_visa.required'   => 'Total Delegated visa count Field must not be Empty',
            'visa_duration.required'    => 'Visa Duration Field is required',
        ]);
    }

    protected function validationVisaNo($request){
        $this -> validate($request, [
            'visano_en'       => 'required',
            'visano_ar'       => 'required',
        ],
        [
            'visano_en.required' => 'Visa No. Field must not be Empty',
            'visano_ar.required' => 'Visa No. Arabic Field must not be Empty',
        ]);
    }

    protected function validationDelegation($request){
        $this -> validate($request, [
            'delegation_no'   => 'required|unique:visas',
        ],
        [
            'delegation_no.required'    => 'Visa Delegation No. Field must not be Empty',
            'delegation_no.unique'      => 'Visa Delegation No. already exist !',
        ]);
    }
}