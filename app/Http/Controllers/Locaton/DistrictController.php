<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_district = $this->getInfo();
        return view('admin.location.district.index', compact('all_district'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->get();

        return view('admin.location.district.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $district_create = District::latest() -> get(); // as latest
        $all_country = Country::latest() -> get(); // as latest

        return view('admin.location.district.create', [
            'district_create'   =>  $district_create,
            'all_country'       =>  $all_country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $district_create = new District();

        $district_create->districtname  = $request->districtname; 
        $district_create->divisionId    = $request->divisionId; 
        $district_create->countryId     = $request->countryId; 
        $district_create->status        = $request->status; 
        $district_create->save();

        return redirect() -> back() -> with('message', 'District is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $district_single_data = $this->getDetails($id);
        
        if($district_single_data->count() > 0){
            return view('admin.location.district.show', compact('district_single_data'));
        }else{
            return redirect('/district');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $district_data = $this->getDetails($id);
        
        if($district_data->count() > 0){
            return view('admin.location.district.edit', compact('district_data'));
        }else{
            return redirect('/district');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $district_data = District::findOrFail($id);

        $district_data->districtname  = $request->districtname; 
        $district_data->update();

        return redirect() -> back() -> with('message', 'District Name is Updated successfully');
    }

    public function editInfo($id)
    {
        $district_data_info = $this->getDetails($id);
        $all_country = Country::latest() -> get();
        $all_division = Division::latest() -> get();
        
        if($district_data_info->count() > 0){
            return view('admin.location.district.editInfo', [
            'district_data_info'=>$district_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
        ]);
        }else{
            return redirect('/district');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $district_data_info = District::findOrFail($id);

        $district_data_info->divisionId  = $request->divisionId;
        $district_data_info->countryId   = $request->countryId;
        $district_data_info->status      = $request->status;
        $district_data_info->update();

        return redirect() -> back() -> with('message', 'District Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_district = District::find($id);
        $data_district -> delete();

        return redirect() -> back() -> with('message', 'The District is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {

        $district_inactive = District::findOrFail($id);

        $district_inactive->districtname    = $request->districtname;
        $district_inactive->status      = 0;
        $district_inactive->update();              

        return redirect('/district')->with('message', 'The District is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $district_active = District::findOrFail($id);

        $district_active->districtname  = $request->districtname;
        $district_active->status    = 1;
        $district_active->update();              

        return redirect('/district')->with('message', 'The District is Active Successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('districts')
            ->leftJoin('countries', 'districts.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'districts.divisionId', '=', 'divisions.id')
            ->select('districts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('districts')
            ->leftJoin('countries', 'districts.countryId', '=', 'countries.id')
            ->where('districts.id', $id)
            ->leftJoin('divisions', 'districts.divisionId', '=', 'divisions.id')
            ->select('districts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname')
            ->get();
        return $data_details;
    }

    protected function validation($request){
        $this -> validate($request, [
            'districtname'   => 'required|unique:districts',
        ],
        [
            'districtname.required' => 'District Name Field must not be Empty',
            'districtname.unique'   => 'The District Name is already exist',
        ]);
    }
}