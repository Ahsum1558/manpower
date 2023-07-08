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
use App\Models\FavorAgent;
use File;

class FavorAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_favor = FavorAgent::latest() -> get(); // as latest
        return view('admin.client.favor.index', compact('all_favor'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->get();

        return view('admin.client.favor.ajax',[
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
            return view('admin.client.favor.ajax_district',[
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
            return view('admin.client.favor.ajax_city',[
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
            return view('admin.client.favor.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $favor_data = FavorAgent::latest() -> get(); // as latest
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_city = City::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();

        return view('admin.client.favor.create', [
            'favor_data'=>$favor_data,
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

        $favor_data = FavorAgent::latest() -> get();
        if (count($favor_data) > 0) {
            FavorAgent::create([
            'favorsl'           => $request->favorsl,
            'favorbook'         => $request->favorbook,
            'favorname'         => $request->favorname,
            'father'            => $request->father,
            'nid'               => $request->nid,
            'favor_office'      => $request->favor_office,
            'favor_license'     => $request->favor_license,
            'office_address'    => $request->office_address,
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
        return redirect() -> back() -> with('message', 'Favor Agent is added successfully');
        }else{
            $agentSerial = "FAV00001";
            FavorAgent::create([
            'favorsl'           => $agentSerial,
            'favorbook'         => $request->favorbook,
            'favorname'         => $request->favorname,
            'father'            => $request->father,
            'nid'               => $request->nid,
            'favor_office'      => $request->favor_office,
            'favor_license'     => $request->favor_license,
            'office_address'    => $request->office_address,
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

        return redirect() -> back() -> with('message', 'Favor Agent is added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $favor_single_data = $this->getDetails($id);
        
        if($favor_single_data->count() > 0){
            return view('admin.client.favor.show', [
            'favor_single_data'=>$favor_single_data,
        ]);
        }else{
            return redirect('/favor');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $favor_data_info = $this->getDetails($id);
        $all_country = Country::latest()->where('status','=',1) -> get();
        $all_division = Division::latest()->where('status','=',1) -> get();
        $all_district = District::latest()->where('status','=',1) -> get();
        $all_city = City::latest()->where('status','=',1) -> get();
        $all_upzila = Policestation::latest()->where('status','=',1) -> get();
        
        if($favor_data_info->count() > 0){
            return view('admin.client.favor.edit', [
            'favor_data_info'=>$favor_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
        }else{
            return redirect('/favor');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $favor_data_info = FavorAgent::findOrFail($id);
        $this->validationInfo($request);

        $favor_data_info->favorname      = $request->favorname;
        $favor_data_info->accountNo      = $request->accountNo;
        $favor_data_info->bankname       = $request->bankname;
        $favor_data_info->bankbranch     = $request->bankbranch;
        $favor_data_info->father         = $request->father;
        $favor_data_info->nid            = $request->nid;
        $favor_data_info->gender         = $request->gender;
        $favor_data_info->dateOfBirth    = $request->dateOfBirth;
        $favor_data_info->phone          = $request->phone;
        $favor_data_info->office_address = $request->office_address;
        $favor_data_info->address        = $request->address;
        $favor_data_info->cityId         = $request->cityId;
        $favor_data_info->policestationId = $request->policestationId;
        $favor_data_info->districtId     = $request->districtId;
        $favor_data_info->divisionId     = $request->divisionId;
        $favor_data_info->countryId      = $request->countryId;
        $favor_data_info->zipcode        = $request->zipcode;
        $favor_data_info->description    = $request->description;
        $favor_data_info->status         = $request->status;
        $favor_data_info->update();

        return redirect() -> back() -> with('message', 'Favor Agent Info is Updated successfully');
    }

    public function editBook($id)
    {
        $favor_book_data = FavorAgent::find($id);
        
        if ($favor_book_data !== null) {
            return view('admin.client.favor.editBook', compact('favor_book_data'));
        }else{
            return redirect('/favor');
        }
    }

    public function updateBook(Request $request, $id)
    {
        $this -> validate($request, [
            'favorbook'       => 'required|unique:favor_agents',
        ],
        [
            'favorbook.required'        => 'Book Ref No. Field must not be Empty',
            'favorbook.unique'          => "Book Ref No. is Already Exist !!",
        ]);
        $favor_book_data = FavorAgent::findOrFail($id);

        $favor_book_data->favorbook   = $request->favorbook;
        $favor_book_data->update();              

        return back()->with('message', 'The Favor Agent Book Referance is Updated Successfully');
    }

    public function editOffice($id)
    {
        $favor_office_data = FavorAgent::find($id);
        
        if ($favor_office_data !== null) {
            return view('admin.client.favor.editOffice', compact('favor_office_data'));
        }else{
            return redirect('/favor');
        }
    }

    public function updateOffice(Request $request, $id)
    {
        $this -> validate($request, [
            'favor_office'    => 'required|unique:favor_agents',
        ],
        [
            'favor_office.required'     => 'Favor Agent Office Name Field is required',
            'favor_office.unique'       => "Favor Agent Office Name is Already Exist !!",
        ]);
        $favor_office_data = FavorAgent::findOrFail($id);

        $favor_office_data->favor_office = $request->favor_office;
        $favor_office_data->update();              

        return back()->with('message', 'The Favor Agent Office Name is Updated Successfully');
    }

    public function editLicense($id)
    {
        $favor_license_data = FavorAgent::find($id);
        
        if ($favor_license_data !== null) {
            return view('admin.client.favor.editLicense', compact('favor_license_data'));
        }else{
            return redirect('/favor');
        }
    }

    public function updateLicense(Request $request, $id)
    {
        $this -> validate($request, [
            'favor_license'   => 'required|unique:favor_agents',
        ],
        [
            'favor_license.required'    => 'Favor Agent License Field is required',
            'favor_license.unique'      => "Favor Agent License is Already Exist !!",
        ]);
        $favor_license_data = FavorAgent::findOrFail($id);

        $favor_license_data->favor_license = $request->favor_license;
        $favor_license_data->update();              

        return back()->with('message', 'The Favor Agent Office License Number is Updated Successfully');
    }

    public function editEmail($id)
    {
        $favor_email_data = FavorAgent::find($id);
        
        if ($favor_email_data !== null) {
            return view('admin.client.favor.editEmail', compact('favor_email_data'));
        }else{
            return redirect('/favor');
        }
    }

    public function updateEmail(Request $request, $id)
    {
        $this -> validate($request, [
            'email'      => 'required|email|unique:favor_agents',
        ],
        [
            'email.required'            => "E-Mail Field must not be empty !!",
            'email.unique'              => "E-Mail is Already Exist !!",
            'email.email'               => "E-Mail Address is not valid !!",
        ]);
        $favor_email_data = FavorAgent::findOrFail($id);

        $favor_email_data->email   = $request->email;
        $favor_email_data->update();              

        return back()->with('message', 'The Favor Agent E-Mail Address is Updated Successfully');
    }

    public function editImage($id)
    {
        $favor_image_data = FavorAgent::find($id);
        
        if ($favor_image_data !== null) {
            return view('admin.client.favor.editImage', compact('favor_image_data'));
        }else{
            return redirect('/favor');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $favor_image_data = FavorAgent::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img->move(public_path('admin/uploads/favor/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/favor/' .$request->old_photo)) {
                File::delete('public/admin/uploads/favor/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $favor_image_data->photo     = $unique_file_name;
        $favor_image_data->update();
        
        return back()->with('message', 'Favor Agent Image is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_favor = FavorAgent::find($id);
        $data_favor -> delete();

        if(File::exists('public/admin/uploads/favor/' .$data_favor->photo)) {
            File::delete('public/admin/uploads/favor/' .$data_favor->photo);
        }

        return redirect() -> back() -> with('message', 'The Favor Agent is deleted successfully');
    }

    public function inactive($id)
    {
        $favor_inactive = FavorAgent::findOrFail($id);

        $favor_inactive->status   = 0;
        $favor_inactive->update();              

        return redirect('/favor')->with('message', 'The Favor Agent is Inactive Successfully');
    }
    
    public function active($id)
    {
        $favor_active = FavorAgent::findOrFail($id);

        $favor_active->status   = 1;
        $favor_active->update();              

        return redirect('/favor')->with('message', 'The Favor Agent is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'favorbook'       => 'required|unique:favor_agents',
            'favorname'       => 'required',
            'father'          => 'required',
            'phone'           => 'required|numeric',
            'email'           => 'required|email|unique:favor_agents',
            'address'         => 'required',
            'favor_office'    => 'required|unique:favor_agents',
            'favor_license'   => 'required|unique:favor_agents',
            'office_address'  => 'required',
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
            'favorbook.required'        => 'Book Ref No. Field must not be Empty',
            'favorbook.unique'          => "Book Ref No. is Already Exist !!",
            'favorname.required'        => 'Favor Agent Name Field is required',
            'father.required'           => 'Care Of Field must not be Empty',
            'phone.required'            => 'Phone Number Field must not be Empty',
            'phone.numeric'             => "Phone number is not valid !!",
            'email.required'            => "E-Mail Field must not be empty !!",
            'email.unique'              => "E-Mail is Already Exist !!",
            'email.email'               => "E-Mail Address is not valid !!",
            'address.required'          => 'Favor Agent Address Field must not be Empty',
            'favor_office.required'     => 'Favor Agent Office Name Field is required',
            'favor_office.unique'       => "Favor Agent Office Name is Already Exist !!",
            'favor_license.required'    => 'Favor Agent License Field is required',
            'favor_license.unique'      => "Favor Agent License is Already Exist !!",
            'office_address.required'   => 'Favor Agent Office Address Field must not be Empty',
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
            'favorname'       => 'required',
            'father'          => 'required',
            'phone'           => 'required|numeric',
            'address'         => 'required',
            'office_address'  => 'required',
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
            'favorname.required'        => 'Favor Agent Name Field is required',
            'father.required'           => 'Care Of Field must not be Empty',
            'phone.required'            => 'Phone Number Field must not be Empty',
            'phone.numeric'             => "Phone number is not valid !!",
            'address.required'          => 'Favor Agent Address Field must not be Empty',
            'office_address.required'   => 'Favor Agent Office Address Field must not be Empty',
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

    protected function getInfo(){
        $data_info = DB::table('favor_agents')
            ->leftJoin('countries', 'favor_agents.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'favor_agents.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'favor_agents.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'favor_agents.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'favor_agents.cityId', '=', 'cities.id')
            ->select('favor_agents.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('policestations.policestationname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('favor_agents')
            ->leftJoin('countries', 'favor_agents.countryId', '=', 'countries.id')
            ->where('favor_agents.id', $id)
            ->leftJoin('divisions', 'favor_agents.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'favor_agents.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'favor_agents.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'favor_agents.cityId', '=', 'cities.id')
            ->select('favor_agents.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->get();
        return $data_details;
    }
}