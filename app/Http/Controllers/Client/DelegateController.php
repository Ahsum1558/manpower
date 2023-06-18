<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
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
use File;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_delegate = Delegate::latest() -> get(); // as latest
        return view('admin.client.delegate.index', compact('all_delegate'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.client.delegate.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function getDistrict(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_district)>0) {
            return view('admin.client.delegate.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    public function getCity(Request $request)
    {
        $all_city = City::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_city)>0) {
            return view('admin.client.delegate.ajax_city',[
                'all_city'=>$all_city,
            ]);
        }
    }

    public function getUpzila(Request $request)
    {
        $all_upzila = Policestation::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        if (count($all_upzila)>0) {
            return view('admin.client.delegate.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $delegate_data = Delegate::latest() -> get(); // as latest
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_city = City::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();

        return view('admin.client.delegate.create', [
            'delegate_data'=>$delegate_data,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $delegate_data = Delegate::latest() -> get();
        if (count($delegate_data) > 0) {
            Delegate::create([
            'agentsl'           => $request->agentsl,
            'agentbook'         => $request->agentbook,
            'agentname'         => $request->agentname,
            'father'            => $request->father,
            'nid'               => $request->nid,
            'office'            => $request->office,
            'officeLocation'    => $request->officeLocation,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'dateOfBirth'       => $request->dateOfBirth,
            'gender'            => $request->gender,
            'address'           => $request->address,
            'accountNo'         => $request->accountNo,
            'bankname'          => $request->bankname,
            'bankbranch'        => $request->bankbranch,
            'policestationId'   => $request->policestationId,
            'districtId'        => $request->districtId,
            'divisionId'        => $request->divisionId,
            'cityId'            => $request->cityId,
            'countryId'         => $request->countryId,
            'zipcode'           => $request->zipcode,
            'description'       => $request->description,
            'status'            => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Delegate is added successfully');
        }else{
            $agentSerial = "AG00001";
            Delegate::create([
            'agentsl'           => $agentSerial,
            'agentbook'         => $request->agentbook,
            'agentname'         => $request->agentname,
            'father'            => $request->father,
            'nid'               => $request->nid,
            'office'            => $request->office,
            'officeLocation'    => $request->officeLocation,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'dateOfBirth'       => $request->dateOfBirth,
            'gender'            => $request->gender,
            'address'           => $request->address,
            'accountNo'         => $request->accountNo,
            'bankname'          => $request->bankname,
            'bankbranch'        => $request->bankbranch,
            'policestationId'   => $request->policestationId,
            'districtId'        => $request->districtId,
            'divisionId'        => $request->divisionId,
            'cityId'            => $request->cityId,
            'countryId'         => $request->countryId,
            'zipcode'           => $request->zipcode,
            'description'       => $request->description,
            'status'            => $request->status,
        ]);

        return redirect() -> back() -> with('message', 'Delegate is added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $delegate_single_data = $this->getDetails($id);
        
        if($delegate_single_data->count() > 0){
            return view('admin.client.delegate.show', compact('delegate_single_data'));
        }else{
            return redirect('/delegate');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $delegate_data_info = $this->getDetails($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_city = City::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();
        
        if($delegate_data_info->count() > 0){
            return view('admin.client.delegate.edit', [
            'delegate_data_info'=>$delegate_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
        }else{
            return redirect('/delegate');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $delegate_data_info = Delegate::findOrFail($id);
        $this->validationInfo($request);

        $delegate_data_info->agentname      = $request->agentname;
        $delegate_data_info->accountNo      = $request->accountNo;
        $delegate_data_info->bankname       = $request->bankname;
        $delegate_data_info->bankbranch     = $request->bankbranch;
        $delegate_data_info->father         = $request->father;
        $delegate_data_info->nid            = $request->nid;
        $delegate_data_info->gender         = $request->gender;
        $delegate_data_info->dateOfBirth    = $request->dateOfBirth;
        $delegate_data_info->phone          = $request->phone;
        $delegate_data_info->office         = $request->office;
        $delegate_data_info->officeLocation = $request->officeLocation;
        $delegate_data_info->address        = $request->address;
        $delegate_data_info->cityId         = $request->cityId;
        $delegate_data_info->policestationId = $request->policestationId;
        $delegate_data_info->districtId     = $request->districtId;
        $delegate_data_info->divisionId     = $request->divisionId;
        $delegate_data_info->countryId      = $request->countryId;
        $delegate_data_info->zipcode        = $request->zipcode;
        $delegate_data_info->description    = $request->description;
        $delegate_data_info->status         = $request->status;
        $delegate_data_info->update();

        return redirect() -> back() -> with('message', 'Delegate Info is Updated successfully');
    }

    public function editBook($id)
    {
        $delegate_book_data = Delegate::find($id);
        
        if ($delegate_book_data !== null) {
            return view('admin.client.delegate.editBook', compact('delegate_book_data'));
        }else{
            return redirect('/delegate');
        }
    }

    public function updateBook(Request $request, $id)
    {
        $this->validationBook($request);
        $delegate_book_data = Delegate::findOrFail($id);

        $delegate_book_data->agentbook   = $request->agentbook;
        $delegate_book_data->update();              

        return back()->with('message', 'The Delegate Book Referance is Updated Successfully');
    }

    public function editEmail($id)
    {
        $delegate_email_data = Delegate::find($id);
        
        if ($delegate_email_data !== null) {
            return view('admin.client.delegate.editEmail', compact('delegate_email_data'));
        }else{
            return redirect('/delegate');
        }
    }

    public function updateEmail(Request $request, $id)
    {
        $this->validationEmail($request);
        $delegate_email_data = Delegate::findOrFail($id);

        $delegate_email_data->email   = $request->email;
        $delegate_email_data->update();              

        return back()->with('message', 'The Delegate E-Mail Address is Updated Successfully');
    }

    public function editImage($id)
    {
        $delegate_image_data = Delegate::find($id);
        
        if ($delegate_image_data !== null) {
            return view('admin.client.delegate.editImage', compact('delegate_image_data'));
        }else{
            return redirect('/delegate');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $delegate_image_data = Delegate::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img->move(public_path('admin/uploads/delegate/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/delegate/' .$request->old_photo)) {
                File::delete('public/admin/uploads/delegate/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $delegate_image_data->photo     = $unique_file_name;
        $delegate_image_data->update();
        
        return back()->with('message', 'Delegate Image is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_delegate = Delegate::find($id);
        $data_delegate -> delete();

        if(File::exists('public/admin/uploads/delegate/' .$data_delegate->photo)) {
            File::delete('public/admin/uploads/delegate/' .$data_delegate->photo);
        }

        return redirect() -> back() -> with('message', 'The Delegate is deleted successfully');
    }

    public function inactive($id)
    {
        $delegate_inactive = Delegate::findOrFail($id);

        $delegate_inactive->status   = 0;
        $delegate_inactive->update();              

        return redirect('/delegate')->with('message', 'The Delegate is Inactive Successfully');
    }
    
    public function active($id)
    {
        $delegate_active = Delegate::findOrFail($id);

        $delegate_active->status   = 1;
        $delegate_active->update();              

        return redirect('/delegate')->with('message', 'The Delegate is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'agentbook'       => 'required|unique:delegates',
            'agentname'       => 'required',
            'father'          => 'required',
            'phone'           => 'required|numeric',
            'email'           => 'required|email|unique:delegates',
            'address'         => 'required',
            'office'          => 'required',
            'officeLocation'  => 'required',
            'dateOfBirth'     => 'required|date',
            'gender'          => 'required|in:1,2,3',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'agentbook.required'        => 'Book Ref No. Field must not be Empty',
            'agentbook.unique'          => "Book Ref No. is Already Exist !!",
            'agentname.required'        => 'Delegate Name Field is required',
            'father.required'           => 'Care Of Field must not be Empty',
            'phone.required'            => 'Phone Number Field must not be Empty',
            'phone.numeric'             => "Phone number is not valid !!",
            'email.required'            => "E-Mail Field must not be empty !!",
            'email.unique'              => "E-Mail is Already Exist !!",
            'email.email'               => "E-Mail Address is not valid !!",
            'address.required'          => 'Delegate Address Field must not be Empty',
            'office.required'           => 'Delegate Office Name Field is required',
            'officeLocation.required'   => 'Delegate Office Address Field must not be Empty',
            'dateOfBirth.required'      => 'Date of Birth Field is required',
            'gender.required'           => 'Gender Field is required',
            'gender.in'                 => 'Invalid Gender option',
            'policestationId.required'  => "Police Station Field is required !!",
            'policestationId.exists'    => "Invalid Police Station Field !!",
            'districtId.required'       => "District Field is required !!",
            'districtId.exists'         => "Invalid District Field !!",
            'divisionId.required'       => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'cityId.required'        => "City Field is required !!",
            'cityId.exists'          => "Invalid City Field !!",
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'agentname'       => 'required',
            'father'          => 'required',
            'phone'           => 'required|numeric',
            'address'         => 'required',
            'office'          => 'required',
            'officeLocation'  => 'required',
            'dateOfBirth'     => 'required|date',
            'gender'          => 'required|in:1,2,3',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'agentname.required'        => 'Delegate Name Field is required',
            'father.required'           => 'Care Of Field must not be Empty',
            'phone.required'            => 'Phone Number Field must not be Empty',
            'phone.numeric'             => "Phone number is not valid !!",
            'address.required'          => 'Delegate Address Field must not be Empty',
            'office.required'           => 'Delegate Office Name Field is required',
            'officeLocation.required'   => 'Delegate Office Address Field must not be Empty',
            'dateOfBirth.required'      => 'Date of Birth Field is required',
            'gender.required'           => 'Gender Field is required',
            'gender.in'                 => 'Invalid Gender option selected',
            'policestationId.required'  => "Police Station Field is required !!",
            'policestationId.exists'    => "Invalid Police Station Field !!",
            'districtId.required'       => "District Field is required !!",
            'districtId.exists'         => "Invalid District Field !!",
            'divisionId.required'       => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'cityId.required'        => "City Field is required !!",
            'cityId.exists'          => "Invalid City Field !!",
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }

    protected function validationBook($request){
        $this -> validate($request, [
            'agentbook'         => 'required|unique:delegates',
        ],
        [
            'agentbook.required' => 'Book Ref No. Field must not be Empty',
            'agentbook.unique'   => "Book Ref No. is Already Exist !!",
        ]);
    }

    protected function validationEmail($request){
        $this -> validate($request, [
            'email'             => 'required|email|unique:delegates',
        ],
        [
            'email.required'    => "E-Mail Field must not be empty !!",
            'email.unique'      => "E-Mail is Already Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('delegates')
            ->leftJoin('countries', 'delegates.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'delegates.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'delegates.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'delegates.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'delegates.cityId', '=', 'cities.id')
            ->select('delegates.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('policestations.policestationname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('delegates')
            ->leftJoin('countries', 'delegates.countryId', '=', 'countries.id')
            ->where('delegates.id', $id)
            ->leftJoin('divisions', 'delegates.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'delegates.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'delegates.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'delegates.cityId', '=', 'cities.id')
            ->select('delegates.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->get();
        return $data_details;
    }
}